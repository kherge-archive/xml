<?php

namespace KHerGe\XML\Node;

/**
 * Defines the public interface for a node path builder factory.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface PathBuilderFactoryInterface
{
    /**
     * Creates a new node path builder.
     *
     * @return PathBuilderInterface The new node path builder.
     */
    public function createBuilder();
}
