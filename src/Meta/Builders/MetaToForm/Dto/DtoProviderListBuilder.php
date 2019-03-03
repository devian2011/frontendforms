<?php

namespace Devian\FrontendForms\Meta\Builders\MetaToForm\Dto;

/**
 * Class DtoProviderListBuilder
 * @package Devian\FrontendForms\Meta\Builders\MetaToForm\Dto
 */
class DtoProviderListBuilder
{

    /**
     * @param array $dbProvidersList
     * @return DbProviderListInterface
     */
    public static function buildFromArray(array $dbProvidersList)
    {
        $providers = [];
        foreach ($dbProvidersList as $provider) {
            $dependents = [];
            if (isset($provider['dependent'])) {
                foreach ($provider['dependent'] as $depProvider => $column) {
                    $dependents[] = DtoEntityBuilder::getDependentEntity($depProvider, $column);
                }
            }
            $providers[] = DtoEntityBuilder::getDbProviderEntity(
                $provider['class'],
                $provider['code'],
                $dependents,
                $provider['listKey'],
                $provider['listValue']
            );
        }

        return DtoEntityBuilder::getDbProviderListEntity($providers);
    }

}
