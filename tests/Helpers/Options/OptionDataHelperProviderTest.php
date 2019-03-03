<?php

namespace Devian\FrontendForms\Helpers\Options;

use AppBundle\Core\Data\Provider\DataProviderInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\WebTestCase;

/**
 * Class OptionDataHelperProvider
 * @package Devian\FrontendForms\Helpers\Options
 */
class OptionDataHelperProviderTest extends WebTestCase
{

    private const MANUAL_OPTIONS = [
        'options' => [
            1 => "2",
            2 => "3",
            3 => "4",
        ]
    ];

    private const DB_OPTIONS_ALL = [
        'class' => Client::class,
        'fieldMap' => ['key' => 'crmOEId', 'value' => 'number'],
        'params' => [],
    ];

    private const DB_OPTIONS_CRITERIA = [
        'class' => Client::class,
        'fieldMap' => ['key' => 'crmOEId', 'value' => 'number'],
        'params' => ['clientId' => 2],
    ];

    public function testGetOptions()
    {
        $dbOptionsTesAll = [
            2 => 1111,
            3 => 2222,
            4 => 3333,
        ];
        $dbOptionsTesCr = [
            6 => 8888,
            7 => 9999,
            8 => 0000,
        ];
        /** @var DataProviderInterface|MockObject $dp */
        $dp = $this->createMock(DataProviderInterface::class);
        $dp->method('findAll')->willReturn([
            (new Client())->setNumber(1111)->setCrmOEId(2),
            (new Client())->setNumber(2222)->setCrmOEId(3),
            (new Client())->setNumber(3333)->setCrmOEId(4),
        ]);
        $dp->method('findBy')->willReturn([
            (new Client())->setNumber(8888)->setCrmOEId(6),
            (new Client())->setNumber(9999)->setCrmOEId(7),
            (new Client())->setNumber(0000)->setCrmOEId(8),
        ]);

        $odhp = new OptionDataHelperProvider($dp);
        $this->assertEquals(self::MANUAL_OPTIONS['options'], $odhp->getOptions(self::MANUAL_OPTIONS), "Неверный ответ на забитые вручную опции");
        $this->assertEquals($dbOptionsTesAll, $odhp->getOptions(self::DB_OPTIONS_ALL), "Неверный ответ на возвращаемые из базы данные (выборка ALL)");
        $this->assertEquals($dbOptionsTesCr, $odhp->getOptions(self::DB_OPTIONS_CRITERIA), "Неверный ответ на возвращаемые из базы данные (выборка Criteria)");
    }

}
