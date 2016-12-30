<?php

namespace Test\KHerGe\XML;

use KHerGe\XML\AbstractReader;
use KHerGe\XML\Exception\Reader\MissingInternalReaderException;
use KHerGe\XML\Node\NodeBuilderFactory;
use KHerGe\XML\Node\NodeInterface;
use KHerGe\XML\Node\PathBuilderFactory;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use PHPUnit_Framework_TestCase as TestCase;
use XMLReader;

/**
 * A test concrete implementation of `AbstractReader`.
 */
class TestReader extends AbstractReader
{
    /**
     * {@inheritdoc}
     */
    protected function reset()
    {
        $reader = new XMLReader();
        $reader->xml(
            <<<XML
<root a="alpha" type="test">
  <child id="1">
    <t:sub xml:lang="es" xmlns:t="url:kevin.herrera.io">prueba</t:sub>
    <t:sub xmlns:t="url:kevin.herrera.io"/>
  </child>
</root>
XML
        );

        $this->setReader($reader);
    }
}

/**
 * Verifies that the abstract XML document reader functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 *
 * @covers \KHerGe\XML\AbstractReader
 */
class AbstractReaderTest extends TestCase
{
    /**
     * The abstract XML document reader.
     *
     * @var AbstractReader|NodeInterface[]
     */
    private static $reader;

