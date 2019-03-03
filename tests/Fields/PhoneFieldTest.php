<?php
namespace Tests\Devian\FrontendForms\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use Devian\FrontendForms\Fields\PhoneField;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class PhoneField
 * @package Devian\FrontendForms\Field
 */
class PhoneFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new PhoneField(new \Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), PhoneField::CODE);
        $this->assertEquals($field->getType(), 'string');
        $this->assertEquals($field->getSubType(), 'phone');
    }

}
