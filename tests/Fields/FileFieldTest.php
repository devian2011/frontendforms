<?php

namespace Tests\AppBundle\Core\Form\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use AppBundle\Core\Form\Fields\FileField;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class FileFieldTest
 * @package AppBundle\Core\Form\Fields
 */
class FileFieldTest extends WebTestCase
{

    /**
     *
     */
    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new FileField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), FileField::CODE);
        $this->assertEquals($field->getType(), 'file');
        $this->assertEquals($field->getSubType(), 'file');
    }

}
