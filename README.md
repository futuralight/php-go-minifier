# php-go-minifier
CSS/JS minifier through PHP FFI on Go/C&nbsp;
Based on [github.com/tdewolff/minify](https://github.com/tdewolff/minify)
## Build
go build -o minifier.so -buildmode=c-shared main.go