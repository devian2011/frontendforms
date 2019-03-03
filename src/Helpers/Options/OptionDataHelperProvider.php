<?php

namespace Devian\FrontendForms\Helpers\Options;

use AppBundle\Core\Data\Provider\DataProviderInterface;

/**
 * Class OptionDataHelperProvider
 * @package Devian\FrontendForms\Helpers\Options
 */
class OptionDataHelperProvider
{
    /**
     * @var DataProviderInterface
     */
    private $dataProvider;

    /**
     * OptionDataHelperProvider constructor.
     * @param DataProviderInterface $dataProvider
     */
    public function __construct(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * Получаем список опций
     *
     * @param array $options
     * @param array $linkedValues
     * @return array
     * @throws \ReflectionException
     */
    public function getOptions(array $options, array $linkedValues = []): array
    {
        $scheme = new OptionsInfoScheme($options);
        if ($scheme->isManualOptions()) {
            return $scheme->getManualOptions();
        } else {
            $params = $scheme->getParams();
            if (empty($params)) {
                /** @var array $result */
                $result = $this->dataProvider->findAll($scheme->getClass());
            } else {
                //Удаляем пустые связанные значения (на всякий случай)
                foreach ($linkedValues as $name => $value) {
                    if (empty($value)) {
                        unset($linkedValues[$name]);
                    }
                }
                //Собираем фильтр из параметров по умолчанию и параметров из связанных полей
                $criteria = array_merge($scheme->getParams(), $linkedValues);
                $result = $this->dataProvider->findBy($scheme->getClass(), $criteria,null);
            }

            return $this->buildOptionList($scheme, $result);
        }
    }

    /**
     * Тут собирается option list для select-а radio или checkbox
     *
     * @param OptionsInfoScheme $scheme
     * @param array $rows
     * @return array
     * @throws \ReflectionException
     */
    private function buildOptionList(OptionsInfoScheme $scheme, array $rows): array
    {
        $ref = new \ReflectionClass($scheme->getClass());
        $fields = $scheme->getClassFieldMap();
        if ($ref->hasProperty($fields['key'])) {
            $keyMethod = false;
            $keyStringImplementation = $fields['key'];
        }
        if ($ref->hasMethod('get' . ucfirst($fields['key']))) {
            $keyMethod = true;
            $keyStringImplementation = 'get' . ucfirst($fields['key']);
        }
        if ($ref->hasProperty($fields['value'])) {
            $valueMethod = false;
            $valueStringImplementation = $fields['value'];
        }
        if ($ref->hasMethod('get' . ucfirst($fields['value']))) {
            $valueMethod = true;
            $valueStringImplementation = 'get' . ucfirst($fields['value']);
        }
        $result = [];
        //Выкидываем пустой массив если методы или свойства для получения данных для списка не найдены
        if (empty($valueMethod) || empty($keyMethod)) {
            return $result;
        }
        //Собираем option list из указанных строк
        foreach ($rows as $row) {
            $key = $keyMethod ? call_user_func([$row, $keyStringImplementation]) : $row->$keyStringImplementation;
            $value = $valueMethod ? call_user_func([$row, $valueStringImplementation]) : $row->$valueStringImplementation;

            $result[$key] = $value;
        }


        return $result;
    }

}
