<?php

namespace Tests\Devian\FrontendForms\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use Devian\FrontendForms\Fields\MultiSelectField;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class MultiSelectFieldTest
 * @package Devian\FrontendForms\Field
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
        $field = new MultiSelectField(new \Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), MultiSelectField::CODE);
        $this->assertEquals($field->getType(), 'select');
        $this->assertEquals($field->getSubType(), 'multiple');
    }


}
