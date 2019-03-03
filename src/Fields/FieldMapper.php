<?php

namespace Devian\FrontendForms\Fields;

use AppBundle\Core\Data\Provider\DataProviderInterface;
use Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider;

/**
 * Class FieldMapper
 *
 * Реализует шаблон прототип для того чтобы получить соответствующие поля
 *
 * @package Devian\FrontendForms\Fields
 */
class FieldMapper
{
    /**
     * @var AbstractField[]
     */
    private $fields = [];

    /**
     * FieldMapper constructor.
     * @param DataProviderInterface $dataProvider
     */
    public function __construct(DataProviderInterface $dataProvider)
    {
        $optionProvider = new OptionDataHelperProvider($dataProvider);
        //Вносим маппинг сюда, чтобы был Single State.
        $this->fields = [
            EmailField::CODE => new EmailField($optionProvider),
            MultiSelectField::CODE => new MultiSelectField($optionProvider),
            NumberField::CODE => new NumberField($optionProvider),
            PhoneField::CODE => new PhoneField($optionProvider),
            SelectField::CODE => new SelectField($optionProvider),
            StringField::CODE => new StringField($optionProvider),
            TextField::CODE => new TextField($optionProvider),
            FileField::CODE => new FileField($optionProvider),
            RadioField::CODE => new RadioField($optionProvider),
            CheckboxField::CODE => new CheckboxField($optionProvider),
            JsonField::CODE => new JsonField($optionProvider),
            DateField::CODE => new DateField($optionProvider),
        ];
    }

    /**
     * @param $fieldCode
     * @return AbstractField|null
     */
    public function getField($fieldCode): ?AbstractField
    {
        if (isset($this->fields[$fieldCode])) {
            /** @var AbstractField $field */
            return clone $this->fields[$fieldCode];
        }

        return null;
    }

    /**
     * @return AbstractField[]|array
     */
    public function getFields()
    {
        return $this->fields;
    }

}
