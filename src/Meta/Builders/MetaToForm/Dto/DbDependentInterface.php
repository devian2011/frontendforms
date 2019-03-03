<?php

namespace Devian\FrontendForms\Meta\Builders\MetaToForm\Dto;

/**
 * Interface DbDependentInterface
 * @package Devian\FrontendForms\Meta\Builders\MetaToForm\Dto
 */
interface DbDependentInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getField();

}
