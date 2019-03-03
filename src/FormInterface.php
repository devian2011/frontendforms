<?php
/**
 * Created by PhpStorm.
 * User: romanov
 * Date: 30.01.2019
 * Time: 17:46
 */

namespace Devian\FrontendForms;


use Devian\FrontendForms\Exceptions\FormNotValidException;
use Devian\FrontendForms\Fields\FieldInterface;

interface FormInterface
{

    /**
     * ID формы
     *
     * @return string
     */
    public function getId();

    /**
     * Имя формы (кодовое)
     *
     * @return string
     */
    public function getFormName(): string;


    /**
     * Проставляем переданные значения для формы
     *
     * @param array $values
     */
    public function loadData(array $values);

    /**
     * @param string $fieldId
     *
     * @return FieldInterface|null
     */
    public function getField(string $fieldId): ?FieldInterface;

    /**
     * @param string $fieldProgrammingCode
     *
     * @return FieldInterface|null
     */
    public function getFieldByCode(string $fieldProgrammingCode): ?FieldInterface;

    /**
     * Возвращает массив полей, где ключ это человекочитаемое название поля,а значение -> FieldInterface
     *
     * @see FieldInterface
     * @return FieldInterface[]
     */
    public function getFieldsWithProgrammingCodeMapping(): array;

    /**
     * @return FieldInterface[]
     */
    public function getFields(): array;

    /**
     * Возвращает массив ключ значений где ключ это человекочитаемое название поля,а значение, это значение этого поля
     *
     * @return array
     */
    public function getFieldProgrammingCodeValues(): array;

    /**
     * @return array
     */
    public function getFieldValues();

    /**
     * @return void
     * @throws FormNotValidException
     */
    public function validate(): void;

    /**
     * @return array
     */
    public function getErrors(): array;

}
