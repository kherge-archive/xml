<?php

namespace KHerGe\XML;

use KHerGe\XML\Exception\Reader\CouldNotOpenException;
use KHerGe\XML\Node\NodeBuilderFactoryInterface;
use KHerGe\XML\Node\PathBuilderFactoryInterface;
use XMLReader;

/**
 * Reads an XML document from a file.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class FileReader extends AbstractReader
{
    /**
     * The path to the XML file.
     *
     * @var string
     */
    private $file;

    /**
     * The libxml flags.
     *
     * @var integer
     */
    private $flags;

    /**
     * Initializes the new XML file reader.
     *
     * @param string                      $file               The path to the file.
     * @param integer                     $flags              The libxml flags.
     * @param PathBuilderFactoryInterface $pathBuilderFactory The node path builder factory.
     * @param NodeBuilderFactoryInterface $nodeBuilderFactory The node builder factory.
     */
    public function __construct(
        $file,
        $flags = 0,
        PathBuilderFactoryInterface $pathBuilderFactory,
        NodeBuilderFactoryInterface $nodeBuilderFactory
    ) {
        parent::__construct($pathBuilderFactory, $nodeBuilderFactory);

        $this->file = $file;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $reader = new XMLReader();

        if (true !== ($code = $reader->open($this->file, null, $this->flags))) {
            throw new CouldNotOpenException(
                'The XML file "%s" could not be opened (code: %d).',
                $this->file,
                $code
            );
        }

        $this->setReader($reader);
    }
}
