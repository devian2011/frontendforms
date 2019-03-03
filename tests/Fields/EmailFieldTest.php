<?php

namespace Devian\FrontendForms\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class EmailFieldTest
 * @package Devian\FrontendForms\Fields
 */
class EmailFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new EmailField(new \Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
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
        $field = new EmailField(new \Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)), $mids);
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