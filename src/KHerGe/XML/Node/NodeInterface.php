<?php

namespace KHerGe\XML\Node;

use KHerGe\XML\Exception\Node\NoSuchAttributeException;

/**
 * Defines the public interface for an XML node.
 *
 * An instance of `NodeInterface` provides a complete representation of the
 * node as it is stored in the XML document. End users are expected to use
 * the public methods that are defined. The constants are reserved for other
 * library writers that intended on providing their own node representation
 * implementation.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface NodeInterface
{
    /**
     * The node is an attribute.
     *
     * @var integer
     */
    const TYPE_ATTRIBUTE = 1;

    /**
     * The node is CDATA.
     *
     * @var integer
     */
    const TYPE_CDATA = 2;

    /**
     * The node is a comment.
     *
     * @var integer
     */
    const TYPE_COMMENT = 3;

    /**
     * The node is the document node.
     *
     * @var integer
     */
    const TYPE_DOCUMENT = 4;

    /**
     * The node is a document fragment.
     *
     * @var integer
     */
    const TYPE_DOCUMENT_FRAGMENT = 5;

    /**
     * The node is a document type.
     *
     * @var integer
     */
    const TYPE_DOCUMENT_TYPE = 6;

    /**
     * The node is the end element.
     *
     * @var integer
     */
    const TYPE_END_ELEMENT = 7;

    /**
     * The node is the end entity.
     *
     * @var integer
     */
    const TYPE_END_ENTITY = 8;

    /**
     * The node is an element.
     *
     * @var integer
     */
    const TYPE_ELEMENT = 9;

    /**
     * The node is an entity.
     *
     * @var integer
     */
    const TYPE_ENTITY = 10;

    /**
     * The node is an entity reference.
     *
     * @var integer
     */
    const TYPE_ENTITY_REFERENCE = 11;

    /**
     * The node is insignificant whitespace.
     *
     * @var integer
     */
    const TYPE_INSIGNIFICANT_WHITESPACE = 12;

    /**
     * The node is a notation.
     *
     * @var integer
     */
    const TYPE_NOTATION = 13;

    /**
     * The node is a processing instruction.
     *
     * @var integer
     */
    const TYPE_PROCESSING_INSTRUCTION = 14;

    /**
     * The node is significant whitespace.
     *
     * @var integer
     */
    const TYPE_SIGNIFICANT_WHITESPACE = 15;

    /**
     * The node is text.
     *
     * @var integer
     */
    const TYPE_TEXT = 16;

    /**
     * The node is an XML declaration.
     *
     * @var integer
     */
    const TYPE_XML_DECLARATION = 17;

    /**
     * Returns the value of an attribute for the node.
     *
     * ```php
     * $value = $node->getAttribute('example');
     * ```
     *
     * @param string $name The name of the attribute.
     *
     * @return string The value of the attribute.
     *
     * @throws NoSuchAttributeException If the attribute does not exist.
     */
    public function getAttribute($name);

    /**
     * Returns all of the attributes for the node.
     *
     * ```php
     * $attributes = $node->getAttributes();
     * ```
     *
     * @return string[] The attributes.
     */
    public function getAttributes();

    /**
     * Returns the depth of the node in the tree.
     *
     * ```php
     * $depth = $node->getDepth();
     * ```
     *
     * @return integer The depth.
     */
    public function getDepth();

    /**
     * Returns the language used for the node.
     *
     * ```php
     * $language = $node->getLanguage();
     * ```
     *
     * @return null|string The language.
     */
    public function getLanguage();

    /**
     * Returns the local name of the node.
     *
     * ```php
     * $name = $node->getLocalName();
     * ```
     *
     * @return string The local name.
     */
    public function getLocalName();

    /**
     * Returns the prefix for the namespace.
     *
     * ```php
     * $prefix = $node->getPrefix();
     * ```
     *
     * @return null|string The namespace prefix.
     */
    public function getPrefix();

    /**
     * Returns the qualified name of the node.
     *
     * ```php
     * $name = $node->getQualifiedName();
     * ```
     *
     * @return string The qualified name.
     */
    public function getQualifiedName();

    /**
     * Returns the URI for the namespace.
     *
     * @return null|string The namespace URI.
     */
    public function getURI();

    /**
     * Returns the value of the node.
     *
     * ```php
     * $value = $node->getValue();
     * ```
     *
     * @return null|string The value.
     */
    public function getValue();

    /**
     * Checks if this node is an attribute.
     *
     * ```php
     * if ($this->isAttribute()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is an attribute, `false` if not.
     */
    public function isAttribute();

    /**
     * Checks if this node is CDATA.
     *
     * ```php
     * if ($this->isCDATA()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is CDATA, `false` if not.
     */
    public function isCDATA();

    /**
     * Checks if this node is a comment.
     *
     * ```php
     * if ($this->isComment()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is a comment, `false` if not.
     */
    public function isComment();

    /**
     * Checks if this node is the document node.
     *
     * ```php
     * if ($this->isDocument()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is a document node, `false` if not.
     */
    public function isDocument();

    /**
     * Checks if this node is a document fragment.
     *
     * ```php
     * if ($this->isDocumentFragment()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is a document fragment, `false` if not.
     */
    public function isDocumentFragment();

    /**
     * Checks if this node is a document type.
     *
     * ```php
     * if ($this->isDocumentType()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is a document type, `false` if not.
     */
    public function isDocumentType();

    /**
     * Checks if this node is an element.
     *
     * ```php
     * if ($this->isElement()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is an element, `false` if not.
     */
    public function isElement();

    /**
     * Checks if this node is the end of an element.
     *
     * ```php
     * if ($this->isEnd()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is the end, `false` if not.
     */
    public function isEnd();

    /**
     * Checks if this node is an entity.
     *
     * ```php
     * if ($this->isEntity()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is an entity, `false` if not.
     */
    public function isEntity();

    /**
     * Checks if this node is an entity reference.
     *
     * ```php
     * if ($this->isEntityReference()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is an entity reference, `false` if not.
     */
    public function isEntityReference();

    /**
     * Checks if this node is insignificant whitespace.
     *
     * ```php
     * if ($this->isInsignificantWhitespace()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is whitespace, `false` if not.
     */
    public function isInsignificantWhitespace();

    /**
     * Checks if this node is a notation.
     *
     * ```php
     * if ($this->isNotation()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is a notation, `false` if not.
     */
    public function isNotation();

    /**
     * Checks if this node is a processing instruction.
     *
     * ```php
     * if ($this->isProcessingInstruction()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is a processing instruction, `false` if not.
     */
    public function isProcessingInstruction();

    /**
     * Checks if this node is significant whitespace.
     *
     * ```php
     * if ($this->isSignificantWhitespace()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is significant whitespace, `false` if not.
     */
    public function isSignificantWhitespace();

    /**
     * Checks if this node is the start of an element.
     *
     * ```php
     * if ($this->isStart()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is the start, `false` if not.
     */
    public function isStart();

    /**
     * Checks if this node is text.
     *
     * ```php
     * if ($this->isText()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is text, `false` if not.
     */
    public function isText();

    /**
     * Checks if this node is an XML declaration.
     *
     * ```php
     * if ($this->isXMLDeclaration()) {
     *     // ...
     * }
     * ```
     *
     * @return boolean Returns `true` if it is an XML declaration, `false` if not.
     */
    public function isXMLDeclaration();
}
