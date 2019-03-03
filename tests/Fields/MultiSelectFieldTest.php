<?php

namespace Tests\AppBundle\Core\Form\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use AppBundle\Core\Form\Fields\MultiSelectField;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class MultiSelectFieldTest
 * @package AppBundle\Core\Form\Field
 */
class MultiSelectFieldTest extends WebTestCase
{
    /**
     *
     */
    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new MultiSelectField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), MultiSelectField::CODE);
        $this->assertEquals($field->getType(), 'select');
        $this->assertEquals($field->getSubType(), 'multiple');
    }


}
