<?php

namespace Devian\FrontendForms\Meta\Builders\MetaToForm;

use Devian\FrontendForms\Exceptions\NotValidFormNotationException;

/**
 * Class FormNotation
 * @package Devian\FrontendForms\Meta\Builders\MetaToForm
 */
class FormNotation
{
    /**
     * @var array
     */
    private $notation = [];

    /**
     * @var FieldNotation[]
     */
    private $fields;

    /**
     * FormNotation constructor.
     * @param array $notation
     * @throws NotValidFormNotationException
     */
    public function __construct(array $notation)
    {
        $this->notation = $notation;
        $this->validate();
        $this->loadFields();
    }

    /**
     * @throws NotValidFormNotationException
     */
    protected function validate()
    {
        if (!isset($this->notation['name'])) {
            throw new NotValidFormNotationException("Unknown form name, cannot create from without name!");
        }
        if (!isset($this->notation['fields'])) {
            throw new NotValidFormNotationException("Form notation doesn't consist key fields!!!, cannot create form without fields");
        }
    }

    /**
     * @throws NotValidFormNotationException
     */
    private function loadFields()
    {
        foreach ($this->notation['fields'] as $field) {
            $notation = new FieldNotation($field);
            $this->fields[$notation->getCode()] = $notation;
        }
    }

    /**
     * @return int|string|null
     */
    public function getId()
    {
        return isset($this->notation['id']) ? $this->notation['id'] : null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->notation['name'];
    }

    /**
     * @return FieldNotation[]
     */
    public function getFields()
    {
        return $this->fields;
    }

}
