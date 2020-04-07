
<?php

$util = FFI::cdef(
    "
    char* MinifyJS(char* p0);",
    __DIR__ . "/bin/minifier.so"
);

$s = 'export function priceFormat(price, penny_check) {
    if (!price)return price;
    if (Number(price))
    {
        price= price.toString();
    }
    var price_penny = 0;
    price = price.replace(/\,/, ".");
    price = price.replace(/\s/, "");
    var price_parts = price.split("."); //huysosi
    if (price_parts[1]) {
        price = price_parts[0];
        price_penny = price_parts[1];
    }
    var characters = price.split("");
    var getted = 0;
    var resultPrice = [];
    for (var r = characters.length; r--; r >= 0) {
        resultPrice[resultPrice.length] = characters[r];
        getted++;
        if (getted % 3 == 0) resultPrice[resultPrice.length] = " ";
    }
    resultPrice.reverse();
    var almoustReady = resultPrice.join("");
    if (penny_check)
        if (price_penny) almoustReady += "," + price_penny;

    return almoustReady;
}
';
 echo( FFI::string($util->MinifyJS($s))); 
