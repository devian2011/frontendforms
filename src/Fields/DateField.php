<?php

namespace Devian\FrontendForms\Fields;

/**
 * Class DateField
 * @package Devian\FrontendForms\Fields
 */
class DateField extends AbstractField
{

    public const CODE = 'date.field';

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
        return 'string';
    }

    /**
     * @inheritDoc
     */
    public function getSubType(): string
    {
        return 'date';
    }

    /**
     * @inheritDoc
     */
    public function validate(): bool
    {
        $time = \DateTime::createFromFormat('Y-m-d', $this->getValue());

        return $time !== false;
    }


}
