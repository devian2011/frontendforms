<?php

namespace Devian\FrontendForms\Meta\Builders\MetaToForm;

use Devian\FrontendForms\Meta\Builders\MetaToForm\Dto\DbProviderListInterface;

/**
 * Class DbOptionList
 * @package Devian\FrontendForms\Meta\Builders\MetaToForm
 */
class DbOptionList
{
    /**
     * @var DbProviderListInterface
     */
    private $dependencyList;

    /**
     * DbOptionList constructor.
     * @param DbProviderListInterface $dbDependencyList
     */
    public function __construct(DbProviderListInterface $dbDependencyList)
    {
        $this->dependencyList = $dbDependencyList;
    }

    /**
     * @return array
     */
    public function getList()
    {
        $result = [];
        foreach ($this->dependencyList->getProviders() as $dependency) {
            $dependentKeys = [];
            foreach ($dependency->getDependents() as $dependent) {
                $dependentKeys[] = $dependent->getName();
            }
            $result[$dependency->getCode()] = [
                'code' => $dependency->getCode(),
                'dependent' => $dependentKeys,
            ];
        }

        return $result;
    }

}
