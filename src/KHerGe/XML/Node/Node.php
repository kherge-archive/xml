<?php

namespace KHerGe\XML\Node;

use KHerGe\XML\Exception\Node\NoSuchAttributeException;

/**
 * Represents an individual node from an XML document.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class Node implements NodeInterface
{
    /**
     * The attributes for the node.
     *
     * @var string[]
     */
    private $attributes;

    /**
     * The depth of the node.
     *
     * @var integer
     */
    private $depth;

    /**
     * The language of the node.
     *
     * @var null|string
     */
    private $language;

    /**
     * The name of the node.
     *
     * @var string
     */
    private $localName;

    /**
     * The namespace prefix.
     *
     * @var string
     */
    private $prefix;

    /**
     * The type of the node.
     *
     * @var integer
     */
    private $type;

    /**
     * The namespace URI.
     *
     * @var string
     */
    private $uri;

    /**
     * The value of the node.
     *
     * @var null|string
     */
    private $value;

    /**
     * Initializes the new node.
     *
     * @param integer     $type       The type of the node.
     * @param string      $name       The local name of the node.
     * @param null|string $value      The value of the node.
     * @param integer     $depth      The depth of the node.
     * @param null|string $language   The language of the node.
     * @param null|string $prefix     The namespace prefix.
     * @param null|string $uri        The namespace URI.
     * @param string[]    $attributes The attributes of the node.
     */
    public function __construct(
        $type,
        $name,
        $value,
        $depth,
        $language,
        $prefix,
        $uri,
        array $attributes
    ) {
        $this->attributes = $attributes;
        $this->depth = $depth;
        $this->language = $language;
        $this->localName = $name;
        $this->prefix = $prefix;
        $this->type = $type;
        $this->uri = $uri;
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttribute($name)
    {
        if (!array_key_exists($name, $this->attributes)) {
            throw new NoSuchAttributeException(
                'The attribute "%s" does not exist.',
                $name
            );
        }

        return $this->attributes[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocalName()
    {
        return $this->localName;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function getQualifiedName()
    {
        if (null === $this->prefix) {
            return $this->localName;
        }

        return $this->prefix . ':' . $this->localName;
    }

    /**
     * {@inheritdoc}
     */
    public function getURI()
    {
        return $this->uri;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function isAttribute()
    {
        return (self::TYPE_ATTRIBUTE === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isCDATA()
    {
        return (self::TYPE_CDATA === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isComment()
    {
        return (self::TYPE_COMMENT === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isDocument()
    {
        return (self::TYPE_DOCUMENT === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isDocumentFragment()
    {
        return (self::TYPE_DOCUMENT_FRAGMENT === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isDocumentType()
    {
        return (self::TYPE_DOCUMENT_TYPE === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isElement()
    {
        return (self::TYPE_END_ELEMENT === $this->type)
            || (self::TYPE_ELEMENT === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isEnd()
    {
        return (self::TYPE_END_ELEMENT === $this->type)
            || (self::TYPE_END_ENTITY === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isEntity()
    {
        return (self::TYPE_END_ENTITY === $this->type)
            || (self::TYPE_ENTITY === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isEntityReference()
    {
        return (self::TYPE_ENTITY_REFERENCE === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isInsignificantWhitespace()
    {
        return (self::TYPE_INSIGNIFICANT_WHITESPACE === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isNotation()
    {
        return (self::TYPE_NOTATION === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isProcessingInstruction()
    {
        return (self::TYPE_PROCESSING_INSTRUCTION === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isSignificantWhitespace()
    {
        return (self::TYPE_SIGNIFICANT_WHITESPACE === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isStart()
    {
        return (self::TYPE_ELEMENT === $this->type)
            || (self::TYPE_ENTITY === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isText()
    {
        return (self::TYPE_TEXT === $this->type);
    }

    /**
     * {@inheritdoc}
     */
    public function isXMLDeclaration()
    {
        return (self::TYPE_XML_DECLARATION === $this->type);
    }
}
