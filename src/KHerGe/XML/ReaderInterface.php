<?php

namespace KHerGe\XML;

use Iterator;
use KHerGe\XML\Node\NodeInterface;

/**
 * Defines the public interface for an XML document reader.
 *
 * The XML document reader will iterate through each node in the document.
 * For each iteration, the key is the path to the element and value is the
 * representation of a node (i.e. `NodeInterface`).
 *
 * ```php
 * foreach ($reader as $path => $element) {
 *     if ('/example/element[2]/path' === $path) {
 *         echo $element->getValue();
 *     }
 * }
 * ```
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface ReaderInterface extends Iterator
{
    /**
     * Returns the current node.
     *
     * ```php
     * $node = $iterator->current();
     * ```
     *
     * @return NodeInterface The current node.
     */
    public function current();

    /**
     * Returns the path to the current element.
     *
     * ```php
     * $path = $iterator->key();
     * ```
     *
     * @return string The current element path.
     */
    public function key();

    /**
     * Reads the next node in the XML document.
     *
     * ```php
     * $iterator->next();
     * ```
     */
    public function next();

    /**
     * Rewinds the reader to the beginning of the XML document.
     *
     * ```php
     * $iterator->rewind();
     * ```
     */
    public function rewind();

    /**
     * Checks if the next node was successfully read.
     *
     * ```php
     * if ($iterator->valid()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if successful, `false` if not.
     */
    public function valid();
}
