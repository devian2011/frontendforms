<?php

namespace Devian\FrontendForms\Meta\Builders\MetaToForm;

use Devian\FrontendForms\Fields\MetaInfoSafeDataInterface;
use Devian\FrontendForms\FormDataInterface;

/**
 * Class DtoMetaDataBuilder
 * @package Devian\FrontendForms\Meta\Builders\MetaToForm
 */
class DtoMetaDataBuilder
{
    /**
     * Чтобы не плодить лишнюю ненужную сушность делаем анонимный класс и не паримся.
     * @see http://php.net/manual/ru/language.oop5.anonymous.php
     *
     * @param $id
     * @param $name
     * @return FormDataInterface
     */
    public static function buildFormDataInterface($id, $name): FormDataInterface
    {
        return new class($id, $name) implements FormDataInterface
        {

            private $id;
            private $name;
            private $fields = [];

            /**
             * constructor.
             * @param $id
             */
            public function __construct($id, $name)
            {
                $this->id = $id;
                $this->name = $name;
            }

            /**
             * @inheritDoc
             */
            public function getId()
            {
                return $this->id;
            }

            /**
             * @inheritDoc
             */
            public function getName(): string
            {
                return $this->name;
            }

            /**
             * @inheritDoc
             */
            public function setName(string $name)
            {
                $this->name = $name;
            }

            /**
             * @inheritDoc
             */
            public function getFields(): array
            {
                return $this->fields;
            }

            /**
             * @inheritDoc
             */
            public function addField(MetaInfoSafeDataInterface $metaInfoSafeData)
            {
                $this->fields[] = $metaInfoSafeData;
            }

            /**
             * @inheritDoc
             */
            public function setFields(array $fields)
            {
                $this->fields = $fields;
            }
        };
    }

    /**
     * Чтобы не плодить лишнюю ненужную сушность делаем анонимный класс и не паримся.
     * @see http://php.net/manual/ru/language.oop5.anonymous.php
     *
     * @param $uniqueFieldId
     * @return MetaInfoSafeDataInterface
     */
    public static function buildFormFieldDataInterface($uniqueFieldId): MetaInfoSafeDataInterface
    {
        return new class($uniqueFieldId) implements MetaInfoSafeDataInterface
        {

            protected $uniqueFieldId;
            protected $fieldCode;
            protected $name;
            protected $fieldProgrammingCode;
            protected $type;
            protected $data;
            protected $linked;
            protected $isRequired;


            public function __construct($uniqueFieldId)
            {
                $this->uniqueFieldId = empty($uniqueFieldId) ? uniqid() : $uniqueFieldId;
            }

            public function getUniqueFieldId()
            {
                return $this->uniqueFieldId;
            }

            /**
             * @return mixed
             */
            public function getFieldCode(): string
            {
                return $this->fieldCode;
            }

            /**
             * @param mixed $fieldCode
             */
            public function setFieldCode($fieldCode): void
            {
                $this->fieldCode = $fieldCode;
            }

            /**
             * @return mixed
             */
            public function getName(): string
            {
                return $this->name;
            }

            /**
             * @param mixed $name
             */
            public function setName($name): void
            {
                $this->name = $name;
            }

            /**
             * @return mixed
             */
            public function getFieldProgrammingCode(): string
            {
                return $this->fieldProgrammingCode;
            }

            /**
             * @param mixed $fieldProgrammingCode
             */
            public function setFieldProgrammingCode($fieldProgrammingCode): void
            {
                $this->fieldProgrammingCode = $fieldProgrammingCode;
            }

            /**
             * @return mixed
             */
            public function getType()
            {
                return $this->type;
            }

            /**
             * @param mixed $type
             */
            public function setType($type): void
            {
                $this->type = $type;
            }

            /**
             * @return mixed
             */
            public function getData(): array
            {
                return $this->data;
            }

            /**
             * @param mixed $data
             */
            public function setData($data): void
            {
                $this->data = $data;
            }

            /**
             * @return mixed
             */
            public function getLinked(): array
            {
                return $this->linked;
            }

            /**
             * @param mixed $linked
             */
            public function setLinked($linked): void
            {
                $this->linked = $linked;
            }

            /**
             * @return mixed
             */
            public function isRequired(): bool
            {
                return $this->isRequired;
            }

            /**
             * @param mixed $isRequired
             */
            public function setIsRequired($isRequired): void
            {
                $this->isRequired = $isRequired;
            }

        };
    }

}
