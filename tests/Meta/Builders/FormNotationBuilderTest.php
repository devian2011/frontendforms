<?php

namespace Tests\AppBundle\Core\Form\Meta\Builders;

use AppBundle\Core\Data\Provider\DataProviderInterface;
use AppBundle\Core\Form\Fields\EmailField;
use AppBundle\Core\Form\Fields\MetaInfoSafeDataInterface;
use AppBundle\Core\Form\Form;
use AppBundle\Core\Form\FormDataInterface;
use AppBundle\Core\Form\Helpers\Options\OptionDataHelperProvider;
use AppBundle\Core\Form\Meta\Builders\FormNotationBuilder;
use AppBundle\Entity\Core\Form\FieldDataHolder;
use Tests\WebTestCase;

/**
 * Class FormNotationBuilderTest
 * @package AppBundle\Core\Form\Meta\Builders
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
