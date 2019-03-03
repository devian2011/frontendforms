<?php

namespace Tests\AppBundle\Core\Form\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use AppBundle\Core\Form\Fields\PhoneField;
use AppBundle\Core\Form\Fields\RadioField;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class RadioField
 * @package AppBundle\Core\Form\Fields
 */
class RadioFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new RadioField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), RadioField::CODE);
        $this->assertEquals($field->getType(), 'checkbox');
        $this->assertEquals($field->getSubType(), 'radio');
    }


}
