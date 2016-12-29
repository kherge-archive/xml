<?php

namespace KHerGe\XML\Exception\Node\Builder;

use KHerGe\XML\Exception\Node\NodeBuilderException;

/**
 * An exception that is thrown if a namespace URI is set but the prefix is not.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class MissingPrefixException extends NodeBuilderException
{
}
