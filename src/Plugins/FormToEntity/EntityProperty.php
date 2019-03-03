<?php

namespace Devian\FrontendForms\Plugins\FormToEntity;

/**
 * Class EntityProperty
 * @package Devian\FrontendForms\Plugins\FormToEntity
 */
class EntityProperty
{
    /**
     * @var string Код поля в форме (не ID а человекочитаемый индекс - "to", "from" и т.д.)
     */
    private $code;

    /**
     * @var string Имя поля в форме, для того чтобы было понятно что в этой форме есть
     */
    private $name;

    /**
     * @var string|string[] Реальное значение поля, индекс списка, true/false и т.д.
     */
    private $realValue;

    /**
     * @var string|string[] Если это checkbox то Да/Нет,
     *                      Если select то текст поля из списка,
     *                      Если файл, или скаляр (строка, число) - идентично тому же что и в RealValue
     */
    private $humanReadableValue;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|string[]
     */
    public function getRealValue()
    {
        return $this->realValue;
    }

    /**
     * @param string|string[] $realValue
     */
    public function setRealValue($realValue): void
    {
        $this->realValue = $realValue;
    }

    /**
     * @return string|string[]
     */
    public function getHumanReadableValue()
    {
        return $this->humanReadableValue;
    }

    /**
     * @param string|string[] $humanReadableValue
     */
    public function setHumanReadableValue($humanReadableValue): void
    {
        $this->humanReadableValue = $humanReadableValue;
    }

}