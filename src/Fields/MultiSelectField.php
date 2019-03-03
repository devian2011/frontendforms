<?php

namespace Devian\FrontendForms\Fields;

/**
 * Class MultiSelectField
 * @package Devian\FrontendForms\Field
 */
class MultiSelectField extends AbstractField
{

    public const CODE = 'multi.select.field';


    /**
     * @inheritDoc
     */
    public function getSubType(): string
    {
        return 'multiple';
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
        $diff = array_diff($this->fieldValue, array_keys($this->getOptions()));
        if (!empty($diff)) {
            $this->errorMessage = "Переданы значения которых нет в указанных вариантах";
            return false;
        }
    }


    protected function riseFromSavedData()
    {
        // TODO: Implement riseFromDbData() method.
    }


}
