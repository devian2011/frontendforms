<?php
namespace Devian\FrontendForms;

use AppBundle\Core\Data\Provider\DataProviderInterface;
use Devian\FrontendForms\Fields\AbstractField;
use Devian\FrontendForms\Fields\FieldInterface;
use Devian\FrontendForms\Fields\FieldMapper;
use Devian\FrontendForms\Fields\MetaInfoSafeDataInterface;
use Devian\FrontendForms\Exceptions\FormNotValidException;

/**
 * Class Form
 * @package Devian\FrontendForms
 */
class Form implements FormInterface
{
    /**
     * @var FormDataInterface
     */
    private $form;

    /**
     * @var FieldMapper
     */
    private $fieldMapper;

    /**
     * @var AbstractField[]
     */
    private $fields = [];
    /**
     * @var array
     */
    private $values = [];

    /**
     * @var array
     */
    private $formErrors = [];

    /**
     * @var array
     */
    private $fieldRelations = [];

    /**
     * Массив где ключ это человекопонятный код поля, а значение это уникальный индекс поля
     *
     * @var array
     */
    private $codeToIdRelation = [];

    /**
     * Form constructor.
     * @param FormDataInterface $form
     * @param DataProviderInterface $dataProvider
     */
    public function __construct(FormDataInterface $form, DataProviderInterface $dataProvider)
    {
        $this->form = $form;
        $this->fieldMapper = new FieldMapper($dataProvider);
        $this->build();
    }

    /**
     * ID формы
     *
     * @return string
     */
    public function getId()
    {
        return $this->form->getId();
    }

    /**
     * Имя формы (кодовое)
     *
     * @return string
     */
    public function getFormName(): string
    {
        return $this->form->getName();
    }

    /**
     * Собираем поля для формы
     */
    protected function build()
    {
        foreach ($this->form->getFields() as $value) {
            if ($value instanceof MetaInfoSafeDataInterface) {
                $field = $this->fieldMapper->getField($value->getType());
                $field->setMetaInfoDTO($value);
                $this->fields[$value->getUniqueFieldId()] = $field;
                $this->codeToIdRelation[$value->getFieldProgrammingCode()] = $value->getUniqueFieldId();
                if ($field->isLinkedField()) {
                    $this->fieldRelations[$value->getUniqueFieldId()] = array_keys($field->linkedWith());
                }
            }
        }
        //Проходим и проставляем дефолтовые настройки для связанных полей
        foreach ($this->fieldRelations as $fieldId => $relations) {
            $relationFieldData = [];
            foreach ($relations as $relationFieldId) {
                $relationFieldData[$relationFieldId] = $this->fields[$relationFieldId]->getValue();
            }
            $this->fields[$fieldId]->setLinkedFieldValues($relationFieldData);
        }
    }


    /**
     * Проставляем переданные значения для формы
     *
     * @param array $values
     */
    public function loadData(array $values)
    {
        $this->values = $values;
        foreach ($this->values as $id => $value) {
            $this->fields[$id]->setValue($value);
        }
        foreach ($this->fieldRelations as $fieldId => $relations) {
            $relationFieldData = [];
            foreach ($relations as $relationFieldId) {
                $relationFieldData[$relationFieldId] = $this->fields[$relationFieldId]->getValue();
            }
            $this->fields[$fieldId]->setLinkedFieldValues($relationFieldData);
        }
    }

    /**
     * @param string $fieldId
     *
     * @return FieldInterface|null
     */
    public function getField(string $fieldId): ?FieldInterface
    {
        return isset($this->fields[$fieldId]) ? $this->fields[$fieldId] : null;
    }

    /**
     * @param string $fieldProgrammingCode
     *
     * @return FieldInterface|null
     */
    public function getFieldByCode(string $fieldProgrammingCode): ?FieldInterface
    {
        if (!empty($this->codeToIdRelation[$fieldProgrammingCode])) {
            return $this->getField($this->codeToIdRelation[$fieldProgrammingCode]);
        }

        return null;
    }

    /**
     * Возвращает массив полей, где ключ это человекочитаемое название поля,а значение -> FieldInterface
     *
     * @see FieldInterface
     * @return FieldInterface[]
     */
    public function getFieldsWithProgrammingCodeMapping(): array
    {
        $result = [];
        $fields = $this->getFields();
        foreach ($this->codeToIdRelation as $name => $id) {
            $result[$name] = $fields[$id];
        }

        return $result;
    }

    /**
     * @return FieldInterface[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Возвращает массив ключ значений где ключ это человекочитаемое название поля,а значение, это значение этого поля
     *
     * @return array
     */
    public function getFieldProgrammingCodeValues(): array
    {
        $result = [];
        foreach ($this->fields as $field) {
            $result[$field->getFieldProgrammingCode()] = $field->getValue();
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getFieldValues()
    {
        $result = [];
        foreach ($this->fields as $id => $field) {
            $result[$id] = $field->getValue();
        }

        return $result;
    }

    /**
     * @return void
     * @throws FormNotValidException
     */
    public function validate(): void
    {
        $errors = 0;
        foreach ($this->fields as $name => $field) {
            //проверяем интерфейс
            if ($field instanceof ValidatorInterface) {
                //Валидируем значение
                if (!$field->validate()) {
                    //Добавляем сообщение об ошибке
                    $this->formErrors[$name] = $field->getErrorMessage();
                    $errors += 1;
                }
            }
        }
        if ($errors > 0) {
            throw new FormNotValidException();
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->formErrors;
    }


}
