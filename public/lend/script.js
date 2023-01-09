function getSearchParameters() {
    var prmstr = window.location.search.substr(1);
    return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray( prmstr ) {
    var params = {};
    var prmarr = prmstr.split("&");
    for ( var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}

var params = getSearchParameters();
var subid = '';
if (params.sub1 !== undefined) {
 subid = '?sub1='+params.sub1;
}



// const obj = JSON.parse(params);
// console.log(obj); 

// console.log(params.sub1);

setTimeout(function() { window.location = "http://focs.emsot.com/vitrina"+subid }, 2000);