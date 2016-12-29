<?php

namespace KHerGe\XML\Node;

/**
 * Creates new node builders.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class NodeBuilderFactory implements NodeBuilderFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createBuilder()
    {
        return new NodeBuilder();
    }
}
