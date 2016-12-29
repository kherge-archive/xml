<?php

namespace Test\KHerGe\XML\Node;

use KHerGe\XML\Exception\Node\Builder\MissingDepthException;
use KHerGe\XML\Exception\Node\Builder\MissingLocalNameException;
use KHerGe\XML\Exception\Node\Builder\MissingPositionException;
use KHerGe\XML\Exception\Node\Builder\MissingPrefixException;
use KHerGe\XML\Exception\Node\Builder\MissingTypeException;
use KHerGe\XML\Exception\Node\Builder\MissingURIException;
use KHerGe\XML\Node\Node;
use KHerGe\XML\Node\NodeBuilder;
use KHerGe\XML\Node\NodeInterface;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Verifies that the node builder functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 *
 * @covers \KHerGe\XML\Node\NodeBuilder
 */
class NodeBuilderTest extends TestCase
{
    /**
     * Verify that a new node is built correctly.
     */
    public function testBuildANewNodeCorrectly()
    {
        $attributes = ['a' => 'alpha', 'b' => 'beta', 'c' => 'gamma'];
        $depth = 3;
        $language = 'en';
        $localName = 'test';
        $name = 'd';
        $position = 3;
        $prefix = 't';
        $type = NodeInterface::TYPE_ELEMENT;
        $uri = 'urn:kevin.herrera.io:test';
        $value = 'delta';

        $node = (new NodeBuilder())
            ->setAttributes($attributes)
            ->setAttribute($name, $value)
            ->setDepth($depth)
            ->setLanguage($language)
            ->setLocalName($localName)
            ->setPosition($position)
            ->setPrefix($prefix)
            ->setType($type)
            ->setURI($uri)
            ->setValue($value)
            ->build()
        ;

        self::assertInstanceOf(
            Node::class,
            $node,
            'A new `Node` instance was not returned.'
        );

        self::assertEquals(
            array_merge($attributes, [$name => $value]),
            $node->getAttributes(),
            'The attributes were not set correctly.'
        );

        self::assertEquals(
            $depth,
            $node->getDepth(),
            'The depth was not set correctly.'
        );

        self::assertEquals(
            $language,
            $node->getLanguage(),
            'The language was not set correctly.'
        );

        self::assertEquals(
            $localName,
            $node->getLocalName(),
            'The local name was not set correctly.'
        );

        self::assertEquals(
            $position,
            $node->getPosition(),
            'The position was not set correctly.'
        );

        self::assertEquals(
            $prefix,
            $node->getPrefix(),
            'The namespace prefix was not set correctly.'
        );

        self::assertTrue(
            $node->isElement(),
            'The node type was not set correctly.'
        );

        self::assertEquals(
            $uri,
            $node->getURI(),
            'The namespace URI was not set correctly.'
        );

        self::assertEquals(
            $value,
            $node->getValue(),
            'The value ws not set correctly.'
        );
    }

    /**
     * Verify that an exception is thrown if the depth is not set.
     */
    public function testThrowAnExceptionIfTheDepthIsNotSet()
    {
        $attributes = ['a' => 'alpha', 'b' => 'beta', 'c' => 'gamma'];
        $language = 'en';
        $localName = 'test';
        $name = 'd';
        $position = 3;
        $prefix = 't';
        $type = NodeInterface::TYPE_ELEMENT;
        $uri = 'urn:kevin.herrera.io:test';
        $value = 'delta';

        $this->expectException(MissingDepthException::class);

        (new NodeBuilder())
            ->setAttributes($attributes)
            ->setAttribute($name, $value)
            ->setLanguage($language)
            ->setLocalName($localName)
            ->setPosition($position)
            ->setPrefix($prefix)
            ->setType($type)
            ->setURI($uri)
            ->setValue($value)
            ->build()
        ;
    }

