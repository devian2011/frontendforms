<?php

namespace Devian\FrontendForms\Fields;

/**
 * Interface MetaInfoSaveDataInterface
 *
 * Описание методов для сериализации полей
 *
 * @package Devian\FrontendForms\Field
 */
interface MetaInfoSafeDataInterface
{

    /**
     * Уникальный ID поля, генерируется при сохранении, желательно что-нибудь из серии sha512 чтобы не было колизий
     *
     * @return mixed
     */
    public function getUniqueFieldId();

    /**
     * Код для более лёгкого вызова названия поля из кода, какое-то понятное название
     * client_id, select_code, subject, email_to и т.д.
     *
     * @return string
     */
    public function getFieldProgrammingCode(): string;

    /**
     * @param string $fieldProgrammingCode
     */
    public function setFieldProgrammingCode(string $fieldProgrammingCode): void;

    /**
     * Массив с ID связанных полей
     *
     * К пирмеру
     * ```php
     * [
     *     "1afe43231" => 'client_id'
     *     "3de5412dc" => 'person_id'
     * ]
     * ```
     *
     * @return array
     */
    public function getLinked(): array;

    /**
     * Добавляет ID связанных полей
     *
     * @param array $linked
     */
    public function setLinked(array $linked);

    /**
     * Код поля
     *
     * @param string $fieldCode
     * @return mixed
     */
    public function setFieldCode(string $fieldCode);

    /**
     * Название поля
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Название поля
     *
     * @param string $name
     */
    public function setName(string $name);

    /**
     * Код поля
     *
     * @return string
     */
    public function getFieldCode(): string;

    /**
     * Тип поля
     *
     * @return mixed
     */
    public function getType();

    /**
     * @param string $type Тип сохранённого Field
     * @return mixed
     */
    public function setType(string $type);

    /**
     * @return array Сохранённая информация по field, нужна чтобы восстановить инормацию по полю
     */
    public function getData(): array;

    /**
     * Устанавливает информацию из поля в массив
     *
     * @param array $data
     */
    public function setData(array $data);

    /**
     * Устанавливает является ли данное поле обязательным для заполнения
     *
     * @param bool $isRequired
     */
    public function setIsRequired(bool $isRequired);

    /**
     * Обязательно ли данное поле для заполнения
     *
     * @return bool
     */
    public function isRequired(): bool;

}
