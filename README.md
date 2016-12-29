XML
===

- [Usage](#usage)
- [Documentation](#documentation)
- [Requirements](#requirements)
- [Installation](#installation)
- [Performance](#performance)
- [License](#license)

Provides a developer friendly way of accessing nodes in very large XML
documents.

Usage
-----

```php
<?php

use KHerGe\XML\FileReaderFactory;

// Open an existing and very large XML file.
$reader = (new FileReaderFactory())->open('/path/to/large.xml');

// Iterate through each node in the XML document.
foreach ($reader as $path => $node) {
    if ($node->isElement()) {
        echo $path, ' = ', $node->getValue(), "\n";
    }
}
```

Documentation
-------------

- [FileReaderFactory](src/KHerGe/XML/FileReaderFactory.php) - responsible for
  creating new instances of [FileReader](src/KHerGe/XML/FileReader.php). This
  is the primary way of opening an XML file for reading. The **Usage** example
  is essentially what you need.
- [NodeInterface](src/KHerGe/XML/Node/NodeInterface.php) - represents a node
  that was read from the XML document. You will be mostly interested in the
  methods and not the constants defined in the interface. Those constants are
  mainly for using an alternative implementation of the standard node
  representation class.

Requirements
------------

- PHP 5.6+
    - libxml
    - xmlreader

Installation
------------

    composer require kherge/xml

Performance
-----------

Let's take the following example.

**XMLReader**

```php
<?php

$reader = new XMLReader();
$reader->open('/path/to/large.xml');

while ($reader->read());
```

**XML**

```php
<?php

use KHerGe\XML\FileReaderFactory;

$reader = (new FileReaderFactory())->open('/path/to/large.xml');

foreach ($reader as $element);
```

This library will perform roughly 25x slower than `XMLReader` if we simply
stream through all of the elements without performing any work. There are a
few important reasons why this is the case.

1. The path to each node is tracked.
2. The way data abstraction is handled.
3. The attributes are read for nodes that have them.

While 25x slower sounds a lot, you need to ask yourself how much of this
library you would need to re-implement yourself anyway if you used XMLReader
directly. The appeal of this library would be in how easy it can be to use
it. In addition, the library is also designed so that various implementation
details (e.g. the node representation class) can be replaced with your own
implementation.

You will need to perform your own benchmarks, but you may end up breaking even
if you use this library. However, if you do find any room for optimizations,
please open a ticket, or better yet, submit a pull request!

License
-------

This library is available under the MIT and Apache 2.0 licenses.
