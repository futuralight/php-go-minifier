<?php

namespace CompliedMinifier;

use FFI;

class Minifier
{
    protected $ffi;

    function __construct()
    {
        $this->ffi = FFI::cdef(
            "
            char* MinifyJS(char* p0);
            char* MinifyCSS(char* p0);",
            __DIR__ . "/bin/minifier.so"
        );
    }

    public function minifyCSS($css)
    {
        return FFI::string($this->ffi->MinifyCSS($css));
    }

    public function minifyJS($js)
    {
        return FFI::string($this->ffi->MinifyJS($js));
    }
}
