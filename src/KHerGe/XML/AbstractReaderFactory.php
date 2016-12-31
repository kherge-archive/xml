<?php

namespace KHerGe\XML;

use KHerGe\XML\Node\NodeBuilderFactory;
use KHerGe\XML\Node\NodeBuilderFactoryInterface;
use KHerGe\XML\Node\PathBuilderFactory;
use KHerGe\XML\Node\PathBuilderFactoryInterface;

/**
 * Provides a basic implementation of a XML document reader factory.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
abstract class AbstractReaderFactory implements ReaderFactoryInterface
{
    /**
     * The node builder factory.
     *
     * @var NodeBuilderFactoryInterface
     */
    private $nodeBuilderFactory;

    /**
     * The node path builder factory.
     *
     * @var PathBuilderFactoryInterface
     */
    private $pathBuilderFactory;

    /**
     * Initializes the new XML file reader factory.
     *
     * @param null|PathBuilderFactoryInterface $pathBuilderFactory The node path builder factory.
     * @param NodeBuilderFactoryInterface|null $nodeBuilderFactory The node builder factory.
     */
    public function __construct(
        PathBuilderFactoryInterface $pathBuilderFactory = null,
        NodeBuilderFactoryInterface $nodeBuilderFactory = null
    ) {
        if (null === $nodeBuilderFactory) {
            $nodeBuilderFactory = new NodeBuilderFactory();
        }

        if (null === $pathBuilderFactory) {
            $pathBuilderFactory = new PathBuilderFactory();
        }

        $this->nodeBuilderFactory = $nodeBuilderFactory;
        $this->pathBuilderFactory = $pathBuilderFactory;
    }

    /**
     * Returns the node builder factory.
     *
     * @return NodeBuilderFactoryInterface The node builder factory.
     */
    public function getNodeBuilderFactory()
    {
        return $this->nodeBuilderFactory;
    }

    /**
     * Returns the node path builder factory.
     *
     * @return PathBuilderFactoryInterface The node path builder factory.
     */
    public function getPathBuilderFactory()
    {
        return $this->pathBuilderFactory;
    }
}
