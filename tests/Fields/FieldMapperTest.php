<?php

namespace Tests\AppBundle\Core\Form\Fields;

use AppBundle\Core\Data\Provider\DataProviderInterface;
use AppBundle\Core\Form\Fields\{
    EmailField,
    MultiSelectField,
    NumberField,
    PhoneField,
    SelectField,
    StringField,
    TextField,
    FileField,
    RadioField,
    CheckboxField
};
use AppBundle\Core\Form\Fields\FieldMapper;
use Tests\WebTestCase;

/**
 * Class FieldMapper
 *
 * @package AppBundle\Core\Form\Fields
 */
class FieldMapperTest extends WebTestCase
{


    public function testMapper()
    {
        /** @var DataProviderInterface $dp */
        $dp = $this->createMock(DataProviderInterface::class);
        $fm = new FieldMapper($dp);
        $this->assertInstanceOf(EmailField::class, $fm->getField(EmailField::CODE));
        $this->assertInstanceOf(MultiSelectField::class, $fm->getField(MultiSelectField::CODE));
        $this->assertInstanceOf(NumberField::class, $fm->getField(NumberField::CODE));
        $this->assertInstanceOf(PhoneField::class, $fm->getField(PhoneField::CODE));
        $this->assertInstanceOf(SelectField::class, $fm->getField(SelectField::CODE));
        $this->assertInstanceOf(StringField::class, $fm->getField(StringField::CODE));
        $this->assertInstanceOf(TextField::class, $fm->getField(TextField::CODE));
        $this->assertInstanceOf(FileField::class, $fm->getField(FileField::CODE));
        $this->assertInstanceOf(RadioField::class, $fm->getField(RadioField::CODE));
        $this->assertInstanceOf(CheckboxField::class, $fm->getField(CheckboxField::CODE));
    }

}
