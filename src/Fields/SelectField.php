<?php

namespace Devian\FrontendForms\Fields;

/**
 * Class SelectField
 * @package Devian\FrontendForms\Field
 */
class SelectField extends AbstractField
{

    public const CODE = 'select.field';

    /**
     * @inheritDoc
     */
    public function getSubType(): string
    {
        return 'select';
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return 'select';
    }

    public function getFieldCode(): string
    {
        return self::CODE;
    }

    public function validate(): bool
    {
        return in_array($this->fieldValue, array_keys($this->getOptions()));
    }

    protected function riseFromSavedData()
    {
        // TODO: Implement riseFromDbData() method.
    }

}
