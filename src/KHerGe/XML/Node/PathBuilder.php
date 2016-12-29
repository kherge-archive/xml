<?php

namespace KHerGe\XML\Node;

/**
 * Builds a path to a node in an XML document.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class PathBuilder implements PathBuilderInterface
{
    /**
     * The current depth of the tree.
     *
     * @var integer
     */
    private $depth = -1;

    /**
     * The stack of names in the path.
     *
     * @var string[]
     */
    private $names = [];

    /**
     * The stack of sibling positions in the path.
     *
     * @var integer[][]
     */
    private $positions = [];

    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        $path = '';

        foreach ($this->names as $depth => $name) {
            $path .= '/' . $name;

            if ($this->positions[$depth][$name] > 1) {
                $path .= '[' . $this->positions[$depth][$name] . ']';
            }
        }

        return ('' === $path) ? '/' : $path;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        if (-1 === $this->depth) {
            return null;
        }

        return $this->positions[$this->depth][end($this->names)];
    }

    /**
     * {@inheritdoc}
     */
    public function push($name)
    {
        $this->depth++;

        $this->addChild($name);

        $this->names[] = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function pop()
    {
        if (-1 !== $this->depth) {
            $this->dropChildren();

            $this->depth--;

            array_pop($this->names);
        }
    }

    /**
     * Tracks the position of the new child.
     *
     * @param string $name The name of the child.
     */
    private function addChild($name)
    {
        if (!isset($this->positions[$this->depth])) {
            $this->positions[$this->depth] = [];
        }

        if (!isset($this->positions[$this->depth][$name])) {
            $this->positions[$this->depth][$name] = 0;
        }

        $this->positions[$this->depth][$name]++;
    }

    /**
     * Removes any tracked positions for children nodes.
     */
    private function dropChildren()
    {
        if (isset($this->positions[$this->depth])) {
            $this->positions = array_slice(
                $this->positions,
                0,
                $this->depth + 1
            );
        }
    }
}
