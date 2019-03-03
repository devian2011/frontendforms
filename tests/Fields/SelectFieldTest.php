<?php

namespace Tests\Devian\FrontendForms\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use Devian\FrontendForms\Fields\SelectField;
use Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider;
use Devian\FrontendForms\Helpers\Options\OptionsInfoScheme;
use AppBundle\Entity\Core\Form\FieldDataHolder;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class SelectFieldTest
 * @package Devian\FrontendForms\Field
 */
class SelectFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new SelectField(new \Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), SelectField::CODE);
        $this->assertEquals($field->getType(), 'select');
        $this->assertEquals($field->getSubType(), 'select');
    }

}
