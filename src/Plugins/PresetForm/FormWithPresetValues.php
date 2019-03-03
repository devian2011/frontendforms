<?php

namespace Devian\FrontendForms\Plugins\PresetForm;

use Devian\FrontendForms\Fields\FieldInterface;
use Devian\FrontendForms\Form;
use Devian\FrontendForms\FormDecoratorInterface;
use Devian\FrontendForms\FormInterface;

/**
 * Class FormWithPresetValues
 *
 * Декоратор для формы который устанавливает предустановленные значения
 *
 * @package Devian\FrontendForms
 */
class FormWithPresetValues implements FormInterface, FormDecoratorInterface
{
    /**
     * @var Form
     */
    private $form;

    /**
     * @var PresetFormCollection
     */
    private $collection;

    /**
     * FormWithPresetValues constructor.
     * @param FormInterface $form
     * @param PresetFormCollection $collection
     */
    public function __construct(FormInterface $form, PresetFormCollection $collection)
    {
        $this->form = $form;
        $this->collection = $collection;
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->form->getId();
    }

    /**
     * @inheritDoc
     */
    public function getFormName(): string
    {
        return $this->form->getFormName();
    }

    /**
     * @inheritDoc
     */
    public function loadData(array $values)
    {
        //Проставляем для скрытых полей значения по умолчанию
        foreach ($this->collection->getFieldsSettings() as $setting) {
            if ($setting->isHidden()) {
                $values[$setting->getId()] = $setting->getValue();
            }
        }

        $this->form->loadData($values);
    }

    /**
     * @inheritDoc
     */
    public function getField(string $fieldId): ?FieldInterface
    {
        if ($this->collection->has($fieldId)) {
            $settings = $this->collection->getPresetSettingByFieldId($fieldId);
            if ($settings->isHidden()) {
                return null;
            } else {
                return new FieldWithPresetValue($this->form->getField($fieldId), $settings);
            }

        }

        return $this->form->getField($fieldId);
    }

    /**
     * @inheritDoc
     */
    public function getFieldByCode(string $fieldProgrammingCode): ?FieldInterface
    {
        $field = $this->form->getFieldByCode($fieldProgrammingCode);
        if ($this->collection->has($field->getFieldId())) {
            return new FieldWithPresetValue($field, $this->collection->getPresetSettingByFieldId($field->getFieldId()));
        }

        return $field;
    }

    /**
     * @inheritDoc
     */
    public function getFieldsWithProgrammingCodeMapping(): array
    {
        $result = [];
        foreach ($this->form->getFieldsWithProgrammingCodeMapping() as $id => $field) {
            if ($this->collection->has($id)) {
                $settings = $this->collection->getPresetSettingByFieldId($id);
                if (!$settings->isHidden()) {
                    $result[$id] = new FieldWithPresetValue($field, $settings);
                }
            }
            $result[$id] = $field;
        }

        return $result;

    }

    /**
     * @inheritDoc
     */
    public function getFields(): array
    {
        $result = [];
        foreach ($this->form->getFields() as $id => $field) {
            if ($this->collection->has($id)) {
                $settings = $this->collection->getPresetSettingByFieldId($id);
                if (!$settings->isHidden()) {
                    $result[$id] = new FieldWithPresetValue($field, $settings);
                }
            } else {
                $result[$id] = $field;
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getFieldProgrammingCodeValues(): array
    {
        return $this->form->getFieldProgrammingCodeValues();
    }

    /**
     * @inheritDoc
     */
    public function getFieldValues()
    {
        return $this->form->getFieldValues();
    }

    /**
     * @inheritDoc
     */
    public function validate(): void
    {
        $this->form->validate();
    }

    /**
     * @inheritDoc
     */
    public function getErrors(): array
    {
        return $this->form->getErrors();
    }


    /**
     * @return FormInterface
     */
    public function getPreviousForm(): FormInterface
    {
        return $this->form;
    }

    /**
     * @inheritDoc
     */
    public function getBaseForm(): Form
    {
        if ($this->form instanceof FormDecoratorInterface) {
            return $this->form->getBaseForm();
        }

        return $this->form;
    }


}
