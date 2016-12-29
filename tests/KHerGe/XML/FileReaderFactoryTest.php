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
            $this->factory->open('php://memory'),
            'A new XML file reader was not returned.'
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
