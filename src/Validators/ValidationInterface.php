<?php

namespace Devian\FrontendForms\Validators;

/**
 * Interface ValidationInterface
 * @package Devian\FrontendForms\Validators
 */
interface ValidationInterface
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value): bool;

}
