<?php

namespace Test\KHerGe\XML\Node;

use KHerGe\XML\Node\PathBuilder;
use KHerGe\XML\Node\PathBuilderFactory;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Verifies that the node path builder factory functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 *
 * @covers \KHerGe\XML\Node\PathBuilderFactory
 */
class PathBuilderFactoryTest extends TestCase
{
    /**
     * Verify that a new node path builder is returned.
     */
    public function testCreateANewNodePathBuilder()
    {
        self::assertInstanceOf(
            PathBuilder::class,
            (new PathBuilderFactory())->createBuilder(),
            'A new node path builder was not returned.'
        );
    }
}
