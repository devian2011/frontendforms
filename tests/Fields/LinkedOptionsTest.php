<?php

namespace Tests\Devian\FrontendForms\Fields;

use AppBundle\Core\Data\Provider\DoctrineDataProvider;
use Devian\FrontendForms\Fields\SelectField;
use Devian\FrontendForms\Helpers\Options\OptionDataHelperProvider;
use Devian\FrontendForms\Helpers\Options\OptionsInfoScheme;
use AppBundle\Entity\Core\Form\FieldDataHolder;
use Doctrine\ORM\EntityManagerInterface;
use Tests\WebTestCase;

/**
 * Class LinkedOptionsTest
 * @package Tests\Devian\FrontendForms\Fields
 */
class LinkedOptionsTest extends WebTestCase
{

    public function testManualOptions()
    {
        $em = $this->createMock(EntityManagerInterface::class);
        $testOptions = [
            1 => 222,
            2 => 444,
            3 => 999,
            4 => 888,
        ];

        $optionDepartmentInfoScheme = new OptionsInfoScheme([]);
        $optionDepartmentInfoScheme->setParams([]);
        $optionDepartmentInfoScheme->setManualOptions($testOptions);

        $fieldDepartmentData = new FieldDataHolder();
        $fieldDepartmentData->setType(SelectField::CODE);
        $fieldDepartmentData->setName("Departments");
        $fieldDepartmentData->setFieldCode("departments");
        $fieldDepartmentData->setIsRequired(true);
        $fieldDepartmentData->setUniqueId();
        $fieldDepartmentData->setFieldProgrammingCode("departments");
        $fieldDepartmentData->setData(['options' => $optionDepartmentInfoScheme->getOptionData()]);

        $options = new SelectField(new OptionDataHelperProvider(new DoctrineDataProvider($em)), $fieldDepartmentData);

        $this->assertEquals($testOptions, $options->getOptions());
    }

    public function testDbOptions()
    {
        self::bootKernel();
        /** @var EntityManagerInterface $em */
        $em = self::$container->get('doctrine')->getManager();

        $optionDepartmentInfoScheme = new OptionsInfoScheme([]);
        $optionDepartmentInfoScheme->setParams([]);
        $optionDepartmentInfoScheme->setClass(Department::class);
        $optionDepartmentInfoScheme->setFieldMap('id', 'title');

        $fieldDepartmentData = new FieldDataHolder();
        $fieldDepartmentData->setType(SelectField::CODE);
        $fieldDepartmentData->setName("Departments");
        $fieldDepartmentData->setFieldCode("departments");
        $fieldDepartmentData->setIsRequired(true);
        $fieldDepartmentData->setUniqueId();
        $fieldDepartmentData->setFieldProgrammingCode("departments");
        $fieldDepartmentData->setData(['options' => $optionDepartmentInfoScheme->getOptionData()]);


        $options = new SelectField(new OptionDataHelperProvider(new DoctrineDataProvider($em)), $fieldDepartmentData);

        $testOptions = [];
        /** @var Department[] $dp */
        $dp = $em->getRepository(Department::class)->findAll();
        foreach ($dp as $value) {
            $testOptions[$value->getId()] = $value->getTitle();
        }

        $this->assertEquals($testOptions, $options->getOptions());
    }

    public function testLinkedOptions()
    {
        self::bootKernel();
        /** @var EntityManagerInterface $em */
        $em = self::$container->get('doctrine')->getManager();
        $client = new Client();
        $client->setFullName("ООО Ромашка");
        $client->setCrmOEId(1);
        $em->persist($client);
        $em->flush();

        $departmentOne = new Department("Test one", $client);
        $departmentTwo = new Department("Test two", $client);
        $em->persist($departmentOne);
        $em->persist($departmentTwo);
        $em->flush();


        $optionClientInfoScheme = new OptionsInfoScheme([]);
        $optionClientInfoScheme->setParams([]);
        $optionClientInfoScheme->setClass(Client::class);
        $optionClientInfoScheme->setFieldMap('id', 'fullName');

        $fieldClientData = new FieldDataHolder();
        $fieldClientData->setType(SelectField::CODE);
        $fieldClientData->setName("Clients");
        $fieldClientData->setFieldCode("clients");
        $fieldClientData->setFieldProgrammingCode("clients");
        $fieldClientData->setIsRequired(true);
        $fieldClientData->setUniqueId();
        $fieldClientData->setData(array_merge(['default' => $client->getId()], ['options' => $optionClientInfoScheme->getOptionData()]));


        $optionDepartmentInfoScheme = new OptionsInfoScheme([]);
        $optionDepartmentInfoScheme->setParams(['clientId' => 1000]);
        $optionDepartmentInfoScheme->setClass(Department::class);
        $optionDepartmentInfoScheme->setFieldMap('id', 'title');

        $fieldDepartmentData = new FieldDataHolder();
        $fieldDepartmentData->setType(SelectField::CODE);
        $fieldDepartmentData->setName("Departments");
        $fieldDepartmentData->setFieldCode("departments");
        $fieldDepartmentData->setIsRequired(true);
        $fieldDepartmentData->setUniqueId();
        $fieldDepartmentData->setFieldProgrammingCode("departments");
        $fieldDepartmentData->setData(['options' => $optionDepartmentInfoScheme->getOptionData()]);
        $fieldDepartmentData->setLinked(
            [
                $fieldClientData->getUniqueFieldId() => 'clientId'
            ]
        );


        $options = new SelectField(new OptionDataHelperProvider(new DoctrineDataProvider($em)), $fieldDepartmentData);
        $options->setLinkedFieldValues([
            $fieldClientData->getUniqueFieldId() => $client->getId(),
        ]);

        $testOptions =
            [
                $departmentOne->getId() => $departmentOne->getTitle(),
                $departmentTwo->getId() => $departmentTwo->getTitle(),
            ];

        $this->assertEquals($testOptions, $options->getOptions());


        $em->remove($departmentOne);
        $em->remove($departmentTwo);
        $em->remove($client);
        $em->flush();
    }
}
