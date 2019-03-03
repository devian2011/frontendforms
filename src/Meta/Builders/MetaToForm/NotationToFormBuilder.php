<?php

namespace Devian\FrontendForms\Meta\Builders\MetaToForm;

use AppBundle\Core\Data\Provider\DataProviderInterface;
use Devian\FrontendForms\Fields\MetaInfoSafeDataInterface;
use Devian\FrontendForms\FormDataInterface;
use Devian\FrontendForms\Helpers\Options\OptionsInfoScheme;
use Devian\FrontendForms\Meta\Builders\MetaToForm\Dto\DbProviderListInterface;
use Devian\FrontendForms\Meta\Builders\MetaToForm\Dto\DbProvidersInterface;

/**
 * Class NotationToFormBuilder
 *
 * Берем такую же нотацию что и отдаём в FormNotationBuilder
 *
 * @package Devian\FrontendForms\Meta\Builders
 */
class NotationToFormBuilder
{
    /**
     * @var FormNotation
     */
    private $notation;

    /**
     * @var DbProvidersInterface[]
     */
    private $dependencyList;

    /**
     * @var DataProviderInterface
     */
    private $dataProvider;

    /**
     * NotationToFormBuilder constructor.
     * @param FormNotation $formNotation
     * @param DbProviderListInterface $dependencyList
     * @param DataProviderInterface $dataProvider
     */
    public function __construct(FormNotation $formNotation, DbProviderListInterface $dependencyList, DataProviderInterface $dataProvider)
    {
        $this->notation = $formNotation;
        $this->prepareProviders($dependencyList);
        $this->dataProvider = $dataProvider;
    }

    /**
     * @param array $formNotation
     *
     * @throws \Devian\FrontendForms\Exceptions\NotValidFormNotationException
     */
    public static function buildFromNotation(array $formNotation, DbProviderListInterface $dependent, DataProviderInterface $dataProvider): FormDataInterface
    {
        $notation = new FormNotation($formNotation);
        $self = new static($notation, $dependent, $dataProvider);

        return $self->build();
    }

    /**
     * @return FormDataInterface
     */
    public function build(): FormDataInterface
    {
        $form = DtoMetaDataBuilder::buildFormDataInterface($this->notation->getId(), $this->notation->getName());
        $fields = [];
        $notations = $this->notation->getFields();
        foreach ($notations as $fieldNotation) {
            //Так как очень хочется собрать это всё за один проход не строя дерева для связанных полей,
            //то массив собранных полей передаётся по ссылке
            //Нам нет смысла дважды собирать поля, поэтому проверяем есть ли оно уже, и если есть то просто пропускаем.
            if (isset($fields[$fieldNotation->getCode()])) continue;
            $fields[$fieldNotation->getCode()] = $this->buildField($fieldNotation, $notations, $fields);
        }
        $form->setFields($fields);

        return $form;
    }

    /**
     * @param FieldNotation $fieldNotation
     * @param FieldNotation[] $fieldNotations
     * @param MetaInfoSafeDataInterface[] $fields
     * @return MetaInfoSafeDataInterface
     */
    protected function buildField(FieldNotation $fieldNotation, array $fieldNotations, array &$fields): MetaInfoSafeDataInterface
    {
        $field = DtoMetaDataBuilder::buildFormFieldDataInterface($fieldNotation->getId());
        $field->setName($fieldNotation->getName());
        $field->setType($fieldNotation->getFieldCode());
        $field->setFieldProgrammingCode($fieldNotation->getCode());
        $field->setFieldCode($fieldNotation->getCode());
        $field->setIsRequired($fieldNotation->isRequired());

        $fieldProvider = $fieldNotation->getOptions()->getDb();
        $fieldOptionsParams = [];

        $linked = $fieldNotation->getLinkedWith();
        if (!empty($linked)) {
            $fLinked = [];
            foreach ($linked as $linkedData) {
                $fieldName = $linkedData['fieldName'];
                $relation = $linkedData['relation'];
                if (!isset($fields[$fieldName])) {
                    $fields[$fieldName] = $this->buildField($fieldNotations[$fieldName], $fieldNotations, $fields);
                }
                $relationProvider = $this->dependencyList[$relation];
                $fLinked[$fields[$fieldName]->getUniqueFieldId()] = $relationProvider->getDependentColumn($fieldProvider);
                $fieldOptionsParams[$relationProvider->getDependentColumn($fieldProvider)] = $fields[$fieldName]->getData()['default'];

            }
            $field->setLinked($fLinked);
        }

        $optionsInfoScheme = new OptionsInfoScheme([]);
        $manual = $fieldNotation->getOptions()->getManual();
        if (!empty($manual)) {
            $optionsInfoScheme->setManualOptions($manual);
        }

        $providerCode = $fieldNotation->getOptions()->getDb();
        if(!empty($providerCode)){
            $prov = $this->dependencyList[$providerCode];
            $optionsInfoScheme->setFieldMap($prov->getListKey(), $prov->getListValue());
            $optionsInfoScheme->setClass($prov->getClass());
            //TODO: Добавить возможность добавления параметров
            $optionsInfoScheme->setParams($fieldOptionsParams);
        }



        $data = [
            'default' => $fieldNotation->getDefault(),
            'isHidden' => $fieldNotation->isHidden(),
            'isEditable' => $fieldNotation->isEditable(),
        ];

        $field->setData(array_merge($data, ['options' => $optionsInfoScheme->getOptionData()]));

        return $field;
    }

    /**
     * @param DbProviderListInterface $providerList
     */
    private function prepareProviders(DbProviderListInterface $providerList)
    {
        foreach ($providerList->getProviders() as $provider) {
            $this->dependencyList[$provider->getCode()] = $provider;
        }
    }

}
