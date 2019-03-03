<?php

namespace Devian\FrontendForms\Meta\Builders\MetaToForm\Dto;

/**
 * Interface DbProvidersInterface
 * @package Devian\FrontendForms\Meta\Builders\MetaToForm\Dto
 */
interface DbProvidersInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @return string
     */
    public function getClass();

    /**
     * @return DbDependentInterface[]
     */
    public function getDependents();

    /**
     * @param $name
     * @return string
     */
    public function getDependentColumn($name);

    /**
     * @return string
     */
    public function getListKey();

    /**
     * @return string
     */
    public function getListValue();

}
