package main

import (
	"C"
	"bytes"
	"regexp"
	"strings"

	"github.com/tdewolff/minify"
	"github.com/tdewolff/minify/css"
	"github.com/tdewolff/minify/js"
)

//jsRegex - js regex string
const jsRegex = "\\/\\*[\\s\\S]*?\\*\\/*$"

const errorValue = "ERRORVALUE:0"

//export MinifyJS
func MinifyJS(jsStringC *C.char) *C.char { //\/\*[\s\S]*?\*\/*$
	jsString := C.GoString(jsStringC)
	m := minify.New()
	m.AddFunc("application/javascript", js.Minify)
	m.AddFuncRegexp(regexp.MustCompile(jsRegex), js.Minify)
	var buf bytes.Buffer
	err := m.Minify("application/javascript", &buf, strings.NewReader(jsString))
	if err != nil {
		return C.CString(errorValue)
	}
	return C.CString(buf.String())
}

//export MinifyCSS
func MinifyCSS(cssStringC *C.char) *C.char {
	cssString := C.GoString(cssStringC)
	m := minify.New()
	m.AddFunc("text/css", css.Minify)
	var buf bytes.Buffer
	cssReader := strings.NewReader(cssString)
	err := m.Minify("text/css", &buf, cssReader)
	if err != nil {
		return C.CString(errorValue)
	}
	return C.CString(buf.String())
}

func main() {
}
