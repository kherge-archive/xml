<?php

namespace KHerGe\XML;

use KHerGe\XML\Exception\Reader\MissingInternalReaderException;
use KHerGe\XML\Node\NodeBuilderFactoryInterface;
use KHerGe\XML\Node\NodeInterface;
use KHerGe\XML\Node\PathBuilderFactoryInterface;
use KHerGe\XML\Node\PathBuilderInterface;
use XMLReader;

/**
 * Iterates through each node in an XML document.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
abstract class AbstractReader implements ReaderInterface
{
    /**
     * The node builder factory.
     *
     * @var NodeBuilderFactoryInterface
     */
    private $nodeBuilderFactory;

    /**
     * The node path builder.
     *
     * @var PathBuilderInterface
     */
    private $pathBuilder;

    /**
     * The node path builder factory.
     *
     * @var PathBuilderFactoryInterface
     */
    private $pathBuilderFactory;

    /**
     * The XML reader.
     *
     * @var XMLReader
     */
    private $reader;

    /**
     * The XML reader to node type map.
     *
     * @var integer[]
     */
    private static $typeMap = [
        XMLReader::ATTRIBUTE => NodeInterface::TYPE_ATTRIBUTE,
        XMLReader::CDATA => NodeInterface::TYPE_CDATA,
        XMLReader::COMMENT => NodeInterface::TYPE_COMMENT,
        XMLReader::DOC => NodeInterface::TYPE_DOCUMENT,
        XMLReader::DOC_FRAGMENT => NodeInterface::TYPE_DOCUMENT_FRAGMENT,
        XMLReader::DOC_TYPE => NodeInterface::TYPE_DOCUMENT_TYPE,
        XMLReader::ELEMENT => NodeInterface::TYPE_ELEMENT,
        XMLReader::END_ELEMENT => NodeInterface::TYPE_END_ELEMENT,
        XMLReader::END_ENTITY => NodeInterface::TYPE_END_ENTITY,
        XMLReader::ENTITY => NodeInterface::TYPE_ENTITY,
        XMLReader::ENTITY_REF => NodeInterface::TYPE_ENTITY_REFERENCE,
        XMLReader::WHITESPACE => NodeInterface::TYPE_INSIGNIFICANT_WHITESPACE,
        XMLReader::NOTATION => NodeInterface::TYPE_NOTATION,
        XMLReader::PI => NodeInterface::TYPE_PROCESSING_INSTRUCTION,
        XMLReader::SIGNIFICANT_WHITESPACE => NodeInterface::TYPE_SIGNIFICANT_WHITESPACE,
        XMLReader::TEXT => NodeInterface::TYPE_TEXT,
        XMLReader::XML_DECLARATION => NodeInterface::TYPE_XML_DECLARATION
    ];

    /**
     * Initializes the new XML document reader.
     *
     * @param PathBuilderFactoryInterface $pathBuilderFactory The node path builder factory.
     * @param NodeBuilderFactoryInterface $nodeBuilderFactory The node builder factory.
     */
    public function __construct(
        PathBuilderFactoryInterface $pathBuilderFactory,
        NodeBuilderFactoryInterface $nodeBuilderFactory
    ) {
        $this->nodeBuilderFactory = $nodeBuilderFactory;
        $this->pathBuilderFactory = $pathBuilderFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        $reader = $this->getReader();

        return $this
            ->nodeBuilderFactory
            ->createBuilder()
            ->setAttributes($this->readAttributes())
            ->setDepth($reader->depth)
            ->setLanguage($this->valueOrNull($reader->xmlLang))
            ->setLocalName($reader->localName)
            ->setPosition($this->pathBuilder->getPosition())
            ->setPrefix($this->valueOrNull($reader->prefix))
            ->setType($this->readType())
            ->setURI($this->valueOrNull($reader->namespaceURI))
            ->setValue($this->readValue())
            ->build()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->pathBuilder->getPath();
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $reader = $this->getReader();

        switch ($reader->nodeType) {
            case XMLReader::ELEMENT:
            /** @noinspection PhpMissingBreakStatementInspection */
            case XMLReader::ENTITY:
                if (!$reader->isEmptyElement) {
                    break;
                }

            default:
                $this->pathBuilder->pop();
        }

        if ($reader->read()) {
            switch ($reader->nodeType) {
                case XMLReader::END_ELEMENT:
                case XMLReader::END_ENTITY:
                    break;

                default:
                    $this->pathBuilder->push($reader->name);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->reset();

        $this->pathBuilder = $this->pathBuilderFactory->createBuilder();

        $this->next();
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return (XMLReader::NONE !== $this->getReader()->nodeType);
    }

    /**
     * Resets the reader to its initial state.
     *
     * This method is invoked when the iterator is rewound. You can restore
     * the initial state of the reader, but you are expected to set a new XML
     * reader for the XML document.
     *
     * @see AbstractReader::setReader()
     */
    abstract protected function reset();

    /**
     * Sets a new XML reader.
     *
     * This method expects a new XML reader whose cursor is at the beginning
     * of an XML document. You are expected to invoke this method every time
     * the iterator is rewound, supplying a new reader.
     *
     * ```php
     * $this->setReader($reader);
     * ```
     *
     * @param XMLReader $reader The new XML reader.
     */
    protected function setReader(XMLReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Returns the XML reader.
     *
     * @return XMLReader The XML reader.
     *
     * @throws MissingInternalReaderException If the reader is not set.
     */
    private function getReader()
    {
        if (null === $this->reader) {
            throw new MissingInternalReaderException(
                'The `XMLReader` instance has not been set.'
            );
        }

        return $this->reader;
    }

    /**
     * Reads the attributes for the current node.
     *
     * @return string[] The attributes.
     */
    private function readAttributes()
    {
        $attributes = [];

        if ($this->reader->hasAttributes) {
            if ($this->reader->moveToFirstAttribute()) {
                do {
                    $attributes[$this->reader->name] = $this->reader->value;
                } while ($this->reader->moveToNextAttribute());

                $this->reader->moveToElement();
            }
        }

        return $attributes;
    }

    /**
     * Reads the type of the current node.
     *
     * @return integer The type.
     */
    private function readType()
    {
        if ($this->reader->isEmptyElement
            && (XMLReader::ELEMENT === $this->reader->nodeType)) {
            return NodeInterface::TYPE_ELEMENT
                | NodeInterface::TYPE_END_ELEMENT;
        }

        return self::$typeMap[$this->reader->nodeType];
    }

    /**
     * Reads the value of the current node.
     *
     * @return null|string The value.
     */
    private function readValue()
    {
        if ('' === $this->reader->value) {
            return null;
        }

        return $this->reader->value;
    }

    /**
     * Returns the string value or `null` if it is empty.
     *
     * @param string $string The string value.
     *
     * @return null|string The string value or `null`.
     */
    private function valueOrNull($string)
    {
        return ('' === $string) ? null : $string;
    }
}
