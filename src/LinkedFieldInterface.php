<?php

namespace Devian\FrontendForms;

/**
 * Interface LinkedFieldInterface
 * @package Devian\FrontendForms
 */
interface LinkedFieldInterface
{
    /**
     * Возвращаем true если поле имеет связанные данные
     *
     * @return bool
     */
    public function isLinkedField(): bool;

    /**
     * Проставляем значения связанных полей
     *
     * @param array $values
     */
    public function setLinkedFieldValues(array $values);

    /**
     * Список HashMap где ключ ID поля а значение колонка в DB по которой осуществляется поиск с которыми связано текущее поле
     *
     *
     * К пирмеру
     * ```php
     * [
     *     "1afe43231" => 'client_id'
     *     "3de5412dc" => 'person_id'
     * ]
     * ```
     *
     *
     * @return array
     */
    public function linkedWith(): array;

}
