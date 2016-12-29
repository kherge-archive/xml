<?php

namespace Test\KHerGe\XML\Node;

use KHerGe\XML\Exception\Node\NoSuchAttributeException;
use KHerGe\XML\Node\Node;
use KHerGe\XML\Node\NodeInterface;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Verifies that the node representation functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 *
 * @covers \KHerGe\XML\Node\Node
 */
class NodeTest extends TestCase
{
    /**
     * The attributes.
     *
     * @var string[]
     */
    private $attributes = [
        'a' => 'alpha',
        'b' => 'beta',
        'c' => 'gamma'
    ];

    /**
     * The depth of the node.
     *
     * @var integer
     */
    private $depth = 3;

    /**
     * The language of the node.
     *
     * @var string
     */
    private $language = 'en';

    /**
     * The name of the node.
     *
     * @var string
     */
    private $name = 'test';

    /**
     * The node representation.
     *
     * @var Node
     */
    private $node;

    /**
     * The namespace prefix.
     *
     * @var string
     */
    private $prefix = 't';

    /**
     * The namespace URI.
     *
     * @var string
     */
    private $uri = 'urn:kevin.herrera.io:test';

    /**
     * The value of the node.
     *
     * @var string
     */
    private $value = 'The test value.';

    /**
     * Returns the list of flags and their assertions.
     *
     * @return array[]] The flags and assertions.
     */
    public function getFlagAssertions()
    {
        return [
            [
                NodeInterface::TYPE_ATTRIBUTE,
                function (Node $node) {
                    self::assertTrue(
                        $node->isAttribute(),
                        'The node should be an attribute.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_CDATA,
                function (Node $node) {
                    self::assertTrue(
                        $node->isCDATA(),
                        'The node should be CDATA.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_COMMENT,
                function (Node $node) {
                    self::assertTrue(
                        $node->isComment(),
                        'The node should be a comment.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_DOCUMENT,
                function (Node $node) {
                    self::assertTrue(
                        $node->isDocument(),
                        'The node should be the document node.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_DOCUMENT_FRAGMENT,
                function (Node $node) {
                    self::assertTrue(
                        $node->isDocumentFragment(),
                        'The node should be a document fragment.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_DOCUMENT_TYPE,
                function (Node $node) {
                    self::assertTrue(
                        $node->isDocumentType(),
                        'The node should be a document type.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_END_ELEMENT,
                function (Node $node) {
                    self::assertTrue(
                        $node->isElement(),
                        'The node should be an element.'
                    );

                    self::assertTrue(
                        $node->isEnd(),
                        'The node should be the end element.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_END_ENTITY,
                function (Node $node) {
                    self::assertTrue(
                        $node->isEntity(),
                        'The node should be an entity.'
                    );

                    self::assertTrue(
                        $node->isEnd(),
                        'The node should be the end entity.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_ELEMENT,
                function (Node $node) {
                    self::assertTrue(
                        $node->isElement(),
                        'The node should be an element.'
                    );

                    self::assertTrue(
                        $node->isStart(),
                        'The node should be the start element.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_ENTITY,
                function (Node $node) {
                    self::assertTrue(
                        $node->isEntity(),
                        'The node should be an entity.'
                    );

                    self::assertTrue(
                        $node->isStart(),
                        'The node should be the start entity.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_ENTITY_REFERENCE,
                function (Node $node) {
                    self::assertTrue(
                        $node->isEntityReference(),
                        'The node should be an entity reference.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_INSIGNIFICANT_WHITESPACE,
                function (Node $node) {
                    self::assertTrue(
                        $node->isInsignificantWhitespace(),
                        'The node should be insignificant whitespace.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_NOTATION,
                function (Node $node) {
                    self::assertTrue(
                        $node->isNotation(),
                        'The node should be a notation.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_PROCESSING_INSTRUCTION,
                function (Node $node) {
                    self::assertTrue(
                        $node->isProcessingInstruction(),
                        'The node should be a processing instruction.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_SIGNIFICANT_WHITESPACE,
                function (Node $node) {
                    self::assertTrue(
                        $node->isSignificantWhitespace(),
                        'The node should be significant whitespace.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_TEXT,
                function (Node $node) {
                    self::assertTrue(
                        $node->isText(),
                        'The node should be text.'
                    );
                }
            ],

            [
                NodeInterface::TYPE_XML_DECLARATION,
                function (Node $node) {
                    self::assertTrue(
                        $node->isXMLDeclaration(),
                        'The node should be the XML declaration.'
                    );
                }
            ]
        ];
    }

    /**
     * Verify that the value of an attribute is returned.
     */
    public function testGetTheValueOfAnAttribute()
    {
        self::assertEquals(
            $this->attributes['c'],
            $this->node->getAttribute('c'),
            'The value of the attribute was not returned.'
        );
    }

    /**
     * Verify that an exception is thrown when retrieving a non-existent attribute.
     */
    public function testThrowAnExceptionWhenTheAttributeDoesNotExist()
    {
        $this->expectException(NoSuchAttributeException::class);
        $this->expectExceptionMessage(
            "The attribute \"test\" does not exist."
        );

        $this->node->getAttribute('test');
    }

    /**
     * Verify that all of the attributes are returned.
     */
    public function testGetAllOfTheAttributes()
    {
        self::assertEquals(
            $this->attributes,
            $this->node->getAttributes(),
            'The attributes were not returned.'
        );
    }

    /**
     * Verify that the depth of the node is returned.
     */
    public function testGetTheDepthOfTheNodeInTheTree()
    {
        self::assertEquals(
            $this->depth,
            $this->node->getDepth(),
            'The depth was not returned.'
        );
    }

    /**
     * Verify that the XML language is returned.
     */
    public function testGetTheLanguageForTheNode()
    {
        self::assertEquals(
            $this->language,
            $this->node->getLanguage(),
            'The language was not returned.'
        );
    }

    /**
     * Verify that the local name of the node is returned.
     */
    public function testGetTheLocalNameOfTheNode()
    {
        self::assertEquals(
            $this->name,
            $this->node->getName(),
            'The local name was not returned.'
        );
    }

    /**
     * Verify that the namespace prefix is returned.
     */
    public function testGetTheNamespacePrefix()
    {
        self::assertEquals(
            $this->prefix,
            $this->node->getPrefix(),
            'The namespace prefix was not returned.'
        );
    }

    /**
     * Verify that the qualified name of the node is returned.
     */
    public function testGetTheQualifiedNameOfTheNode()
    {
        self::assertEquals(
            $this->prefix . ':' . $this->name,
            $this->node->getQualifiedName(),
            'The qualified name was not returned.'
        );
    }

    /**
     * Verify that the local name is returned if there is no namespace prefix.
     */
    public function testGetTheLocalNameIfThereIsNoNamespacePrefixForTheQualifiedName()
    {
        $this->node = new Node(
            NodeInterface::TYPE_ELEMENT,
            $this->name,
            $this->value,
            $this->depth,
            $this->language,
            null,
            null,
            $this->attributes
        );

        self::assertEquals(
            $this->name,
            $this->node->getQualifiedName(),
            'The local name was not returned.'
        );
    }

    /**
     * Verify that the namespace URI is returned.
     */
    public function testGetTheNamespaceUri()
    {
        self::assertEquals(
            $this->uri,
            $this->node->getURI(),
            'The namespace URI was not returned.'
        );
    }

    /**
     * Verify that the value of the node is returned.
     */
    public function testGetTheValueOfTheNode()
    {
        self::assertEquals(
            $this->value,
            $this->node->getValue(),
            'The value of the node was not returned.'
        );
    }

    /**
     * Verify that the node is of the proper type.
     *
     * @param integer  $type       The node type.
     * @param callable $assertions The assertions.
     *
     * @dataProvider getFlagAssertions
     */
    public function testTheNodeTypeIsCorrect($type, callable $assertions)
    {
        $this->node = new Node(
            $type,
            $this->name,
            $this->value,
            $this->depth,
            $this->language,
            $this->prefix,
            $this->uri,
            $this->attributes
        );

        $assertions($this->node);
    }

    /**
     * Creates a new node representation.
     */
    protected function setUp()
    {
        $this->node = new Node(
            NodeInterface::TYPE_ELEMENT,
            $this->name,
            $this->value,
            $this->depth,
            $this->language,
            $this->prefix,
            $this->uri,
            $this->attributes
        );
    }
}
