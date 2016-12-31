<?php

namespace Test\KHerGe\XML;

use KHerGe\XML\CallableReader;
use KHerGe\XML\Exception\Reader\InvalidCallableResultException;
use KHerGe\XML\Node\NodeBuilderFactory;
use KHerGe\XML\Node\PathBuilderFactory;
use PHPUnit_Framework_TestCase as TestCase;
use XMLReader;

/**
 * Verifies that the callable XML document reader functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 *
 * @covers \KHerGe\XML\CallableReader
 */
class CallableReaderTest extends TestCase
{
    /**
     * The callable XML document reader.
     *
     * @var CallableReader
     */
    private $reader;

    /**
     * Verify that the XML document is read.
     */
    public function testReadANodeFromTheXmlFile()
    {
        foreach ($this->reader as $path => $node) {
            self::assertEquals(
                '/test',
                $path,
                'The expected path was not returned.'
            );

            self::assertEquals(
                'test',
                $node->getLocalName(),
                'The expected node was not read from the file.'
            );
        }
    }

    /**
     * Verify that an exception is thrown if the callable does not return an XML reader.
     */
    public function testThrowAnExceptionIfTheCallableDoesNotReturnAnXmlReader()
    {
        $reader = new CallableReader(
            function () {
                return 123;
            },
            new PathBuilderFactory(),
            new NodeBuilderFactory()
        );

        $this->expectException(InvalidCallableResultException::class);
        $this->expectExceptionMessage(
            'The XML document factory callable returned "integer", expected "XMLReader".'
        );

        $reader->rewind();
    }

    /**
     * Creates a new callable XML document reader.
     */
    protected function setUp()
    {
        $this->reader = new CallableReader(
            function () {
                $reader = new XMLReader();
                $reader->xml('<test/>');

                return $reader;
            },
            new PathBuilderFactory(),
            new NodeBuilderFactory()
        );
    }
}
