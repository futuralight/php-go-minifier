# php-go-minifier
CSS/JS minifier through PHP FFI on Go/C
Based on tdewolff/minify [a link](https://github.com/tdewolff/minify)
## Build
go build -o minifier.so -buildmode=c-shared main.go