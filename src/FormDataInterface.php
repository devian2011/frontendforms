<?php

namespace Devian\FrontendForms;

use Devian\FrontendForms\Fields\MetaInfoSafeDataInterface;

/**
 * Interface FormDataInterface
 * @package Devian\FrontendForms
 */
interface FormDataInterface
{

    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return mixed
     */
    public function setName(string $name);

    /**
     * @return MetaInfoSafeDataInterface[]
     */
    public function getFields(): array;

    /**
     * @param MetaInfoSafeDataInterface $metaInfoSafeData
     */
    public function addField(MetaInfoSafeDataInterface $metaInfoSafeData);

    /**
     * @param MetaInfoSafeDataInterface[] $fields
     */
    public function setFields(array $fields);

}
