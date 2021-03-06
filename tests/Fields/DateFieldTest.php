<?php
namespace Tests\Devian\FrontendForms\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use Devian\FrontendForms\Fields\DateField;
use Devian\FrontendForms\Fields\MetaInfoSafeDataInterface;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

class DateFieldTest extends WebTestCase
{

    public function testNotation()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);
        $field = new DateField(new \Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)));
        $this->assertEquals($field->getFieldCode(), DateField::CODE);
        $this->assertEquals($field->getType(), 'string');
        $this->assertEquals($field->getSubType(), 'date');
    }

    /**
     * @dataProvider validateProvider
     */
    public function testValidate($in, $out)
    {
        $mids = $this->createMock(MetaInfoSafeDataInterface::class);
        $mids->method('getName')->willReturn('date');

        $em = $this->createMock(EntityManagerInterface::class);
        $field = new DateField(new \Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider(new DoctrineDataProvider($em)), $mids);
        $field->setValue($in);
        $this->assertEquals($field->validate(), $out);
    }


    public function validateProvider()
    {
        return [
            [
                '2018-09-12',
                true,
            ],
            [
                '2019-32-10',
                false
            ],
            [
                '10.02.2018',
                true
            ],
        ];
    }

}
