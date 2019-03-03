<?php

namespace Devian\FrontendForms\Meta\Fields;

use Devian\FrontendForms\Fields\CheckboxField;
use Devian\FrontendForms\Fields\DateField;
use Devian\FrontendForms\Fields\EmailField;
use Devian\FrontendForms\Fields\FieldMapper;
use Devian\FrontendForms\Fields\FileField;
use Devian\FrontendForms\Fields\JsonField;
use Devian\FrontendForms\Fields\MultiSelectField;
use Devian\FrontendForms\Fields\NumberField;
use Devian\FrontendForms\Fields\PhoneField;
use Devian\FrontendForms\Fields\RadioField;
use Devian\FrontendForms\Fields\SelectField;
use Devian\FrontendForms\Fields\StringField;
use Devian\FrontendForms\Fields\TextField;

/**
 * Class AvailableFieldList
 *
 * TODO:Поменять сбор данных по полям (найти более элегантное решение)
 *
 * @package Devian\FrontendForms\Meta\Fields
 * @deprecated
 */
class AvailableFieldList
{
    /**
     * @var FieldMapper
     */
    private $mapper;
    /**
     * @var array
     */
    private $translations = [
        CheckboxField::CODE => 'Чекбокс',
        DateField::CODE => 'Дата',
        EmailField::CODE => 'E-mail',
        FileField::CODE => 'Файл',
        JsonField::CODE => 'JSON - поле',
        MultiSelectField::CODE => 'Множественный выбор из списка',
        NumberField::CODE => 'Число',
        PhoneField::CODE => 'Телефон',
        RadioField::CODE => 'Один из вариантов',
        SelectField::CODE => 'Выбор из списка',
        StringField::CODE => 'Строка',
        TextField::CODE => 'Текст',
    ];

    /**
     * AvailableFieldList constructor.
     * @param FieldMapper $fieldMapper
     * @param array $translations Переводы если требуются, по дефолту в классе описана русская локаль
     */
    public function __construct(FieldMapper $fieldMapper, array $translations = [])
    {
        $this->translations = empty($translations) ? $this->translations : $translations;
        $this->mapper = $fieldMapper;
    }

    /**
     * @return array
     */
    public function getFieldList()
    {
        $result = [];
        foreach ($this->mapper->getFields() as $field) {
            $result[$field->getFieldCode()] = [
                'name' => $this->translations[$field->getFieldCode()],
                'type' => $field->getType(),
                'subType' => $field->getSubType(),
            ];
        }

        return $result;
    }
}
