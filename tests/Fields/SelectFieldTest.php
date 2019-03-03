<?php

namespace Tests\AppBundle\Core\Form\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use AppBundle\Core\Form\Fields\SelectField;
use AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider;
use AppBundle\Core\Form\Helpers\Options\OptionsInfoScheme;
use AppBundle\Entity\Client\Client;
use AppBundle\Entity\Client\Department;
use AppBundle\Entity\Core\Form\FieldDataHolder;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class SelectFieldTest
 * @package AppBundle\Core\Form\Field
 */
class SelectFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new SelectField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), SelectField::CODE);
        $this->assertEquals($field->getType(), 'select');
        $this->assertEquals($field->getSubType(), 'select');
    }

}
