<?php

namespace Tests\Devian\FrontendForms\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use Devian\FrontendForms\Fields\PhoneField;
use Devian\FrontendForms\Fields\RadioField;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class RadioField
 * @package Devian\FrontendForms\Fields
 */
class RadioFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new RadioField(new \Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), RadioField::CODE);
        $this->assertEquals($field->getType(), 'checkbox');
        $this->assertEquals($field->getSubType(), 'radio');
    }


}
