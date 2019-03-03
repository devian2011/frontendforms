<?php

namespace Tests\Devian\FrontendForms\Plugins\PresetForm;

use AppBundle\Core\Data\Provider\DataProviderInterface;
use Devian\FrontendForms\Exceptions\FormNotValidException;
use Devian\FrontendForms\Fields\EmailField;
use Devian\FrontendForms\Fields\FieldInterface;
use Devian\FrontendForms\Fields\MetaInfoSafeDataInterface;
use Devian\FrontendForms\Form;
use Devian\FrontendForms\FormDataInterface;
use Devian\FrontendForms\Plugins\PresetForm\FormWithPresetValues;
use Devian\FrontendForms\Plugins\PresetForm\PresetFieldSettings;
use Devian\FrontendForms\Plugins\PresetForm\PresetFormCollection;
use Tests\WebTestCase;
use \Devian\FrontendForms\Plugins\PresetForm\FieldWithPresetValue;

/**
 * Class FormWithPresetValuesTest
 *
 * Декоратор для формы который устанавливает предустановленные значения
 *
 * @package Devian\FrontendForms
 */
class FormWithPresetValuesTest extends WebTestCase
{

    /** @var Form */
    private $form;

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

        $fd = $this->createMock(FormDataInterface::class);
        $dp = $this->createMock(DataProviderInterface::class);
        $fd->method('getId')->willReturn(1);
        $fd->method('getName')->willReturn('Test form');
        $fd->method('getFields')->willReturn([$fldd]);

        $this->form = new Form($fd, $dp);
    }

    /**
     * Проверям что декоратор не убивает функционал если передаётся пустая коллекция
     */
    public function testEmptySettingsDecoration()
    {
        $form = new FormWithPresetValues($this->form, new PresetFormCollection());

        $this->assertEquals(1, $form->getId());
        $this->assertEquals('Test form', $form->getFormName());

        $field = $form->getField('abcd');
        $this->assertInstanceOf(EmailField::class, $field);
        $this->assertEquals('test@test.com', $field->getValue());
        $this->assertEquals(false, $field->isRequired());
        $this->assertEquals(false, $field->isLinkedField());
        $this->assertEmpty($field->getOptions());
        $this->assertEmpty($field->linkedWith());
        $this->assertEquals('email', $field->getFieldName());
        $this->assertEquals(EmailField::CODE, $field->getFieldCode());

        $form->loadData(['abcd' => 'test']);
        try {
            $form->validate();
            $this->fail("Форма прошла валидацию при неверных параметрах");
        } catch (FormNotValidException $formNotValidException) {
            $err = $form->getErrors();
            $this->assertArrayHasKey('abcd', $err);
            $this->assertEquals("Поле email не является e-mail", $err['abcd']);
        }

        $form->loadData(['abcd' => 'test@abc.d']);

        try {
            $form->validate();
            $field = $form->getField('abcd');
            $this->assertEquals('test@abc.d', $field->getValue());
        } catch (FormNotValidException $formNotValidException) {
            $this->fail("Форма не прошла валидацию при правильных параметрах");
        }
    }

    public function testDecoratorWithSettingsDefaultEditable()
    {
        $fieldSettings = new PresetFieldSettings(['id' => 'abcd', 'value' => 'some.test@email.decorator', 'isHidden' => false, 'isEditable' => false, 'notEmpty' => true]);

        $form = new FormWithPresetValues($this->form, new PresetFormCollection([$fieldSettings]));

        $field = $form->getField('abcd');
        $this->assertInstanceOf(FieldInterface::class, $field);
        $this->assertInstanceOf(FieldWithPresetValue::class, $field);
        $this->assertEquals($fieldSettings->getValue(), $field->getDefaultValue());
        $this->assertEquals(true, $field->isRequired());
        $this->assertEquals('email', $field->getFieldName());
        $this->assertEquals(EmailField::CODE, $field->getFieldCode());
        $this->assertEquals($fieldSettings->isNotEmpty(), $field->isRequired());
        $this->assertEquals($fieldSettings->isEditable(), $field->getIsEditable());

        $form->loadData(['abcd' => 'test']);
        try {
            $form->validate();
            $this->fail("Форма прошла валидацию при неверных параметрах");
        } catch (FormNotValidException $formNotValidException) {
            $err = $form->getErrors();
            $this->assertArrayHasKey('abcd', $err);
            $this->assertEquals("Поле email не является e-mail", $err['abcd']);
        }

        $form->loadData(['abcd' => 'test@abc.d']);

        try {
            $form->validate();
            $field = $form->getField('abcd');
            $this->assertEquals('test@abc.d', $field->getValue());
        } catch (FormNotValidException $formNotValidException) {
            $this->fail("Форма не прошла валидацию при правильных параметрах");
        }
    }

    public function testDecoratorWithSettingsHidden()
    {
        $fieldSettings = new PresetFieldSettings(['id' => 'abcd', 'value' => 'some.test@email.decorator', 'isHidden' => true, 'isEditable' => false, 'notEmpty' => true]);

        $form = new FormWithPresetValues($this->form, new PresetFormCollection(
            [$fieldSettings]
        ));

        $field = $form->getField('abcd');
        $this->assertNull($field);
        $this->assertEmpty($form->getFields());

        $formField = $this->form->getField('abcd');

        $fieldDecorator = $form->getFieldByCode($formField->getFieldProgrammingCode());
        //Проверяем что по коду до
        $this->assertInstanceOf(FieldWithPresetValue::class, $fieldDecorator);
    }

    public function testGetPreviousForm()
    {
        $form = new FormWithPresetValues($this->form, new PresetFormCollection());
        $this->assertEquals($this->form, $form->getPreviousForm());
    }

    public function testGetBaseForm()
    {
        $form = new FormWithPresetValues($this->form, new PresetFormCollection());
        $this->assertEquals($this->form, $form->getBaseForm());
    }


}
