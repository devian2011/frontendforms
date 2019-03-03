<?php
namespace Devian\FrontendForms\Meta\Builders\MetaToForm\Dto;

/**
 * Interface DbProviderListInterface
 * @package Devian\FrontendForms\Meta\Builders\MetaToForm\Dto
 */
interface DbProviderListInterface
{

    /**
     * @return DbProvidersInterface[]
     */
    public function getProviders(): array;

}
