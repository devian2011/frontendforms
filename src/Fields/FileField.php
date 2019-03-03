<?php

namespace Devian\FrontendForms\Fields;

/**
 * Class FileField
 * @package Devian\FrontendForms\Fields
 */
class FileField extends AbstractField
{

    public const CODE = 'file.field';

    /**
     * @inheritDoc
     */
    public function getFieldCode(): string
    {
        return self::CODE;
    }

    /**
     * @inheritDoc
     */
    protected function riseFromSavedData()
    {
        // TODO: Implement riseFromSavedData() method.
    }


    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return 'file';
    }

    /**
     * @inheritDoc
     */
    public function getSubType(): string
    {
        return 'file';
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        return true;
    }

}
