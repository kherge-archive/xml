<?php

namespace KHerGe\XML\Exception\Node\Builder;

use KHerGe\XML\Exception\Node\NodeBuilderException;

/**
 * An exception that is throw if the namespace prefix is set but not the URI.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class MissingURIException extends NodeBuilderException
{
}
