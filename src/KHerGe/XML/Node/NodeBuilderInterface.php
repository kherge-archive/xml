<?php

namespace KHerGe\XML\Node;

use KHerGe\XML\Exception\Node\Builder\MissingDepthException;
use KHerGe\XML\Exception\Node\Builder\MissingLocalNameException;
use KHerGe\XML\Exception\Node\Builder\MissingPrefixException;
use KHerGe\XML\Exception\Node\Builder\MissingTypeException;
use KHerGe\XML\Exception\Node\Builder\MissingURIException;

/**
 * Defines the public interface for a node builder.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface NodeBuilderInterface
{
    /**
     * Builds a new node using the builder parameters.
     *
     * ```php
     * $node = $builder->build();
     * ```
     *
     * @return NodeInterface The new node.
     *
     * @throws MissingDepthException     If the depth is not set.
     * @throws MissingLocalNameException If the local name is not set.
     * @throws MissingPrefixException    If the namespace prefix is not set.
     * @throws MissingTypeException      If the type of the node is not set.
     * @throws MissingURIException       If the namespace URI is not set.
     */
    public function build();

    /**
     * Sets the value of an attribute for the node.
     *
     * ```php
     * $builder->setAttribute($name, $value);
     * ```
     *
     * @param string $name  The name of the attribute.
     * @param string $value The value of the attribute.
     *
     * @return NodeBuilderInterface The node builder.
     */
    public function setAttribute($name, $value);

    /**
     * Sets the attributes for the node.
     *
     * ```php
     * $builder->setAttributes($attributes);
     * ```
     *
     * @param string[] The attributes.
     *
     * @return NodeBuilderInterface The node builder.
     */
    public function setAttributes(array $attributes);

    /**
     * Sets the depth of the node.
     *
     * ```php
     * $builder->setDepth($depth);
     * ```
     *
     * @param integer $depth The depth of the node.
     *
     * @return NodeBuilderInterface The node builder.
     */
    public function setDepth($depth);

    /**
     * Sets the language of the node.
     *
     * ```php
     * $builder->setLanguage($language)
     * ```
     *
     * @param null|string $language The language of the node.
     *
     * @return NodeBuilderInterface The node builder.
     */
    public function setLanguage($language);

    /**
     * Sets the local name of the node.
     *
     * ```php
     * $builder->setName($name);
     * ```
     *
     * @param string $name The local name of the node.
     *
     * @return NodeBuilderInterface The node builder.
     */
    public function setLocalName($name);

    /**
     * Sets the namespace prefix of the node.
     *
     * ```php
     * $builder->setPrefix($prefix);
     * ```
     *
     * @param string $prefix The namespace prefix.
     *
     * @return NodeBuilderInterface The node builder.
     */
    public function setPrefix($prefix);

    /**
     * Sets the type of the node.
     *
     * ```php
     * $builder->setType($type);
     * ```
     *
     * @param integer $type The type of the node.
     *
     * @return NodeBuilderInterface The node builder.
     */
    public function setType($type);

    /**
     * Sets the namespace URI of the node.
     *
     * ```php
     * $builder->setURI($uri);
     * ```
     *
     * @param string $uri The namespace URI.
     *
     * @return NodeBuilderInterface The node builder.
     */
    public function setURI($uri);

    /**
     * Sets the value of the node.
     *
     * ```php
     * $builder->setValue($value);
     * ```
     *
     * @param null|string $value The value of the node.
     *
     * @return NodeBuilderInterface The node builder.
     */
    public function setValue($value);
}
