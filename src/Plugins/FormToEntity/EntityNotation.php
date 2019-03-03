<?php

namespace Devian\FrontendForms\Plugins\FormToEntity;

/**
 * Class EntityNotation
 * @package Devian\FrontendForms\Plugins\FormToEntity
 */
class EntityNotation
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var EntityProperty[]
     */
    private $properties = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return EntityProperty[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param EntityProperty[] $properties
     */
    public function setProperties(array $properties): void
    {
        $this->properties = $properties;
    }

    /**
     * @param EntityProperty $property
     */
    public function addProperty(EntityProperty $property)
    {
        $this->properties[] = $property;
    }


}
