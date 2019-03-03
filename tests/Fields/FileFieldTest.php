<?php

namespace Tests\Devian\FrontendForms\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use Devian\FrontendForms\Fields\FileField;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class FileFieldTest
 * @package Devian\FrontendForms\Fields
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
        $field = new FileField(new \Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), FileField::CODE);
        $this->assertEquals($field->getType(), 'file');
        $this->assertEquals($field->getSubType(), 'file');
    }

}
