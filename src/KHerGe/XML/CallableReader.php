<?php

namespace KHerGe\XML;

use KHerGe\XML\Exception\Reader\InvalidCallableResultException;
use KHerGe\XML\Node\NodeBuilderFactoryInterface;
use KHerGe\XML\Node\PathBuilderFactoryInterface;
use XMLReader;

/**
 * Reads an XML document returned by a callable.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class CallableReader extends AbstractReader
{
    /**
     * The XML document factory callable.
     *
     * @var callable
     */
    private $callable;

    /**
     * Initializes the new callable XML document reader.
     *
     * @param callable                    $callable           The XML document reader factory.
     * @param PathBuilderFactoryInterface $pathBuilderFactory The node path builder factory.
     * @param NodeBuilderFactoryInterface $nodeBuilderFactory The node builder factory.
     */
    public function __construct(
        callable $callable,
        PathBuilderFactoryInterface $pathBuilderFactory,
        NodeBuilderFactoryInterface $nodeBuilderFactory
    ) {
        parent::__construct($pathBuilderFactory, $nodeBuilderFactory);

        $this->callable = $callable;
    }

    /**
     * {@inheritdoc}
     */
    protected function reset()
    {
        $reader = call_user_func($this->callable);

        if (!($reader instanceof XMLReader)) {
            throw new InvalidCallableResultException(
                'The XML document factory callable returned "%s", expected "%s".',
                is_object($reader) ? get_class($reader) : gettype($reader),
                XMLReader::class
            );
        }

        $this->setReader($reader);
    }
}
