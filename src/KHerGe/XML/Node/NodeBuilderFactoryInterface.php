<?php

namespace KHerGe\XML\Node;

/**
 * Defines the public interface for the node builder factory.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface NodeBuilderFactoryInterface
{
    /**
     * Creates a new node builder.
     *
     * @return NodeBuilderInterface The new node builder.
     */
    public function createBuilder();
}
