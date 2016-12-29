<?php

namespace Test\KHerGe\XML\Node;

use KHerGe\XML\Node\PathBuilder;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Verifies that the path builder functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 *
 * @covers \KHerGe\XML\Node\PathBuilder
 */
class PathBuilderTest extends TestCase
{
    /**
     * The path builder.
     *
     * @var PathBuilder
     */
    private $builder;

    /**
     * Returns a list of expected paths and their build process.
     *
     * @return array[]
     */
    public function getExpectedPaths()
    {
        return [

            [
                '/',
                function (PathBuilder $builder) {
                    $builder->pop();
                }
            ],

            [
                '/root[2]',
                function (PathBuilder $builder) {
                    $builder->push('root');
                    $builder->pop();
                    $builder->pop();
                    $builder->push('root');
                }
            ],

            [
                '/root',
                function (PathBuilder $builder) {
                    $builder->push('root');
                }
            ],

            [
                '/root/child',
                function (PathBuilder $builder) {
                    $builder->push('root');
                    $builder->push('child');
                }
            ],

            [
                '/root',
                function (PathBuilder $builder) {
                    $builder->push('root');
                    $builder->push('child');
                    $builder->pop();
                }
            ],

            [
                '/root/child[2]',
                function (PathBuilder $builder) {
                    $builder->push('root');
                    $builder->push('child');
                    $builder->pop();
                    $builder->push('child');
                }
            ],

            [
                '/root/child[2]/sub',
                function (PathBuilder $builder) {
                    $builder->push('root');
                    $builder->push('child');
                    $builder->push('sub');
                    $builder->pop();
                    $builder->pop();
                    $builder->push('child');
                    $builder->push('sub');
                }
            ],

            [
                '/root/child[3]',
                function (PathBuilder $builder) {
                    $builder->push('root');
                    $builder->push('child');
                    $builder->push('sub');
                    $builder->pop();
                    $builder->pop();
                    $builder->push('child');
                    $builder->push('sub');
                    $builder->push('another');
                    $builder->pop();
                    $builder->pop();
                    $builder->pop();
                    $builder->push('child');
                }
            ],

        ];
    }

    /**
     * Verify that the path builder creates a correct node path.
     *
     * @param string   $expected The expected path.
     * @param callable $build    The build callable.
     *
     * @dataProvider getExpectedPaths
     */
    public function testVerifyThatThePathIsTrackedAndBuiltCorrectly(
        $expected,
        callable $build
    ) {
        $build($this->builder);

        self::assertEquals(
            $expected,
            $this->builder->getPath(),
            'The path was not tracked or built correctly.'
        );
    }

    /**
     * Verify that the position of the current node is returned.
     *
     * @depends testVerifyThatThePathIsTrackedAndBuiltCorrectly
     */
    public function testGetThePositionOfTheCurrentNode()
    {
        self::assertNull(
            $this->builder->getPosition(),
            'There is no node to get a position on.'
        );

        $this->builder->push('root');
        $this->builder->push('child');
        $this->builder->pop();
        $this->builder->push('child');

        self::assertEquals(
            2,
            $this->builder->getPosition(),
            'The expected position was not returned.'
        );
    }

    /**
     * Creates a new path builder.
     */
    protected function setUp()
    {
        $this->builder = new PathBuilder();
    }
}
