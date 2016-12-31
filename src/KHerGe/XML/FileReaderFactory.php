<?php

namespace KHerGe\XML;

/**
 * Creates new XML file readers.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class FileReaderFactory extends AbstractReaderFactory
{
    /**
     * The type of the resource.
     *
     * @var string
     */
    const RESOURCE_TYPE = 'file';

    /**
     * The default libxml flags.
     *
     * @var integer
     */
    private $defaultFlags = 0;

    /**
     * {@inheritdoc}
     */
    public function create($resource)
    {
        return $this->open($resource, $this->defaultFlags);
    }

    /**
     * Returns the default libxml flags.
     *
     * @return integer $flags The libxml flags
     */
    public function getDefaultFlags()
    {
        return $this->defaultFlags;
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
            $this->getPathBuilderFactory(),
            $this->getNodeBuilderFactory()
        );
    }

    /**
     * Sets the default libxml flags.
     *
     * @param integer $flags The libxml flags.
     */
    public function setDefaultFlags($flags)
    {
        $this->defaultFlags = $flags;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsResource($resource, $type)
    {
        return (self::RESOURCE_TYPE === $type);
    }
}
