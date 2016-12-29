<?php

namespace Test\KHerGe\XML\Node;

use KHerGe\XML\Node\NodeBuilder;
use KHerGe\XML\Node\NodeBuilderFactory;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Verifies that the node builder factory functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 *
 * @covers \KHerGe\XML\Node\NodeBuilderFactory
 */
class NodeBuilderFactoryTest extends TestCase
{
    /**
     * Verify that a new node builder is returned.
     */
    public function testCreateANewNodeBuilder()
    {
        self::assertInstanceOf(
            NodeBuilder::class,
            (new NodeBuilderFactory())->createBuilder(),
            'A node builder was not returned.'
        );
    }
}
