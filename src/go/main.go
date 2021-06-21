package main

import (
	"C"
	"bytes"
	"strings"

	"github.com/tdewolff/minify"
	"github.com/tdewolff/minify/css"
	"github.com/tdewolff/minify/js"
)
import "regexp"

//export MinifyJS
func MinifyJS(jsStringC *C.char) *C.char { //\/\*[\s\S]*?\*\/*$
	jsString := C.GoString(jsStringC)
	m := minify.New()
	m.AddFunc("application/javascript", js.Minify)
	m.AddFuncRegexp(regexp.MustCompile("\\/\\*[\\s\\S]*?\\*\\/*$"), js.Minify)
	var buf bytes.Buffer
	jsReader := strings.NewReader(jsString)
	if err := m.Minify("application/javascript", &buf, jsReader); err != nil {
		panic(err)
	}
	s := buf.String()
	return C.CString(s)
}

//export MinifyCSS
func MinifyCSS(cssStringC *C.char) *C.char {
	cssString := C.GoString(cssStringC)
	m := minify.New()
	m.AddFunc("text/css", css.Minify)
	var buf bytes.Buffer
	cssReader := strings.NewReader(cssString)
	if err := m.Minify("text/css", &buf, cssReader); err != nil {
		panic(err)
	}
	s := buf.String()
	return C.CString(s)
}

func main() {
}
