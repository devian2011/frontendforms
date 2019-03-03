<?php

namespace Devian\FrontendForms\Meta\Builders\MetaToForm;

use Devian\FrontendForms\Exceptions\FormNotValidException;
use Devian\FrontendForms\Exceptions\NotValidFormNotationException;

/**
 * Class FieldDataOptionEntity
 * @package Devian\FrontendForms\Meta\Builders\MetaToForm
 */
class FieldDataOptionEntity
{

    /**
     * @var array
     */
    private $notation = [];


    protected const DEFAULT_FIELD_DATA_OPTIONS_PARAMS = [
        "manual" => [],
        "db" => "",
    ];

    /**
     * FieldDataOptionEntity constructor.
     * @param array $dataNotation
     * @throws NotValidFormNotationException
     */
    public function __construct(array $dataNotation)
    {
        $this->notation = $dataNotation;
        $this->validate();
    }

    /**
     * @throws NotValidFormNotationException
     */
    protected function validate()
    {
        if(!isset($this->notation['manual']) || !isset($this->notation['db'])){
            throw new NotValidFormNotationException("Options with names manual and db is required!!!");
        }
    }

    /**
     * @return array
     */
    public function getManual(): array
    {
        return $this->notation['manual'];
    }

    /**
     * @return string
     */
    public function getDb(): string
    {
        return $this->notation['db'];
    }

}
