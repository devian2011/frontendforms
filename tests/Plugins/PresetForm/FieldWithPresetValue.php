<?php

namespace Tests\Devian\FrontendForms\Plugins\PresetForm;

use Devian\FrontendForms\Fields\EmailField;
use Devian\FrontendForms\Fields\MetaInfoSafeDataInterface;
use Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider;
use Devian\FrontendForms\Plugins\PresetForm\FieldWithPresetValue;
use Devian\FrontendForms\Plugins\PresetForm\PresetFieldSettings;
use Tests\WebTestCase;

/**
 * Class FieldWithPresetValue
 * @package Tests\Devian\FrontendForms\Plugins\PresetForm
 */
class FieldWithPresetValueTest extends WebTestCase
{

    private $field;

    public function setUp()
    {
        $fldd = $this->createMock(MetaInfoSafeDataInterface::class);
        $fldd->method('getData')->willReturn(['default' => 'test@test.com', 'isHidden' => false, 'isEditable' => false]);
        $fldd->method('getLinked')->willReturn([]);
        $fldd->method('getUniqueFieldId')->willReturn('abcd');
        $fldd->method('getFieldProgrammingCode')->willReturn('email');
        $fldd->method('getName')->willReturn('email');
        $fldd->method('getFieldCode')->willReturn(EmailField::CODE);
        $fldd->method('getType')->willReturn(EmailField::CODE);
        $fldd->method('isRequired')->willReturn(false);
        /** @var OptionDataHelperProvider $provider */
        $provider = $this->createMock(OptionDataHelperProvider::class);
        $this->field = new EmailField($provider, $fldd);
    }

    public function tearDown()
    {
        $this->field = null;
    }


    public function testIsHidden()
    {
        $fieldSettings = ['id' => 'abcd', 'value' => 'some.test@email.decorator', 'isHidden' => true, 'isEditable' => false, 'notEmpty' => false];
        $fieldWithPresetValue = new FieldWithPresetValue($this->field, new PresetFieldSettings($fieldSettings));
        $this->assertTrue($fieldWithPresetValue->getIsHidden());

    }

    public function testIsEditable()
    {
        $fieldSettings = ['id' => 'abcd', 'value' => 'some.test@email.decorator', 'isHidden' => false, 'isEditable' => true, 'notEmpty' => false];
        $fieldWithPresetValue = new FieldWithPresetValue($this->field, new PresetFieldSettings($fieldSettings));
        $this->assertTrue($fieldWithPresetValue->getIsEditable());
    }

    public function testIsNotEmpty()
    {
        $fieldSettings = ['id' => 'abcd', 'value' => 'some.test@email.decorator', 'isHidden' => false, 'isEditable' => false, 'notEmpty' => true];
        $fieldWithPresetValue = new FieldWithPresetValue($this->field, new PresetFieldSettings($fieldSettings));
        $this->assertTrue($fieldWithPresetValue->isRequired());
    }

    public function testDefault()
    {
        $fieldSettings = ['id' => 'abcd', 'value' => 'some.test@email.decorator', 'isHidden' => false, 'isEditable' => false, 'notEmpty' => false];
        $fieldWithPresetValue = new FieldWithPresetValue($this->field, new PresetFieldSettings($fieldSettings));
        $this->assertEquals($fieldSettings['value'], $fieldWithPresetValue->getDefaultValue());
    }
}
