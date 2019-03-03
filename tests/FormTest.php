<?php

namespace Tests\AppBundle\Core\Form;

use AppBundle\Core\Data\Provider\DataProviderInterface;
use AppBundle\Core\Form\Fields\AbstractField;
use AppBundle\Core\Form\Fields\EmailField;
use AppBundle\Core\Form\Fields\FieldInterface;
use AppBundle\Core\Form\Fields\FieldMapper;
use AppBundle\Core\Form\Fields\MetaInfoSafeDataInterface;
use AppBundle\Core\Form\Exceptions\FormNotValidException;
use AppBundle\Core\Form\Form;
use AppBundle\Core\Form\FormDataInterface;
use Tests\WebTestCase;

/**
 * Class Form
 * @package AppBundle\Core\Form
 */
class FormTest extends WebTestCase
{


    public function testForm()
    {
        $fldd = $this->createMock(MetaInfoSafeDataInterface::class);
        $fldd->method('getData')->willReturn(['default' => 'test@test.com']);
        $fldd->method('getLinked')->willReturn([]);
        $fldd->method('getUniqueFieldId')->willReturn('abcd');
        $fldd->method('getFieldProgrammingCode')->willReturn('email');
        $fldd->method('getName')->willReturn('email');
        $fldd->method('getFieldCode')->willReturn(EmailField::CODE);
        $fldd->method('getType')->willReturn(EmailField::CODE);
        $fldd->method('isRequired')->willReturn(true);

        $fd = $this->createMock(FormDataInterface::class);
        $dp = $this->createMock(DataProviderInterface::class);
        $fd->method('getId')->willReturn(1);
        $fd->method('getName')->willReturn('Test form');
        $fd->method('getFields')->willReturn([$fldd]);

        $form = new Form($fd, $dp);

        $this->assertEquals(1, $form->getId());
        $this->assertEquals('Test form', $form->getFormName());

        $field = $form->getField('abcd');
        $this->assertInstanceOf(EmailField::class, $field);
        $this->assertEquals('test@test.com', $field->getValue());
        $this->assertEquals(true, $field->isRequired());
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


}
