<?php

namespace KHerGe\XML;

/**
 * Creates new callable XML document readers.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class CallableReaderFactory extends AbstractReaderFactory
{
    /**
     * {@inheritdoc}
     */
    public function create($resource)
    {
        return new CallableReader(
            $resource,
            $this->getPathBuilderFactory(),
            $this->getNodeBuilderFactory()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supportsResource($resource, $type)
    {
        return is_callable($resource);
    }
}
