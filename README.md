# php-go-minifier
CSS/JS minifier through PHP FFI on Go/C&nbsp;
Based on [github.com/tdewolff/minify](https://github.com/tdewolff/minify)
## Install
composer require futuralight/compiled-minifier
## Build
go build -o minifier.so -buildmode=c-shared main.go
## Usage
```php
use CompliedMinifier\Minifier;


$minifier = new Minifier();
$css = $minifier->minifyCSS($content);
$js = $minifier->minifyJS($content);
```