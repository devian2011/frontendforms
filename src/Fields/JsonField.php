<?php

namespace Devian\FrontendForms\Fields;

/**
 * Class JsonField
 * @package Devian\FrontendForms\Fields
 */
class JsonField extends AbstractField
{
    public const CODE = 'json.field';

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
        return 'json';
    }

    /**
     * @inheritDoc
     */
    public function validate(): bool
    {
        $value = $this->getValue();
        if(empty($value) && !$this->isRequired()){
            return true;
        }

        $result = \json_decode($this->getValue(), true);

        return is_array($result);
    }


}
