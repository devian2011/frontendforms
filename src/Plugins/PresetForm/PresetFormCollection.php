<?php

namespace Devian\FrontendForms\Plugins\PresetForm;

/**
 * Class PresetFormCollection
 * @package Devian\FrontendForms\Plugins\PresetForm
 */
class PresetFormCollection
{
    /** @var PresetFieldSettingsInterface[] */
    private $store = [];

    /**
     * PresetFormCollection constructor.
     * @param PresetFieldSettingsInterface[] $settings
     */
    public function __construct(array $settings = [])
    {
        foreach ($settings as $setting) {
            $this->store[$setting->getId()] = $setting;
        }
    }

    /**
     * @param PresetFieldSettingsInterface $fieldSettings
     *
     * @return self
     */
    public function addPresetSetting(PresetFieldSettingsInterface $fieldSettings): self
    {
        $this->store[$fieldSettings->getId()] = $fieldSettings;

        return $this;
    }

    /**
     * @param string $fieldId
     * @return PresetFieldSettings|null
     */
    public function getPresetSettingByFieldId(string $fieldId): ?PresetFieldSettingsInterface
    {
        return isset($this->store[$fieldId]) ? $this->store[$fieldId] : null;
    }

    /**
     * @param $fieldId
     */
    public function removePresetSetting($fieldId)
    {
        unset($this->store[$fieldId]);
    }

    /**
     * @param $fieldId
     * @return bool
     */
    public function has($fieldId): bool
    {
        return isset($this->store[$fieldId]);
    }

    /**
     * @return array
     */
    public function getArrayNotation()
    {
        $notation = [];
        foreach ($this->store as $id => $field) {
            $notation[$id] = $field->getArrayNotation();
        }

        return $notation;
    }

    /**
     * @return PresetFieldSettingsInterface[]
     */
    public function getFieldsSettings(): array
    {
        return $this->store;
    }

}
