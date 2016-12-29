<?php

namespace KHerGe\XML\Node;

/**
 * Creates new node path builders.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class PathBuilderFactory implements PathBuilderFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createBuilder()
    {
        return new PathBuilder();
    }
}
