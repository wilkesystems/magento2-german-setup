<?php
/**
 * Copyright © 2018 Magento. All rights reserved..
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Test\Unit\Model;

/**
 * Class Config
 *
 * @package WilkeSystems\MageGermanSetup\Test\Unit\Model
 */
class Config extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \WilkeSystems\MageGermanSetup\Model\Config
     */
    private $config;

    public function setUp()
    {
        parent::setUp();

        $readerData = [
            'default' => [
                'system_config' => [
                    'customer__create_account__confirm' => 0
                ]
            ],
            'de'      => [
                'system_config' => [
                    'general__country__default' => 'DE'
                ]
            ],
            'at'      => []
        ];

        $readerMock = $this->getMock('WilkeSystems\MageGermanSetup\Model\Config\Reader', ['read'], [], '', false);
        $readerMock->expects($this->once())->method('read')->will($this->returnValue($readerData));

        $cacheMock = $this->getMock('Magento\Framework\Config\CacheInterface');

        $this->config = new \WilkeSystems\MageGermanSetup\Model\Config(
            $readerMock,
            $cacheMock,
            'de'
        );
    }

    /**
     * @test
     */
    public function getCountry()
    {
        $this->assertEquals('de', $this->config->getCountry());
    }

    /**
     * @test
     */
    public function getAllowedCountries()
    {
        $this->assertEquals([1 => 'de', 2 => 'at'], $this->config->getAllowedCountries());
    }

    /**
     * @test
     */
    public function getSystemConfig()
    {
        $expectedResult = [
            'customer__create_account__confirm' => 0,
            'general__country__default'         => 'DE'
        ];

        $this->assertEquals($expectedResult, $this->config->getSystemConfig());
    }
}
