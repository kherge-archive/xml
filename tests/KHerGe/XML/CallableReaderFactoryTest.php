<?php

namespace Test\KHerGe\XML;

use KHerGe\XML\CallableReader;
use KHerGe\XML\CallableReaderFactory;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Verifies that the callable XML document reader factory functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 *
 * @covers \KHerGe\XML\AbstractReaderFactory
 * @covers \KHerGe\XML\CallableReaderFactory
 */
class CallableReaderFactoryTest extends TestCase
{
    /**
     * The callable XML document reader factory.
     *
     * @var CallableReaderFactory
     */
    private $factory;

    /**
     * Verify that a new callable XML document reader is returned.
     */
    public function testCreateANewCallableXmlDocumentReader()
    {
        self::assertInstanceOf(
            CallableReader::class,
            $this->factory->create(function () {}),
            'A new callable XML document reader was not returned.'
        );
    }

    /**
     * Verify that the type of the resource is supported.
     */
    public function testCallableResourceShouldBeSupported()
    {
        self::assertTrue(
            $this->factory->supportsResource(function () {}, null),
            'The resource type was not supported.'
        );
    }

    /**
     * Creates a new callable XML document reader factory.
     */
    protected function setUp()
    {
        $this->factory = new CallableReaderFactory();
    }
}
