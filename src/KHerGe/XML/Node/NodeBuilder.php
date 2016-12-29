<?php

namespace KHerGe\XML\Node;

use KHerGe\XML\Exception\Node\Builder\MissingDepthException;
use KHerGe\XML\Exception\Node\Builder\MissingLocalNameException;
use KHerGe\XML\Exception\Node\Builder\MissingPrefixException;
use KHerGe\XML\Exception\Node\Builder\MissingTypeException;
use KHerGe\XML\Exception\Node\Builder\MissingURIException;

/**
 * Builds a new node using a fluent interface.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class NodeBuilder implements NodeBuilderInterface
{
    /**
     * The attributes of the node.
     *
     * @var string[]
     */
    private $attributes = [];

    /**
     * The depth of the node.
     *
     * @var integer|null
     */
    private $depth;

    /**
     * The language of the node.
     *
     * @var null|string
     */
    private $language;

    /**
     * The local name of the node.
     *
     * @var null|string
     */
    private $localName;

    /**
     * The namespace prefix of the node.
     *
     * @var null|string
     */
    private $prefix;

    /**
     * The type of the node.
     *
     * @var integer|null
     */
    private $type;

    /**
     * The namespace URI of the node.
     *
     * @var null|string
     */
    private $uri;

    /**
     * The value of the node.
     *
     * @var null|string
     */
    private $value;

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        if (null === $this->depth) {
            throw new MissingDepthException('The depth of the node was not set.');
        }

        if (null === $this->localName) {
            throw new MissingLocalNameException(
                'The local name of the node was not set.'
            );
        }

        if ((null !== $this->uri) && (null === $this->prefix)) {
            throw new MissingPrefixException(
                'The namespace URI is set, but the prefix is not set for the node.'
            );
        }

        if (null === $this->type) {
            throw new MissingTypeException('The type of the node was not set.');
        }

        if ((null === $this->uri) && (null !== $this->prefix)) {
            throw new MissingURIException(
                'The namespace prefix is set, but the namespace URI is not set for the node.'
            );
        }

        return new Node(
            $this->type,
            $this->localName,
            $this->value,
            $this->depth,
            $this->language,
            $this->prefix,
            $this->uri,
            $this->attributes
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocalName($name)
    {
        $this->localName = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setURI($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
