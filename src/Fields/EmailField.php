<?php
namespace Devian\FrontendForms\Fields;

/**
 * Class EmailField
 * @package Devian\FrontendForms\Fields
 */
class EmailField extends AbstractField
{

    public const CODE = 'email.field';

    /**
     * @inheritDoc
     */
    public function getSubType(): string
    {
        return 'email';
    }

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
    public function getType(): string
    {
        return 'string';
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
    public function validate(): bool
    {
        if (!preg_match('#^[A-z\.\-\_]+@{1,1}[A-z\.\-\_]+$#', $this->fieldValue)) {
            $this->errorMessage = "Поле " . $this->getFieldName() . " не является e-mail";

            return false;
        }

        return true;
    }


}