<?php

namespace Devian\FrontendForms\Service;
use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use Devian\FrontendForms\Fields\AbstractField;
use Devian\FrontendForms\Fields\CheckboxField;
use Devian\FrontendForms\Fields\FieldMapper;
use Devian\FrontendForms\Fields\MultiSelectField;
use Devian\FrontendForms\Fields\RadioField;
use Devian\FrontendForms\Fields\SelectField;
use AppBundle\Entity\Core\Form\FieldDataHolder;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class OptionsFromLinkedFieldValueGetter
 * @package Devian\FrontendForms\Service
 */
class OptionsFromLinkedFieldValueGetter
{

    /**
     * @param EntityManagerInterface $em
     * @return array
     * @throws \ReflectionException
     */
    public static function getOptions(EntityManagerInterface $em, \ArrayAccess $argument)
    {
        $returnOptions = [];
        /** @var FieldDataHolder $field */
        $field = $em->getRepository(FieldDataHolder::class)->findOneBy(['uniqueFieldId' => $argument['fieldId']]);


        if (empty($field)) return $returnOptions;

        $fieldMapper = new FieldMapper(new DoctrineDataProvider($em));
        /** @var AbstractField $currentField */
        $currentField = $fieldMapper->getField($field->getType());

        if (empty($currentField)) return $http_response_header;

        if ($currentField instanceof SelectField ||
            $currentField instanceof RadioField ||
            $currentField instanceof CheckboxField ||
            $currentField instanceof MultiSelectField) {

            $linkedValues = [];
            foreach ($argument['options'] as $option) {
                $linkedValues[$option['fieldId']] = $option['value'];
            }

            $currentField->setMetaInfoDTO($field);
            $currentField->setLinkedFieldValues($linkedValues);

            $returnOptions = $currentField->getOptions();
        }

        return $returnOptions;
    }

}