    /**
     * Verify that an exception is thrown if the local name is not set.
     */
    public function testThrowAnExceptionIfTheLocalNameIsNotSet()
    {
        $attributes = ['a' => 'alpha', 'b' => 'beta', 'c' => 'gamma'];
        $depth = 3;
        $language = 'en';
        $name = 'd';
        $position = 3;
        $prefix = 't';
        $type = NodeInterface::TYPE_ELEMENT;
        $uri = 'urn:kevin.herrera.io:test';
        $value = 'delta';

        $this->expectException(MissingLocalNameException::class);

        (new NodeBuilder())
            ->setAttributes($attributes)
            ->setAttribute($name, $value)
            ->setDepth($depth)
            ->setLanguage($language)
            ->setPosition($position)
            ->setPrefix($prefix)
            ->setType($type)
            ->setURI($uri)
            ->setValue($value)
            ->build()
        ;
    }

    /**
     * Verify that an exception is thrown if the position is not set.
     */
    public function testThrowAnExceptionIfThePositionIsNotSet()
    {
        $attributes = ['a' => 'alpha', 'b' => 'beta', 'c' => 'gamma'];
        $depth = 3;
        $language = 'en';
        $localName = 'test';
        $name = 'd';
        $prefix = 't';
        $type = NodeInterface::TYPE_ELEMENT;
        $uri = 'urn:kevin.herrera.io:test';
        $value = 'delta';

        $this->expectException(MissingPositionException::class);

        (new NodeBuilder())
            ->setAttributes($attributes)
            ->setAttribute($name, $value)
            ->setDepth($depth)
            ->setLanguage($language)
            ->setLocalName($localName)
            ->setPrefix($prefix)
            ->setType($type)
            ->setURI($uri)
            ->setValue($value)
            ->build()
        ;
    }

    /**
     * Verify that an exception is thrown if the namespace prefix is not set.
     */
    public function testThrowAnExceptionIfTheNamespacePrefixIsNotSet()
    {
        $attributes = ['a' => 'alpha', 'b' => 'beta', 'c' => 'gamma'];
        $depth = 3;
        $language = 'en';
        $localName = 'test';
        $name = 'd';
        $position = 3;
        $type = NodeInterface::TYPE_ELEMENT;
        $uri = 'urn:kevin.herrera.io:test';
        $value = 'delta';

        $this->expectException(MissingPrefixException::class);

        (new NodeBuilder())
            ->setAttributes($attributes)
            ->setAttribute($name, $value)
            ->setDepth($depth)
            ->setLanguage($language)
            ->setLocalName($localName)
            ->setPosition($position)
            ->setType($type)
            ->setURI($uri)
            ->setValue($value)
            ->build()
        ;
    }

    /**
     * Verify that an exception is thrown if the node type is not set.
     */
    public function testThrowAnExceptionIfTheNodeTypeIsNotSet()
    {
        $attributes = ['a' => 'alpha', 'b' => 'beta', 'c' => 'gamma'];
        $depth = 3;
        $language = 'en';
        $localName = 'test';
        $name = 'd';
        $position = 3;
        $prefix = 't';
        $uri = 'urn:kevin.herrera.io:test';
        $value = 'delta';

        $this->expectException(MissingTypeException::class);

        (new NodeBuilder())
            ->setAttributes($attributes)
            ->setAttribute($name, $value)
            ->setDepth($depth)
            ->setLanguage($language)
            ->setLocalName($localName)
            ->setPosition($position)
            ->setPrefix($prefix)
            ->setURI($uri)
            ->setValue($value)
            ->build()
        ;
    }

    /**
     * Verify that an exception is thrown if the node type is not set.
     */
    public function testThrowAnExceptionIfTheNamespaceUriIsNotSet()
    {
        $attributes = ['a' => 'alpha', 'b' => 'beta', 'c' => 'gamma'];
        $depth = 3;
        $language = 'en';
        $localName = 'test';
        $name = 'd';
        $position = 3;
        $prefix = 't';
        $type = NodeInterface::TYPE_ELEMENT;
        $value = 'delta';

        $this->expectException(MissingURIException::class);

        (new NodeBuilder())
            ->setAttributes($attributes)
            ->setAttribute($name, $value)
            ->setDepth($depth)
            ->setLanguage($language)
            ->setLocalName($localName)
            ->setPosition($position)
            ->setPrefix($prefix)
            ->setType($type)
            ->setValue($value)
            ->build()
        ;
    }
}
