<?php

namespace Devian\FrontendForms\Plugins\PresetForm;

/**
 * Interface PresetFieldSettingsInterface
 * @package Devian\FrontendForms\Plugins\PresetForm
 */
interface PresetFieldSettingsInterface
{

    /**
     * @return array
     */
    public function getArrayNotation(): array;

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return bool
     */
    public function isEditable(): bool;

    /**
     * @param string $id
     * @return void
     */
    public function setId(string $id): self;

    /**
     * @param $value
     * @return void
     */
    public function setValue($value): self;

    /**
     * @param bool $isEditable
     * @return void
     */
    public function setIsEditable(bool $isEditable): self;


    /**
     * @return bool
     */
    public function isHidden(): bool;

    /**
     * @param bool $isHidden
     */
    public function setIsHidden(bool $isHidden): self;

    /**
     * @return bool
     */
    public function isNotEmpty(): bool;

    /**
     * @param bool $isRequired
     */
    public function setNotEmpty(bool $notEmpty): self;

}
