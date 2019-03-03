<?php

namespace AppBundle\Core\Form\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class EmailFieldTest
 * @package AppBundle\Core\Form\Fields
 */
class EmailFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new EmailField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), EmailField::CODE);
        $this->assertEquals($field->getType(), 'string');
        $this->assertEquals($field->getSubType(), 'email');
    }

    /**
     * @dataProvider validateProvider
     */
    public function testValidate($in, $out)
    {
        $mids = $this->createMock(MetaInfoSafeDataInterface::class);
        $mids->method('getName')->willReturn('email');

        $em = $this->createMock(EntityManagerInterface::class);
        $field = new EmailField(new \AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)), $mids);
        $field->setValue($in);
        $this->assertEquals($field->validate(), $out);
    }


    public function validateProvider()
    {
        return [
            [
                'test@test.com',
                true,
            ],
            [
                'test',
                false
            ],
            [
                'test()com@test.test.test',
                false
            ],
            [
                'test.com@test.test.test',
                true
            ]
        ];
    }

}