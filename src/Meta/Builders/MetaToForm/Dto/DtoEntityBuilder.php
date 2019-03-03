<?php

namespace Devian\FrontendForms\Meta\Builders\MetaToForm\Dto;

/**
 * Class DtoEntityBuilder
 * @package Devian\FrontendForms\Meta\Builders\MetaToForm\Dto
 */
class DtoEntityBuilder
{
    /**
     * @return DbProviderListInterface
     */
    public static function getDbProviderListEntity(array $providers)
    {
        return new class($providers) implements DbProviderListInterface
        {
            /**
             * @var DbProvidersInterface[]|array
             */
            private $providers;

            /**
             * DtoProviderList constructor.
             * @param DbProvidersInterface[] $providers
             */
            public function __construct(array $providers)
            {
                $this->providers = $providers;
            }

            /**
             * @inheritDoc
             */
            public function getProviders(): array
            {
                return $this->providers;
            }
        };
    }

    /**
     * @return DbProvidersInterface
     */
    public static function getDbProviderEntity($class, $code, $dependents, $listKey, $listValue)
    {
        return new class($class, $code, $dependents, $listKey, $listValue) implements DbProvidersInterface
        {
            private $class;
            private $code;
            /**
             * @var DbDependentInterface[]
             */
            private $dependents = [];
            private $listKey;
            private $listValue;


            public function __construct($class, $code, array $dependents, $listKey, $listValue)
            {
                foreach ($dependents as $dependent) {
                    $this->dependents[$dependent->getName()] = $dependent;
                }
                $this->class = $class;
                $this->code = $code;
                $this->listKey = $listKey;
                $this->listValue = $listValue;
            }

            /**
             * @inheritDoc
             */
            public function getClass()
            {
                return $this->class;
            }

            /**
             * @inheritDoc
             */
            public function getDependentColumn($name)
            {
                return $this->dependents[$name]->getField();
            }


            /**
             * @return mixed
             */
            public function getCode()
            {
                return $this->code;
            }

            /**
             * @return mixed
             */
            public function getDependents()
            {
                return $this->dependents;
            }

            /**
             * @return mixed
             */
            public function getListKey()
            {
                return $this->listKey;
            }

            /**
             * @return mixed
             */
            public function getListValue()
            {
                return $this->listValue;
            }
        };
    }

    /**
     * @return DbDependentInterface
     */
    public static function getDependentEntity($name, $field)
    {
        return new class($name, $field) implements DbDependentInterface
        {

            private $name;
            private $field;

            public function __construct($name, $field)
            {
                $this->name = $name;
                $this->field = $field;
            }

            /**
             * @return mixed
             */
            public function getName()
            {
                return $this->name;
            }

            /**
             * @return mixed
             */
            public function getField()
            {
                return $this->field;
            }
        };
    }

}
