<?php

namespace Devian\FrontendForms\Fields;

/**
 * Class TextField
 * @package Devian\FrontendForms\Field
 */
class TextField extends AbstractField
{

    public const CODE = 'text.field';

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return 'string';
    }

    /**
     * @inheritdoc
     */
    public function getFieldCode(): string
    {
        return self::CODE;
    }

    /**
     * @inheritDoc
     */
    public function getSubType(): string
    {
        return 'text';
    }

    /**
     * @inheritdoc
     */
    public function validate(): bool
    {
        return is_string($this->fieldValue);
    }

    protected function riseFromSavedData()
    {
        // TODO: Implement riseFromDbData() method.
    }


}
