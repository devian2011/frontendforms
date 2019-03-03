<?php

namespace Devian\FrontendForms\Fields;

use Devian\FrontendForms\LinkedFieldInterface;
use Devian\FrontendForms\ValidatorInterface;

/**
 * Interface FieldInterface
 * @package Devian\FrontendForms\Fields
 */
interface FieldInterface extends ValidatorInterface, LinkedFieldInterface
{
    /**
     * Возвращает код поля
     *
     * @return string
     */
    public function getFieldCode(): string;

    /**
     * Код для более лёгкого вызова названия поля из кода, какое-то понятное название
     * client_id, select_code, subject, email_to и т.д.
     *
     * @return string
     */
    public function getFieldProgrammingCode(): string;

    /**
     * Возвращает тип переменной в строковом виде (object,string,integer,float и т.д.)
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Подтип поля (string -> email, select -> multiselect и т.д.)
     *
     * @return string
     */
    public function getSubType(): string;

    /**
     * @param MetaInfoSafeDataInterface $metaInfoSafeData
     */
    public function setMetaInfoDTO(MetaInfoSafeDataInterface $metaInfoSafeData);

    /**
     * Установить текущее значение поля
     *
     * @param mixed $value
     */
    public function setValue($value);

    /**
     * Получить текущее значение поля
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Возвращает уникальныльный индекс поля
     *
     * @return string
     */
    public function getFieldId(): string;

    /**
     * Возвращает название поля для отображения пользователю
     *
     * @return string
     */
    public function getFieldName();

    /**
     * Возвращает объект для сохранения в базу данных
     *
     * @return MetaInfoSafeDataInterface|null
     */
    public function getSerializedFieldValue(): ?MetaInfoSafeDataInterface;

    /**
     * @param array $options
     */
    public function setOptions(array $options);

    /**
     * @return array
     */
    public function getOptions(): array;

    /**
     * @param mixed $defaultValue
     */
    public function setDefaultValue($defaultValue);

    /**
     * @return mixed
     */
    public function getDefaultValue();


    /**
     * @param bool $isEditable
     */
    public function setIsEditable(bool $isEditable);

    /**
     * @return bool
     */
    public function getIsEditable();

    /**
     * @return bool
     */
    public function getIsHidden();

    /**
     * @param bool $isHidden
     */
    public function setIsHidden(bool $isHidden);

    /**
     * @return bool
     */
    public function isRequired(): bool;

}