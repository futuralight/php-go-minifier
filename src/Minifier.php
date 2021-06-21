<?php

declare(strict_types=1);

namespace CompliedMinifier;

use Exception;
use FFI;

class Minifier
{
    private const ERROR_VALUE = 'ERRORVALUE:0';

    private FFI $ffi;

    public function __construct()
    {
        $this->ffi = FFI::cdef(
            "char* MinifyJS(char* p0);
            char* MinifyCSS(char* p0);",
            __DIR__ . "/bin/minifier.so"
        );
    }

    public function minifyCSS(string $css): string
    {
        $minifiedCss = FFI::string($this->ffi->MinifyCSS($css));
        $this->throwExceptionOnError($minifiedCss);
        return $minifiedCss;
    }

    public function minifyJS(string $js): string
    {
        $minifiedJs = FFI::string($this->ffi->MinifyJS($js));
        $this->throwExceptionOnError($minifiedJs);
        return $minifiedJs;
    }

    private function throwExceptionOnError(string &$output): void
    {
        if ($output === self::ERROR_VALUE) {
            throw new Exception('Binary file error');
        }
    }
}
