<?php

namespace Devian\FrontendForms\Plugins\PresetForm;

/**
 * Class PresetFormCollectionBuilderFromArray
 * @package Devian\FrontendForms\Plugins\PresetForm
 */
class PresetFormCollectionBuilderFromArray
{
    /**
     * @param array $settingsCollection
     * @return PresetFormCollection
     */
    public static function build(array $settingsCollection): PresetFormCollection
    {
        $collection = new PresetFormCollection();
        foreach ($settingsCollection as $value) {
            $collection->addPresetSetting(new PresetFieldSettings($value));
        }

        return $collection;
    }

}
