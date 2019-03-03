<?php

namespace Devian\FrontendForms\Fields;

/**
 * Class CheckboxField
 * @package Devian\FrontendForms\Fields
 */
class CheckboxField extends AbstractField
{

    const CODE = 'checkbox.field';

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
        return 'checkbox';
    }

    /**
     * @inheritDoc
     */
    public function validate(): bool
    {
        $result = false;
        $options = $this->getOptions();
        if(is_array($this->fieldValue)){
            if(empty($options)){
                $result = false;
            }else{
                $diff = array_diff($this->fieldValue, $this->getOptions());
                $result = empty($diff);
            }
        }else{
            if(empty($options)){
                $result = true;
            }else{
                $result = in_array($this->fieldValue, array_keys($options));
            }
        }

        return $result;
    }


}
