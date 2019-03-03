<?php

namespace Tests\Devian\FrontendForms\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use Devian\FrontendForms\Fields\CheckboxField;
use Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class CheckboxField
 * @package Devian\FrontendForms\Fields
 */
class CheckboxFieldTest extends WebTestCase
{

    /**
     *
     */
    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new CheckboxField(new OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), CheckboxField::CODE);
        $this->assertEquals($field->getType(), 'checkbox');
        $this->assertEquals($field->getSubType(), 'checkbox');
    }


}
