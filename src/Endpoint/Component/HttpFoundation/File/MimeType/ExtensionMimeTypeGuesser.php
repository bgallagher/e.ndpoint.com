<?php

namespace Endpoint\Component\HttpFoundation\File\MimeType;

use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeExtensionGuesser;

class ExtensionMimeTypeGuesser extends MimeTypeExtensionGuesser{

    protected $defaultMimeTypes;

    public function __construct()
    {
        $this->defaultMimeTypes = array_flip($this->defaultExtensions);
    }

    /**
     * @param string $extension
     * @return null|string
     */
    public function guess($extension)
    {
        return isset($this->defaultMimeTypes[$extension]) ? $this->defaultMimeTypes[$extension] : null;
    }

    /**
     * @return array
     */
    public function getMimeTypes()
    {
        return $this->defaultMimeTypes;
    }

}