<?php

namespace Tests\Devian\FrontendForms\Plugins\PresetForm;

use Devian\FrontendForms\Plugins\PresetForm\PresetFieldSettings;
use Tests\WebTestCase;

/**
 * Class PresetFieldSettingsTest
 * @package Tests\Devian\FrontendForms\Plugins\PresetForm
 */
class PresetFieldSettingsTest extends WebTestCase
{


    public function testSettings()
    {
        $notation = [
            'id' => 1,
            'value' => 2,
            'isEditable' => true,
            'isHidden' => false,
            'notEmpty' => true,
        ];
        $settings = new PresetFieldSettings($notation);

        $this->assertEquals($notation['id'], $settings->getId());
        $this->assertEquals($notation['value'], $settings->getValue());
        $this->assertEquals($notation['isEditable'], $settings->isEditable());
        $this->assertEquals($notation['isHidden'], $settings->isHidden());
        $this->assertEquals($notation['notEmpty'], $settings->isNotEmpty());
        $this->assertEquals($notation, $settings->getArrayNotation());
    }

}
