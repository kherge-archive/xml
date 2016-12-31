<?php

namespace Test\KHerGe\XML;

use KHerGe\XML\FileReader;
use KHerGe\XML\FileReaderFactory;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Verifies that the XML file reader factory functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 *
 * @covers \KHerGe\XML\AbstractReaderFactory
 * @covers \KHerGe\XML\FileReaderFactory
 */
class FileReaderFactoryTest extends TestCase
{
    /**
     * The XML file reader factory.
     *
     * @var FileReaderFactory
     */
    private $factory;

    /**
     * Verify that a new XML file reader is returned.
     */
    public function testCreateANewXmlFileReader()
    {
        self::assertInstanceOf(
            FileReader::class,
            $this->factory->create('php://memory'),
            'A new XML file reader was not returned.'
        );
    }

    /**
     * Verify that a new XML file reader is returned for a file with flags.
     */
    public function testCreateANewXmlFileReaderWithFlags()
    {
        self::assertInstanceOf(
            FileReader::class,
            $this->factory->open('php://memory'),
            'A new XML file reader was not returned.'
        );
    }

    /**
     * Verify that the default libxml flags can be set and retrieved.
     */
    public function testSetAndRetrieveTheDefaultLibxmlFlags()
    {
        $flags = 123;

        $this->factory->setDefaultFlags($flags);

        self::assertEquals(
            $flags,
            $this->factory->getDefaultFlags(),
            'The default flags were not set or retrieved.'
        );
    }

    /**
     * Verify that the type of the resource is supported.
     */
    public function testFileResourceShouldBeSupported()
    {
        self::assertTrue(
            $this->factory->supportsResource(
                null,
                FileReaderFactory::RESOURCE_TYPE
            ),
            'The resource type was not supported.'
        );
    }

    /**
     * Creates a new XML file reader factory.
     */
    protected function setUp()
    {
        $this->factory = new FileReaderFactory();
    }
}
