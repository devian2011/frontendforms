<?php

namespace Devian\FrontendForms\Fields;

use AppBundle\Core\Data\Provider\DataProviderInterface;
use Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider;

/**
 * Class AbstractFrontendFieldMetaInformation
 * @package Devian\FrontendForms\Frontend
 */
abstract class AbstractField implements FieldInterface
{
    /**
     * Возвращает код поля
     *
     * @return string
     */
    abstract public function getFieldCode(): string;

    /**
     * Получает объект типа Field из сохранённых данных
     * Данные поступают в конструктор или в метод setMetaInfoDTO
     *
     * @see setMetaInfoDTO
     */
    abstract protected function riseFromSavedData();

    /**
     * Возвращает тип переменной в строковом виде (object,string,integer,float и т.д.)
     *
     * @return string
     */
    abstract public function getType(): string;

    /**
     * @return string
     */
    abstract public function getSubType(): string;


    /**
     * @var string
     */
    protected $errorMessage = '';

    /**
     * @var MetaInfoSafeDataInterface
     */
    protected $serializeSaveInterface = null;

    /**
     * @var mixed
     */
    protected $fieldValue;

    /**
     * @var array
     */
    protected $linkedValues = [];

    /**
     * @var DataProviderInterface
     */
    protected $dataProvider;
    /**
     * @var OptionDataHelperProvider
     */
    protected $optionDataHelper;

    /**
     * AbstractFieldMetaInformation constructor.
     * @param OptionDataHelperProvider $provider
     * @param MetaInfoSafeDataInterface $metaInfoSaveData
     */
    public function __construct(OptionDataHelperProvider $provider, ?MetaInfoSafeDataInterface $metaInfoSaveData = null)
    {
        $this->optionDataHelper = $provider;
        $this->serializeSaveInterface = $metaInfoSaveData;
        $this->riseFromSavedData();
    }

    /**
     * @param MetaInfoSafeDataInterface $metaInfoSafeData
     */
    public function setMetaInfoDTO(MetaInfoSafeDataInterface $metaInfoSafeData)
    {
        $this->serializeSaveInterface = $metaInfoSafeData;
        $this->riseFromSavedData();
    }

    /**
     * Установить текущее значение поля
     *
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->fieldValue = $value;
    }

    /**
     * Получить текущее значение поля
     *
     * @return mixed
     */
    public function getValue()
    {
        $default = $this->getDefaultValue();
        return empty($this->fieldValue) ? $default : $this->fieldValue;
    }

    /**
     * Возвращает уникальныльный индекс поля
     *
     * @return string
     */
    public function getFieldId(): string
    {
        return $this->serializeSaveInterface->getUniqueFieldId();
    }

    /**
     * Код для более лёгкого вызова названия поля из кода, какое-то понятное название
     * client_id, select_code, subject, email_to и т.д.
     *
     * @return string
     */
    public function getFieldProgrammingCode(): string
    {
        return $this->serializeSaveInterface->getFieldProgrammingCode();
    }

    /**
     * Возвращает название поля для отображения пользователю
     *
     * @return string
     */
    public function getFieldName()
    {
        return $this->serializeSaveInterface->getName();
    }

    /**
     * @inheritDoc
     */
    public function isLinkedField(): bool
    {
        $linked = $this->serializeSaveInterface->getLinked();
        return !empty($linked);
    }

    /**
     * @inheritDoc
     */
    public function setLinkedFieldValues(array $values)
    {
        $this->linkedValues = $values;
    }

    /**
     * Возвращает объект для сохранения в базу данных
     *
     * @return MetaInfoSafeDataInterface|null
     */
    public function getSerializedFieldValue(): ?MetaInfoSafeDataInterface
    {
        return $this->serializeSaveInterface;
    }

    /**
     * @inheritDoc
     */
    public function linkedWith(): array
    {
        return $this->serializeSaveInterface->getLinked();
    }


    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $data = $this->serializeSaveInterface->getData();
        $data['options'] = $options;
        $this->serializeSaveInterface->setData($data);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getOptions(): array
    {
        $data = $this->serializeSaveInterface->getData();
        $options = isset($data['options']) ? $data['options'] : [];
        if (empty($options)) {
            return [];
        } else {
            $linkedValueScheme = $this->linkedWith();
            $linkedValues = [];
            foreach ($this->linkedValues as $fieldId => $linkedValue) {
                $linkedValues[$linkedValueScheme[$fieldId]] = $linkedValue;
            }

            return $this->optionDataHelper->getOptions($options, $linkedValues);
        }
    }

    /**
     * @param mixed $defaultValue
     */
    public function setDefaultValue($defaultValue)
    {
        $data = $this->serializeSaveInterface->getData();
        $data['default'] = $defaultValue;
        $this->serializeSaveInterface->setData($data);
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        $data = $this->serializeSaveInterface->getData();

        return isset($data['default']) ? $data['default'] : null;
    }

    /**
     * @param bool $isEditable
     */
    public function setIsEditable(bool $isEditable)
    {
        $data = $this->serializeSaveInterface->getData();
        $data['isEditable'] = $isEditable;
        $this->serializeSaveInterface->setData($data);
    }

    /**
     * @return bool
     */
    public function getIsEditable()
    {
        $data = $this->serializeSaveInterface->getData();

        return isset($data['isEditable']) ? $data['isEditable'] : true;
    }

    /**
     * @return bool
     */
    public function getIsHidden()
    {
        $data = $this->serializeSaveInterface->getData();

        return isset($data['isHidden']) ? $data['isHidden'] : false;
    }

    /**
     * @param bool $isHidden
     */
    public function setIsHidden(bool $isHidden)
    {
        $data = $this->serializeSaveInterface->getData();
        $data['isHidden'] = $isHidden;
        $this->serializeSaveInterface->setData($data);
    }


    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->serializeSaveInterface->isRequired();
    }


}
