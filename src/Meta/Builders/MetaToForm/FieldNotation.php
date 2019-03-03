<?php

namespace Devian\FrontendForms\Meta\Builders\MetaToForm;

use Devian\FrontendForms\Exceptions\NotValidFormNotationException;

/**
 * Class FieldNotation
 * @package Devian\FrontendForms\Meta\Builders\MetaToForm
 */
class FieldNotation
{
    /**
     * @var array
     */
    private $notation = [];

    protected const NOTATION_DEFAULT_PARAMS = [
        'id' => null,
        'name' => null,
        'code' => null,
        'default' => null,
        'fieldCode' => null,
        'type' => null,
        'subType' => null,
        'isLinked' => false,
        'isRequired' => false,
        'options' => [],
        'linkedWith' => [],
        'isHidden' => false,
        'isEditable' => true,
    ];

    protected const REQUIRED_FIELD_NOTATION_FIELDS = [
        'name', 'code', 'default', 'type', 'subType', 'options', 'fieldCode',
    ];

    /**
     * FieldNotation constructor.
     * @param array $fieldNotation
     * @throws NotValidFormNotationException
     */
    public function __construct(array $fieldNotation)
    {
        $this->notation = $fieldNotation;
        $this->validate();
        $this->setDefaultValues();
        $this->wrapOptions();
    }

    /**
     * @throws NotValidFormNotationException
     */
    protected function validate()
    {
        $diff = array_intersect(array_keys($this->notation), self::REQUIRED_FIELD_NOTATION_FIELDS);
        if (sizeof($diff) !== sizeof(self::REQUIRED_FIELD_NOTATION_FIELDS)) {
            throw new NotValidFormNotationException("Not set required field notation options: " . implode(',', $diff));
        }
    }

    /**
     * Оборачиваем опции также в объект
     * @throws NotValidFormNotationException
     */
    protected function wrapOptions()
    {
        $this->notation['options'] = new FieldDataOptionEntity($this->notation['options']);
    }

    /**
     *
     */
    protected function setDefaultValues()
    {
        $this->notation = array_merge(self::NOTATION_DEFAULT_PARAMS, $this->notation);
    }

    /**
     * @return int|string|null
     */
    public function getId()
    {
        return isset($this->notation['id']) ? $this->notation['id'] : null;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->notation['name'];
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->notation['code'];
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->notation['default'];
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->notation['type'];
    }

    /**
     * @return mixed
     */
    public function getSubType()
    {
        return $this->notation['subType'];
    }

    /**
     * @return mixed
     */
    public function isLinked()
    {
        return $this->notation['isLinked'];
    }

    /**
     * @return mixed
     */
    public function isRequired()
    {
        return $this->notation['isRequired'];
    }

    /**
     * @return DbOptionList
     */
    public function getOptions(): FieldDataOptionEntity
    {
        return $this->notation['options'];
    }

    /**
     * @return mixed
     */
    public function getLinkedWith()
    {
        return $this->notation['linkedWith'];
    }

    /**
     * @return mixed
     */
    public function isHidden()
    {
        return $this->notation['isHidden'];
    }

    /**
     * @return string
     */
    public function getFieldCode()
    {
        return $this->notation['fieldCode'];
    }

    /**
     * @return mixed
     */
    public function isEditable()
    {
        return $this->notation['isEditable'];
    }

}
