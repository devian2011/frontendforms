<?php

namespace Tests\AppBundle\Core\Form\Plugins\PresetForm;

use AppBundle\Core\Form\Plugins\PresetForm\PresetFormCollectionBuilderFromArray;
use Tests\WebTestCase;

/**
 * Class PresetFormCollectionBuilderFromArray
 * @package Tests\AppBundle\Core\Form\Plugins\PresetForm
 */
class PresetFormCollectionBuilderFromArrayTest extends WebTestCase
{

    public function testBuild()
    {
        $scheme = [
            1 => ['id' => 1, 'value' => 1000, 'isEditable' => true, 'notEmpty' => true, 'isHidden' => false],
            2 => ['id' => 2, 'value' => 1200, 'isEditable' => false, 'notEmpty' => true, 'isHidden' => false],
            3 => ['id' => 3, 'value' => 1400, 'isEditable' => false, 'notEmpty' => true, 'isHidden' => false],
            4 => ['id' => 4, 'value' => 1500, 'isEditable' => true, 'notEmpty' => true, 'isHidden' => true],
            5 => ['id' => 5, 'value' => 1800, 'isEditable' => true, 'notEmpty' => true, 'isHidden' => false],
        ];
        $collection = PresetFormCollectionBuilderFromArray::build($scheme);

        $this->assertEquals($scheme, $collection->getArrayNotation());
    }

}
