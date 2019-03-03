<?php
namespace Tests\AppBundle\Core\Form\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use AppBundle\Core\Form\Fields\JsonField;
use AppBundle\Core\Form\Fields\MetaInfoSafeDataInterface;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class JsonFieldTest
 * @package Tests\AppBundle\Core\Form\Fields
 */
class JsonFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new JsonField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), JsonField::CODE);
        $this->assertEquals($field->getType(), 'string');
        $this->assertEquals($field->getSubType(), 'json');
    }

    /**
     * @dataProvider validateProvider
     */
    public function testValidate($in, $out)
    {
        $mids = $this->createMock(MetaInfoSafeDataInterface::class);
        $mids->method('getName')->willReturn('email');

        $em = $this->createMock(EntityManagerInterface::class);
        $field = new JsonField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)), $mids);
        $field->setValue($in);
        $this->assertEquals($field->validate(), $out);
    }


    public function validateProvider()
    {
        return [
            [
                '{"test":"1","data":"live","pp":"pppp"}',
                true,
            ],
            [
                'test',
                false
            ],
        ];
    }

}
