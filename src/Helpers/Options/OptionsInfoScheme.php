<?php

namespace Devian\FrontendForms\Helpers\Options;

/**
 * Class OptionsInfoScheme
 * @package Devian\FrontendForms\Helpers\Options
 */
class OptionsInfoScheme
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * OptionsInfoScheme constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = !empty($data) ? $data : [
            'class' => '',
            'options' => [],
            'fieldMap' => ['key' => 'id', 'value' => 'name'],
            'params' => [],
        ];
    }

    /**
     * @return bool
     */
    public function isManualOptions(): bool
    {
        return empty($this->data['class']);
    }

    /**
     * @return array
     */
    public function getManualOptions(): array
    {
        return $this->data['options'];
    }

    /**
     * @return array
     */
    public function getClassFieldMap(): array
    {
        return $this->data['fieldMap'];
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->data['class'];
    }


    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->data['params'];
    }

    /**
     * @param array $options
     */
    public function setManualOptions(array $options)
    {
        $this->data['options'] = $options;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class)
    {
        $this->data['class'] = $class;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->data['params'] = $params;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setFieldMap(string $key = 'id', string $value = 'name')
    {
        $this->data['fieldMap'] = ['key' => $key, 'value' => $value];
    }

    /**
     * @return array
     */
    public function getOptionData(): array
    {
        return $this->data;
    }

}
