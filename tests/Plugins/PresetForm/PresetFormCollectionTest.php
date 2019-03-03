<?php

namespace Tests\AppBundle\Core\Form\Plugins\PresetForm;

use AppBundle\Core\Form\Plugins\PresetForm\PresetFieldSettings;
use AppBundle\Core\Form\Plugins\PresetForm\PresetFormCollection;
use Tests\WebTestCase;

/**
 * Class PresetFormCollection
 * @package Tests\AppBundle\Core\Form\Plugins\PresetForm
 */
class PresetFormCollectionTest extends WebTestCase
{

    /** @var PresetFieldSettings */
    private $fieldOne;
    /** @var PresetFieldSettings */
    private $fieldTwo;
    /** @var PresetFieldSettings */
    private $fieldThree;

    /** @var PresetFieldSettings[] */
    private $notation;
    /** @var PresetFormCollection */
    private $collection;

    public function setUp()
    {
        $this->fieldOne = new PresetFieldSettings(['id' => 2, 'value' => 1000, 'isEditable' => true, 'notEmpty' => true, 'isHidden' => false]);
        $this->fieldTwo = new PresetFieldSettings(['id' => 3, 'value' => 1200, 'isEditable' => true, 'notEmpty' => true, 'isHidden' => false]);
        $this->fieldThree = new PresetFieldSettings(['id' => 4, 'value' => 1600, 'isEditable' => true, 'notEmpty' => true, 'isHidden' => false]);
        $this->notation = [
            2 => $this->fieldOne, 3 => $this->fieldTwo, 4 => $this->fieldThree,
        ];
        $this->collection = new PresetFormCollection($this->notation);
    }

    public function tearDown()
    {
        $this->fieldOne =
        $this->fieldTwo =
        $this->fieldThee =
        $this->notation =
        $this->collection = null;
    }


    public function testAddPresetSetting()
    {
        $field = new PresetFieldSettings(['id' => 87, 'value' => "abcd"]);
        $this->collection->addPresetSetting($field);
        $this->assertTrue($this->collection->has($field->getId()));
    }

    public function testGetPresetSettingByFieldId()
    {
        $this->assertEquals($this->fieldOne, $this->collection->getPresetSettingByFieldId($this->fieldOne->getId()));
        $this->assertEquals($this->fieldTwo, $this->collection->getPresetSettingByFieldId($this->fieldTwo->getId()));
        $this->assertEquals($this->fieldThree, $this->collection->getPresetSettingByFieldId($this->fieldThree->getId()));
    }


    public function testRemovePresetSetting()
    {
        $this->collection->removePresetSetting($this->fieldTwo->getId());
        $this->assertFalse($this->collection->has($this->fieldTwo->getId()));
    }


    public function testHas()
    {
        $this->assertTrue($this->collection->has($this->fieldOne->getId()));
        $this->assertFalse($this->collection->has(3000));
    }


    public function testGetArrayNotation()
    {
        $notation = [];
        foreach ($this->notation as $id => $object){
            $notation[$id] = $object->getArrayNotation();
        }
        $this->assertEquals($notation, $this->collection->getArrayNotation());
    }
}
