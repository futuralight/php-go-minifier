<?php

namespace CompliedMinifier;

class Minifier
{
    protected $ffi;

    function __construct()
    {
        $this->ffi = \FFI::cdef(
            "
            char* MinifyJS(char* p0);
            char* MinifyCSS(char* p0);",
            __DIR__ . "/bin/minifier.so"
        );
    }
    
    public function minifyCSS($content)
    {
        $minified_css = $this->ffi->MinifyCSS($content);
        return \FFI::string($minified_css);
    }

    public function minifyJS($content)
    {
        $minified_js = $this->ffi->MinifyJS($content);
        return \FFI::string($minified_js);
    }
}
