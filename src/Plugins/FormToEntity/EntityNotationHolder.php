<?php

namespace Devian\FrontendForms\Plugins\FormToEntity;

/**
 * Class EntityNotationHolder
 * @package Devian\FrontendForms\Plugins\FormToEntity
 */
class EntityNotationHolder
{
    /**
     * @var EntityNotation
     */
    private $notation;

    /**
     * EntityNotationHolder constructor.
     * @param EntityNotation $entityNotation
     */
    public function __construct(EntityNotation $entityNotation)
    {
        $this->notation = $entityNotation;
    }

    /**
     * @return EntityNotation
     */
    public function asIs()
    {
        return $this->notation;
    }

    /**
     * @return array
     */
    public function asArray()
    {
        $entity = [
            'name' => $this->notation->getName(),
        ];
        foreach ($this->notation->getProperties() as $property) {
            $entity['properties'][] = [
                'code' => $property->getCode(),
                'name' => $property->getName(),
                'realValue' => $property->getRealValue(),
                'humanReadableValue' => $property->getHumanReadableValue(),
            ];
        }

        return $entity;
    }

    /**
     * @return string
     */
    public function asJson()
    {
        return json_encode($this->notation);
    }

    /**
     * @return string
     */
    public function serialized()
    {
        return serialize($this->notation);
    }

}
