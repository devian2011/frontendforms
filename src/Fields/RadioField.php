<?php

namespace Devian\FrontendForms\Fields;

/**
 * Class RadioField
 * @package Devian\FrontendForms\Fields
 */
class RadioField extends AbstractField
{

    public const CODE = 'radio.field';

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
        return 'checkbox';
    }

    /**
     * @inheritDoc
     */
    public function getSubType(): string
    {
        return 'radio';
    }

    /**
     * @inheritDoc
     */
    public function validate(): bool
    {
        $diff = in_array($this->fieldValue, array_keys($this->getOptions()));
        return empty($diff);
    }


}
