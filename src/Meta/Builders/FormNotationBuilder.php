<?php

namespace Devian\FrontendForms\Meta\Builders;

use Devian\FrontendForms\Form;

/**
 * Class FormJsonBuilder
 * @package Devian\FrontendForms\Meta\Builders
 */
class FormNotationBuilder
{
    /**
     * @var Form
     */
    private $form;

    /**
     * FormNotationBuilder constructor.
     * @param Form $form
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Возвращает данные о форме
     *
     * @return array
     */
    public function build(): array
    {
        $result = [
            'id' => $this->form->getId(),
            'name' => $this->form->getFormName(),
        ];
        foreach ($this->form->getFields() as $id => $field) {
            $fd = [
                'id' => $id,
                'name' => $field->getFieldName(),
                'default' => $field->getDefaultValue(),
                'value' => $field->getValue(),
                'type' => $field->getType(),
                'subType' => $field->getSubType(),
                'isLinked' => $field->isLinkedField(),
                'isRequired' => $field->isRequired(),
                'options' => [],
                'linkedWith' => [],
                'isHidden' => $field->getIsHidden(),
                'isEditable' => $field->getIsEditable(),
            ];

            foreach ($field->getOptions() as $key => $value) {
                $fd['options'][] = [
                    'name' => $value,
                    'value' => $key,
                ];
            }

            foreach ($field->linkedWith() as $fieldId => $column) {
                $fd['linkedWith'][] = [
                    'fieldId' => $fieldId,
                    'column' => $column,
                ];
            }


            $result['fields'][] = $fd;
        }

        return $result;
    }

}
