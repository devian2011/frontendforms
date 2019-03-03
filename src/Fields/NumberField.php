<?php

namespace Devian\FrontendForms\Fields;

/**
 * Class NumberField
 * @package Devian\FrontendForms\Field
 */
class NumberField extends AbstractField
{

    public const CODE = 'number.field';

    /**
     * @inheritDoc
     */
    public function getSubType(): string
    {
        return 'number';
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return 'string';
    }

    public function getFieldCode(): string
    {
        return self::CODE;
    }

    protected function riseFromSavedData()
    {
        // TODO: Implement riseFromSavedData() method.
    }

    public function validate(): bool
    {
        return is_numeric($this->fieldValue);
    }


}
