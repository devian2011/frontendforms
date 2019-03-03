<?php

namespace Devian\FrontendForms\Fields;

/**
 * Class StringField
 * @package Devian\FrontendForms\Field
 */
class StringField extends AbstractField
{

    public const CODE = 'string.field';

    /**
     * @inheritDoc
     */
    public function getSubType(): string
    {
        return 'string';
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

    public function validate(): bool
    {
        return is_string($this->fieldValue);
    }

    protected function riseFromSavedData()
    {
        // TODO: Implement riseFromDbData() method.
    }

}
