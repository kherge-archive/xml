<?php

namespace KHerGe\XML;

use KHerGe\XML\Node\NodeBuilderFactory;
use KHerGe\XML\Node\NodeBuilderFactoryInterface;
use KHerGe\XML\Node\PathBuilderFactory;
use KHerGe\XML\Node\PathBuilderFactoryInterface;

/**
 * Creates new XML file readers.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class FileReaderFactory
{
    /**
     * The node builder factory.
     *
     * @var NodeBuilderFactoryInterface
     */
    private $nodeBuilderFactory;

    /**
     * The node path builder factory.
     *
     * @var PathBuilderFactoryInterface
     */
    private $pathBuilderFactory;

    /**
     * Initializes the new XML file reader factory.
     *
     * @param null|PathBuilderFactoryInterface $pathBuilderFactory The node path builder factory.
     * @param NodeBuilderFactoryInterface|null $nodeBuilderFactory The node builder factory.
     */
    public function __construct(
        PathBuilderFactoryInterface $pathBuilderFactory = null,
        NodeBuilderFactoryInterface $nodeBuilderFactory = null
    ) {
        if (null === $nodeBuilderFactory) {
            $nodeBuilderFactory = new NodeBuilderFactory();
        }

        if (null === $pathBuilderFactory) {
            $pathBuilderFactory = new PathBuilderFactory();
        }

        $this->nodeBuilderFactory = $nodeBuilderFactory;
        $this->pathBuilderFactory = $pathBuilderFactory;
    }

    /**
     * Creates a new XML file reader and opens an existing file.
     *
     * @param string $file   The path to the XML file.
     * @param integer $flags The libxml flags.
     *
     * @return FileReader The new reader.
     */
    public function open($file, $flags = 0)
    {
        return new FileReader(
            $file,
            $flags,
            $this->pathBuilderFactory,
            $this->nodeBuilderFactory
        );
    }
}
