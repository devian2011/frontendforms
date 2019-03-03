<?php

namespace Devian\FrontendForms;

/**
 * Interface FormDecoratorInterface
 * @package Devian\FrontendForms
 */
interface FormDecoratorInterface
{

    /**
     * Возвращает базовую форму в независимости от того сколько декораторов было применено
     *
     * @return Form
     */
    public function getBaseForm(): Form;

    /**
     * Возвращает предыдущий интерфейс формы который был отправлен в декоратор
     *
     * @return FormInterface
     */
    public function getPreviousForm(): FormInterface;

}
