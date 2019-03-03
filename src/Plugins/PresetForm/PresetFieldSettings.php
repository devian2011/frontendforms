<?php

namespace Devian\FrontendForms\Plugins\PresetForm;

/**
 * Class PresetFieldSettings
 * @package Devian\FrontendForms\Plugins\PresetForm
 */
class PresetFieldSettings implements PresetFieldSettingsInterface
{

    /**
     * @var string
     */
    private $id;
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var false
     */
    private $isEditable = true;

    /**
     * @var bool
     */
    private $isHidden = true;

    /**
     * @var bool
     */
    private $notEmpty = false;

    /**
     * PresetFieldSettings constructor.
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->setId($settings['id']);
        $this->setValue(isset($settings['value']) ? $settings['value'] : null);
        $this->setIsEditable(isset($settings['isEditable']) ? $settings['isEditable'] : true);
        $this->setIsHidden(isset($settings['isHidden']) ? $settings['isHidden'] : false);
        $this->setNotEmpty(isset($settings['notEmpty']) ? $settings['notEmpty'] : false);
    }

    /**
     * @return array
     */
    public function getArrayNotation(): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'isEditable' => $this->isEditable,
            'isHidden' => $this->isHidden,
            'notEmpty' => $this->notEmpty,
        ];
    }

    /**
     * @return mixed
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): PresetFieldSettingsInterface
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): PresetFieldSettingsInterface
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function isEditable(): bool
    {
        return $this->isEditable;
    }

    /**
     * @param bool $isEditable
     */
    public function setIsEditable(bool $isEditable): PresetFieldSettingsInterface
    {
        $this->isEditable = $isEditable;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->isHidden;
    }

    /**
     * @param bool $isHidden
     */
    public function setIsHidden(bool $isHidden): PresetFieldSettingsInterface
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    /**
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return $this->notEmpty;
    }

    /**
     * @param bool $isRequired
     */
    public function setNotEmpty(bool $notEmpty): PresetFieldSettingsInterface
    {
        $this->notEmpty = $notEmpty;

        return $this;
    }

}
