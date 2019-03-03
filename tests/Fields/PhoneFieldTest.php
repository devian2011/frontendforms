<?php
namespace Tests\AppBundle\Core\Form\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use AppBundle\Core\Form\Fields\PhoneField;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class PhoneField
 * @package AppBundle\Core\Form\Field
 */
class PhoneFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new PhoneField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), PhoneField::CODE);
        $this->assertEquals($field->getType(), 'string');
        $this->assertEquals($field->getSubType(), 'phone');
    }

}
