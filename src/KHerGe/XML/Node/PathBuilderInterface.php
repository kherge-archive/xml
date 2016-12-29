<?php

namespace KHerGe\XML\Node;

/**
 * Defines the public interface for an node path builder.
 *
 * The path builder is responsible for creating a valid XPath to a specific
 * node in an XML document. Information is managed by the path as a sort of
 * stack, where the name of each node is pushed and popped from the stack.
 * The path builder will track depth of the node as well as its position
 * relative to its siblings using only this mechanism.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface PathBuilderInterface
{
    /**
     * Returns the path to the current node.
     *
     * ```php
     * $path = $builder->getPath();
     * ```
     *
     * @return string The path to the current node.
     */
    public function getPath();

    /**
     * Pushes the name of the current node to the stack.
     *
     * ```php
     * $builder->push($name);
     * ```
     *
     * @param string $name The name of the node.
     */
    public function push($name);

    /**
     * Pops the name of the current node off the stack.
     *
     * ```php
     * $builder->pop();
     * ```
     */
    public function pop();
}
