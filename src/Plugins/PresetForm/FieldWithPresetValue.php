<?php

namespace Devian\FrontendForms\Plugins\PresetForm;

use Devian\FrontendForms\Fields\FieldInterface;
use Devian\FrontendForms\Fields\MetaInfoSafeDataInterface;

/**
 * Class FieldWithPresetValue
 * @package Devian\FrontendForms\Plugins\PresetForm
 */
class FieldWithPresetValue implements FieldInterface
{

    /**
     * @var FieldInterface
     */
    private $field;

    /**
     * @var PresetFieldSettings
     */
    private $fieldSettings;

    /**
     * FieldWithPresetValue constructor.
     *
     * @param FieldInterface $field
     */
    public function __construct(FieldInterface $field, PresetFieldSettings $fieldSettings)
    {
        $this->field = $field;
        $this->fieldSettings = $fieldSettings;
    }

    /**
     * @inheritDoc
     */
    public function getFieldCode(): string
    {
        return $this->field->getFieldCode();
    }

    /**
     * @inheritDoc
     */
    public function getFieldProgrammingCode(): string
    {
        return $this->field->getFieldProgrammingCode();
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return $this->field->getType();
    }

    /**
     * @inheritDoc
     */
    public function getSubType(): string
    {
        return $this->field->getSubType();
    }

    /**
     * @inheritDoc
     */
    public function setMetaInfoDTO(MetaInfoSafeDataInterface $metaInfoSafeData)
    {
        $this->field->setMetaInfoDTO($metaInfoSafeData);
    }

    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        $this->field->setValue($value);
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return $this->field->getValue();
    }

    /**
     * @inheritDoc
     */
    public function getFieldId(): string
    {
        return $this->field->getFieldId();
    }

    /**
     * @inheritDoc
     */
    public function getFieldName()
    {
        return $this->field->getFieldName();
    }

    /**
     * @inheritDoc
     */
    public function getSerializedFieldValue(): ?MetaInfoSafeDataInterface
    {
        return $this->field->getSerializedFieldValue();
    }

    /**
     * @inheritDoc
     */
    public function setOptions(array $options)
    {
        $this->field->setOptions($options);
    }

    /**
     * @inheritDoc
     */
    public function getOptions(): array
    {
        return $this->field->getOptions();
    }

    /**
     * @inheritDoc
     */
    public function setDefaultValue($defaultValue)
    {
        $this->fieldSettings->setValue($defaultValue);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultValue()
    {
        return $this->fieldSettings->getValue();
    }

    /**
     * @inheritDoc
     */
    public function setIsEditable(bool $isEditable)
    {
        $this->field->setIsEditable($isEditable);
    }

    /**
     * @inheritDoc
     */
    public function getIsEditable(): bool
    {
        return $this->fieldSettings->isEditable();
    }

    /**
     * @inheritDoc
     */
    public function getIsHidden(): bool
    {
        return $this->fieldSettings->isHidden();
    }

    /**
     * @inheritDoc
     */
    public function setIsHidden(bool $isHidden)
    {
        $this->fieldSettings->setIsHidden($isHidden);
    }

    /**
     * @inheritDoc
     */
    public function isRequired(): bool
    {
        if ($this->field->isRequired() === true) {
            return true;
        } else {
            return $this->fieldSettings->isNotEmpty();
        }
    }

    /**
     * @inheritDoc
     */
    public function isLinkedField(): bool
    {
        return $this->field->isLinkedField();
    }

    /**
     * @inheritDoc
     */
    public function setLinkedFieldValues(array $values)
    {
        $this->field->setLinkedFieldValues($values);
    }

    /**
     * @inheritDoc
     */
    public function linkedWith(): array
    {
        return $this->field->linkedWith();
    }

    /**
     * @inheritDoc
     */
    public function validate(): bool
    {
        return $this->field->validate();
    }

    /**
     * @inheritDoc
     */
    public function getErrorMessage(): string
    {
        return $this->field->getErrorMessage();
    }


}
