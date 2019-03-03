<?php

namespace Tests\AppBundle\Core\Form\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use AppBundle\Core\Form\Fields\StringField;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class StringFieldTest
 * @package AppBundle\Core\Form\Field
 */
class StringFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new StringField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), StringField::CODE);
        $this->assertEquals($field->getType(), 'string');
        $this->assertEquals($field->getSubType(), 'string');
    }

}
