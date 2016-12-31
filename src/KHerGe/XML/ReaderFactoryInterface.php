<?php

namespace KHerGe\XML;

/**
 * Defines the public interface for an XML document reader factory.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface ReaderFactoryInterface
{
    /**
     * Creates a new XML document reader.
     *
     * ```php
     * $reader = $factory->create($resource);
     * ```
     *
     * @param mixed $resource The XML document resource.
     *
     * @return ReaderInterface The new XML document reader.
     */
    public function create($resource);

    /**
     * Checks if the XML document reader factory supports a resource.
     *
     * This method will use both/either resource and resource type to determine
     * if the XML document reader factory supports the resource. By returning
     * `true`, the factory indicates that a new XML document reader can be
     * created using the resource as is.
     *
     * ```php
     * if ($factory->supportsResource($resource, $type)) {
     *     // ...
     * }
     * ```
     *
     * @param mixed  $resource The resource.
     * @param string $type     The type of the resource.
     *
     * @return boolean Returns `true` if it does, `false` if not.
     */
    public function supportsResource($resource, $type);
}