    /**
     * Returns the expected node paths and their assertions.
     *
     * @return array[] The expected paths and assertions.
     */
    public function getExpectedPaths()
    {
        return [

            // #0
            [
                '/root',
                function (NodeInterface $node) {
                    self::assertEquals(
                        [
                            'a' => 'alpha',
                            'type' => 'test'
                        ],
                        $node->getAttributes(),
                        'The attributes were not set.'
                    );

                    self::assertEquals(
                        0,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertNull(
                        $node->getLanguage(),
                        'The language should not be set.'
                    );

                    self::assertEquals(
                        'root',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertNull(
                        $node->getPrefix(),
                        'The namespace prefix should not be set.'
                    );

                    self::assertTrue(
                        $node->isElement(),
                        'The node should be an element.'
                    );

                    self::assertTrue(
                        $node->isStart(),
                        'The node should be the starting element.'
                    );

                    self::assertNull(
                        $node->getURI(),
                        'The namespace URI should not be set.'
                    );

                    self::assertNull(
                        $node->getValue(),
                        'The value should not be set.'
                    );
                }
            ],

            // #1
            [
                '/root/#text',
                function (NodeInterface $node) {
                    self::assertEmpty(
                        $node->getAttributes(),
                        'No attributes should be set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertNull(
                        $node->getLanguage(),
                        'The language should not be set.'
                    );

                    self::assertEquals(
                        '#text',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertNull(
                        $node->getPrefix(),
                        'The namespace prefix should not be set.'
                    );

                    self::assertTrue(
                        $node->isSignificantWhitespace(),
                        'The node should be significant whitespace.'
                    );

                    self::assertNull(
                        $node->getURI(),
                        'The namespace URI should not be set.'
                    );

                    self::assertEquals(
                        "\n  ",
                        $node->getValue(),
                        'The expected whitespace was not set.'
                    );
                }
            ],

            // #2
            [
                '/root/child',
                function (NodeInterface $node) {
                    self::assertEquals(
                        ['id' => '1'],
                        $node->getAttributes(),
                        'The attributes were not set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertNull(
                        $node->getLanguage(),
                        'The language should not be set.'
                    );

                    self::assertEquals(
                        'child',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertNull(
                        $node->getPrefix(),
                        'The namespace prefix should not be set.'
                    );

                    self::assertTrue(
                        $node->isElement(),
                        'The node should be an element.'
                    );

                    self::assertTrue(
                        $node->isStart(),
                        'The node should be the starting element.'
                    );

                    self::assertNull(
                        $node->getURI(),
                        'The namespace URI should not be set.'
                    );

                    self::assertNull(
                        $node->getValue(),
                        'The value should not be set.'
                    );
                }
            ],

            // #3
            [
                '/root/child/#text',
                function (NodeInterface $node) {
                    self::assertEmpty(
                        $node->getAttributes(),
                        'No attributes should be set.'
                    );

                    self::assertEquals(
                        2,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertNull(
                        $node->getLanguage(),
                        'The language should not be set.'
                    );

                    self::assertEquals(
                        '#text',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertNull(
                        $node->getPrefix(),
                        'The namespace prefix should not be set.'
                    );

                    self::assertTrue(
                        $node->isSignificantWhitespace(),
                        'The node should be significant whitespace.'
                    );

                    self::assertNull(
                        $node->getURI(),
                        'The namespace URI should not be set.'
                    );

                    self::assertEquals(
                        "\n    ",
                        $node->getValue(),
                        'The expected whitespace was not set.'
                    );
                }
            ],

            // #4
            [
                '/root/child/t:sub',
                function (NodeInterface $node) {
                    self::assertEquals(
                        [
                            'xml:lang' => 'es',
                            'xmlns:t' => 'url:kevin.herrera.io'
                        ],
                        $node->getAttributes(),
                        'The attributes were not set.'
                    );

                    self::assertEquals(
                        2,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertEquals(
                        'es',
                        $node->getLanguage(),
                        'The language was not set.'
                    );

                    self::assertEquals(
                        'sub',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertEquals(
                        't',
                        $node->getPrefix(),
                        'The namespace prefix was not set.'
                    );

                    self::assertTrue(
                        $node->isElement(),
                        'The node should be an element.'
                    );

                    self::assertTrue(
                        $node->isStart(),
                        'The node should be the starting element.'
                    );

                    self::assertEquals(
                        'url:kevin.herrera.io',
                        $node->getURI(),
                        'The namespace URI was not set.'
                    );

                    self::assertNull(
                        $node->getValue(),
                        'The value should not be set.'
                    );
                }
            ],

            // #5
            [
                '/root/child/t:sub/#text',
                function (NodeInterface $node) {
                    self::assertEmpty(
                        $node->getAttributes(),
                        'The attributes should not be set.'
                    );

                    self::assertEquals(
                        3,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertEquals(
                        'es',
                        $node->getLanguage(),
                        'The language was not inherited from the parent.'
                    );

                    self::assertEquals(
                        '#text',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertNull(
                        $node->getPrefix(),
                        'The namespace prefix should not be set.'
                    );

                    self::assertTrue(
                        $node->isText(),
                        'The node should be text.'
                    );

                    self::assertNull(
                        $node->getURI(),
                        'The namespace URI should not be set.'
                    );

                    self::assertEquals(
                        'prueba',
                        $node->getValue(),
                        'The value of the node was not set.'
                    );
                }
            ],

            // #6
            [
                '/root/child/t:sub',
                function (NodeInterface $node) {
                    self::assertEquals(
                        [
                            'xml:lang' => 'es',
                            'xmlns:t' => 'url:kevin.herrera.io'
                        ],
                        $node->getAttributes(),
                        'The attributes were not set.'
                    );

                    self::assertEquals(
                        2,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertEquals(
                        'es',
                        $node->getLanguage(),
                        'The language was not inherited from the starting element.'
                    );

                    self::assertEquals(
                        'sub',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertEquals(
                        't',
                        $node->getPrefix(),
                        'The namespace prefix was not set.'
                    );

                    self::assertTrue(
                        $node->isElement(),
                        'The node should be an element.'
                    );

                    self::assertTrue(
                        $node->isEnd(),
                        'The node should be the end element.'
                    );

                    self::assertEquals(
                        'url:kevin.herrera.io',
                        $node->getURI(),
                        'The namespace URI was not set.'
                    );

                    self::assertNull(
                        $node->getValue(),
                        'The value should not be set.'
                    );
                }
            ],

            // #7
            [
                '/root/child/#text[2]',
                function (NodeInterface $node) {
                    self::assertEmpty(
                        $node->getAttributes(),
                        'No attributes should be set.'
                    );

                    self::assertEquals(
                        2,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertNull(
                        $node->getLanguage(),
                        'The language should not be set.'
                    );

                    self::assertEquals(
                        '#text',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        2,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertNull(
                        $node->getPrefix(),
                        'The namespace prefix should not be set.'
                    );

                    self::assertTrue(
                        $node->isSignificantWhitespace(),
                        'The node should be significant whitespace.'
                    );

                    self::assertNull(
                        $node->getURI(),
                        'The namespace URI should not be set.'
                    );

                    self::assertEquals(
                        "\n    ",
                        $node->getValue(),
                        'The expected whitespace was not set.'
                    );
                }
            ],

            // #8
            [
                '/root/child/t:sub[2]',
                function (NodeInterface $node) {
                    self::assertEquals(
                        [
                            'xmlns:t' => 'url:kevin.herrera.io'
                        ],
                        $node->getAttributes(),
                        'The attributes were not set.'
                    );

                    self::assertEquals(
                        2,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertNull(
                        $node->getLanguage(),
                        'The language should not be set.'
                    );

                    self::assertEquals(
                        'sub',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        2,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertEquals(
                        't',
                        $node->getPrefix(),
                        'The namespace prefix was not set.'
                    );

                    self::assertTrue(
                        $node->isElement(),
                        'The node should be an element.'
                    );

                    self::assertTrue(
                        $node->isStart(),
                        'The node should be the starting element.'
                    );

                    self::assertTrue(
                        $node->isEnd(),
                        'The node should be the ending element.'
                    );

                    self::assertEquals(
                        'url:kevin.herrera.io',
                        $node->getURI(),
                        'The namespace URI was not set.'
                    );

                    self::assertNull(
                        $node->getValue(),
                        'The value should not be set.'
                    );
                }
            ],

            // #9
            [
                '/root/child/#text[3]',
                function (NodeInterface $node) {
                    self::assertEmpty(
                        $node->getAttributes(),
                        'No attributes should be set.'
                    );

                    self::assertEquals(
                        2,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertNull(
                        $node->getLanguage(),
                        'The language should not be set.'
                    );

                    self::assertEquals(
                        '#text',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        3,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertNull(
                        $node->getPrefix(),
                        'The namespace prefix should not be set.'
                    );

                    self::assertTrue(
                        $node->isSignificantWhitespace(),
                        'The node should be significant whitespace.'
                    );

                    self::assertNull(
                        $node->getURI(),
                        'The namespace URI should not be set.'
                    );

                    self::assertEquals(
                        "\n  ",
                        $node->getValue(),
                        'The expected whitespace was not set.'
                    );
                }
            ],

            // #10
            [
                '/root/child',
                function (NodeInterface $node) {
                    self::assertEquals(
                        ['id' => '1'],
                        $node->getAttributes(),
                        'The attributes were not set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertNull(
                        $node->getLanguage(),
                        'The language should not be set.'
                    );

                    self::assertEquals(
                        'child',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertNull(
                        $node->getPrefix(),
                        'The namespace prefix should not be set.'
                    );

                    self::assertTrue(
                        $node->isElement(),
                        'The node should be an element.'
                    );

                    self::assertTrue(
                        $node->isEnd(),
                        'The node should be the ending element.'
                    );

                    self::assertNull(
                        $node->getURI(),
                        'The namespace URI should not be set.'
                    );

                    self::assertNull(
                        $node->getValue(),
                        'The value should not be set.'
                    );
                }
            ],

            // #11
            [
                '/root/#text[2]',
                function (NodeInterface $node) {
                    self::assertEmpty(
                        $node->getAttributes(),
                        'No attributes should be set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertNull(
                        $node->getLanguage(),
                        'The language should not be set.'
                    );

                    self::assertEquals(
                        '#text',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        2,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertNull(
                        $node->getPrefix(),
                        'The namespace prefix should not be set.'
                    );

                    self::assertTrue(
                        $node->isSignificantWhitespace(),
                        'The node should be significant whitespace.'
                    );

                    self::assertNull(
                        $node->getURI(),
                        'The namespace URI should not be set.'
                    );

                    self::assertEquals(
                        "\n",
                        $node->getValue(),
                        'The expected whitespace was not set.'
                    );
                }
            ],

            // #12
            [
                '/root',
                function (NodeInterface $node) {
                    self::assertEquals(
                        [
                            'a' => 'alpha',
                            'type' => 'test'
                        ],
                        $node->getAttributes(),
                        'The attributes were not set.'
                    );

                    self::assertEquals(
                        0,
                        $node->getDepth(),
                        'The depth was not set.'
                    );

                    self::assertNull(
                        $node->getLanguage(),
                        'The language should not be set.'
                    );

                    self::assertEquals(
                        'root',
                        $node->getLocalName(),
                        'The local name was not set.'
                    );

                    self::assertEquals(
                        1,
                        $node->getPosition(),
                        'The position of the node was not set.'
                    );

                    self::assertNull(
                        $node->getPrefix(),
                        'The namespace prefix should not be set.'
                    );

                    self::assertTrue(
                        $node->isElement(),
                        'The node should be an element.'
                    );

                    self::assertTrue(
                        $node->isEnd(),
                        'The node should be the ending element.'
                    );

                    self::assertNull(
                        $node->getURI(),
                        'The namespace URI should not be set.'
                    );

                    self::assertNull(
                        $node->getValue(),
                        'The value should not be set.'
                    );
                }
            ],

        ];
    }

    /**
     * Verify that all of the nodes are iterated through.
     *
     * @param string   $path       The expected node path.
     * @param callable $assertions The assertions.
     *
     * @dataProvider getExpectedPaths
     */
    public function testIterateThroughANodeProperly($path, callable $assertions)
    {
        self::assertTrue(
            self::$reader->valid(),
            'The iterator should be valid.'
        );

        self::assertEquals(
            $path,
            self::$reader->key(),
            'The expected element path was not returned.'
        );

        $assertions(self::$reader->current());
    }

    /**
     * Verify that an exception is thrown when the `XMLReader` is not set.
     */
    public function testThrowAnExceptionWhenXmlReaderIsNotSet()
    {
        /** @var AbstractReader|MockObject $reader */
        $reader = $this
            ->getMockBuilder(AbstractReader::class)
            ->setConstructorArgs(
                [
                    new PathBuilderFactory(),
                    new NodeBuilderFactory()
                ]
            )
            ->setMethods(['reset'])
            ->getMockForAbstractClass()
        ;

        $this->expectException(MissingInternalReaderException::class);

        $reader->rewind();
    }

    /**
     * Creates a new partial mock of the abstract XML document reader.
     */
    public static function setUpBeforeClass()
    {
        self::$reader = new TestReader(
            new PathBuilderFactory(),
            new NodeBuilderFactory()
        );

        self::$reader->rewind();
    }

    /**
     * Iterates to the next node.
     */
    protected function tearDown()
    {
        self::$reader->next();
    }
}
