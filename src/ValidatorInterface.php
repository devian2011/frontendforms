<?php

namespace Devian\FrontendForms;

/**
 * interface ValidatorInterface
 * @package Devian\FrontendForms\Fields
 */
interface ValidatorInterface
{

    /**
     * Валидно ли переданное значение
     *
     * @return bool
     */
    public function validate(): bool;

    /**
     * Возвращает текстовую ошибку если поле не валидно
     *
     * @return string
     */
    public function getErrorMessage(): string;

}
