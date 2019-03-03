<?php

namespace Tests\AppBundle\Core\Form\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use AppBundle\Core\Form\Fields\MetaInfoSafeDataInterface;
use AppBundle\Core\Form\Fields\NumberField;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class NumberFieldTest
 * @package AppBundle\Core\Form\Field
 */
class NumberFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new NumberField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), NumberField::CODE);
        $this->assertEquals($field->getType(), 'string');
        $this->assertEquals($field->getSubType(), 'number');
    }

    /**
     * @dataProvider validateProvider
     */
    public function testValidate($in, $out)
    {
        $mids = $this->createMock(MetaInfoSafeDataInterface::class);
        $mids->method('getName')->willReturn('number');
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new NumberField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)), $mids);
        $field->setValue($in);
        $this->assertEquals($field->validate(), $out);
    }


    public function validateProvider()
    {
        return [
            [
                'a',
                false,
            ],
            [
                '10',
                true,
            ],
            [
                20,
                true
            ],
            [
                [],
                false,
            ]
        ];
    }

}
