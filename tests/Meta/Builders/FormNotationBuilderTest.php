<?php

namespace Tests\Devian\FrontendForms\Meta\Builders;

use AppBundle\Core\Data\Provider\DataProviderInterface;
use Devian\FrontendForms\Fields\EmailField;
use Devian\FrontendForms\Fields\MetaInfoSafeDataInterface;
use Devian\FrontendForms\Form;
use Devian\FrontendForms\FormDataInterface;
use Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider;
use Devian\FrontendForms\Meta\Builders\FormNotationBuilder;
use AppBundle\Entity\Core\Form\FieldDataHolder;
use Tests\WebTestCase;

/**
 * Class FormNotationBuilderTest
 * @package Devian\FrontendForms\Meta\Builders
 */
class FormNotationBuilderTest extends WebTestCase
{


    public function testNotation()
    {

        $fldd = $this->createMock(MetaInfoSafeDataInterface::class);
        $fldd->method('getData')->willReturn(['default' => 'test@test.com', 'isEditable' => true, 'isHidden' => false]);
        $fldd->method('getLinked')->willReturn([]);
        $fldd->method('getUniqueFieldId')->willReturn('abcd');
        $fldd->method('getFieldProgrammingCode')->willReturn('email');
        $fldd->method('getName')->willReturn('email');
        $fldd->method('getFieldCode')->willReturn('code');
        $fldd->method('getType')->willReturn(EmailField::CODE);
        $fldd->method('isRequired')->willReturn(true);

        $fd = $this->createMock(FormDataInterface::class);
        $dp = $this->createMock(DataProviderInterface::class);
        $fd->method('getId')->willReturn(1);
        $fd->method('getName')->willReturn('Test form');
        $fd->method('getFields')->willReturn([$fldd]);

        $form = new Form($fd, $dp);

        $formNotationBuilder = new FormNotationBuilder($form);
        $this->assertEquals(array(
                'id' => 1,
                'name' => 'Test form',
                'fields' =>
                    array(
                        0 =>
                            array(
                                'id' => 'abcd',
                                'name' => 'email',
                                'default' => 'test@test.com',
                                'value' => 'test@test.com',
                                'type' => 'string',
                                'subType' => 'email',
                                'isLinked' => false,
                                'isRequired' => true,
                                'options' => array(),
                                'linkedWith' => array(),
                                'isEditable' => true,
                                'isHidden' => false,
                            ),
                    ),
            )
            , $formNotationBuilder->build());

    }


}
