# php-go-minifier
CSS/JS minifier through PHP FFI and cgo<br/>
Based on [github.com/tdewolff/minify](https://github.com/tdewolff/minify)
## Install
```console
composer require futuralight/compiled-minifier
```
## Build
```console
cd src/go
make
```
## Usage
```php
use CompliedMinifier\Minifier;


$minifier = new Minifier();
$css = $minifier->minifyCSS($content);
$js = $minifier->minifyJS($content);
```