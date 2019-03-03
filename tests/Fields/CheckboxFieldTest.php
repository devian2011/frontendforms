<?php

namespace Tests\AppBundle\Core\Form\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use AppBundle\Core\Form\Fields\CheckboxField;
use AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class CheckboxField
 * @package AppBundle\Core\Form\Fields
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
