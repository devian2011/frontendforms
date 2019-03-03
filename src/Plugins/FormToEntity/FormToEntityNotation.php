<?php

namespace Devian\FrontendForms\Plugins\FormToEntity;

use Devian\FrontendForms\Fields\CheckboxField;
use Devian\FrontendForms\Fields\FieldInterface;
use Devian\FrontendForms\Fields\MultiSelectField;
use Devian\FrontendForms\Fields\RadioField;
use Devian\FrontendForms\Fields\SelectField;
use Devian\FrontendForms\Form;

/**
 * Class FormToEntityNotation
 * @package Devian\FrontendForms\Plugins\FormToEntity
 */
class FormToEntityNotation
{

    protected const OPTIONS_FIELDS = [
        CheckboxField::CODE,
        MultiSelectField::CODE,
        RadioField::CODE,
        SelectField::CODE,
    ];

    /**
     * @param Form $form
     * @return EntityNotation
     */
    public function buildNotation(Form $form)
    {
        $entity = new EntityNotation();
        $entity->setName($form->getFormName());
        foreach ($form->getFields() as $field) {
            $prop = new EntityProperty();
            $prop->setName($field->getFieldName());
            $prop->setCode($field->getFieldProgrammingCode());
            $prop->setRealValue($field->getValue());
            $prop->setHumanReadableValue(self::getFieldValue($field));
            $entity->addProperty($prop);
        }

        return $entity;
    }

    /**
     * @param FieldInterface $field
     * @return array|mixed|null
     */
    protected static function getFieldValue(FieldInterface $field)
    {
        if (in_array($field->getFieldCode(), self::OPTIONS_FIELDS)) {
            $value = $field->getValue();
            $options = $field->getOptions();
            if (is_array($value)) {
                $result = [];
                foreach ($value as $v) {
                    if (isset($options[$v])) $result[] = $options[$v];
                }

                return $result;
            } else {
                return isset($options[$value]) ? $options[$value] : null;
            }
        } else {
            return $field->getValue();
        }
    }


}
