/** TICKER CONFIG PARAMETERS **/

var rvt_delayOnStart = 1000; // start delay in miliseconds
var rvt_tickerSpeed = 1; //
var rvt_pauseOnMouseOver = true;

/** TICKER CODE STARTS HERE **/

var rvt_copyspeed = rvt_tickerSpeed;
var rvt_pausespeed = (rvt_pauseOnMouseOver==0) ? rvt_copyspeed : 0;
var rvt_actualheight = '';

function scrollRVTicker() {
 if (parseInt(cross_rvticker.style.top) > (rvt_actualheight*(-1)+8)) {
  cross_rvticker.style.top=parseInt(cross_rvticker.style.top)-rvt_copyspeed+"px"
 } else {
  cross_rvticker.style.top=parseInt(rv_ticker_height)+8+"px"
 }
}

function initialize_rvTicker() {
 cross_rvticker=document.getElementById("rvtickerID")
 cross_rvticker.style.top=0
 rv_ticker_height = document.getElementById("rvtickerContent").offsetHeight
 rvt_actualheight=cross_rvticker.offsetHeight
 if (window.opera || navigator.userAgent.indexOf("Netscape/7")!=-1){ //if Opera or Netscape 7x, add scrollbars to scroll and exit
  cross_rvticker.style.height=rv_ticker_height+"px"
  cross_rvticker.style.overflow="scroll"
  return
 }
 setTimeout('lefttime=setInterval("scrollRVTicker()",40)', rvt_delayOnStart)
}

if (window.addEventListener) {
 window.addEventListener("load", initialize_rvTicker, false);
} else if (window.attachEvent) {
 window.attachEvent("onload", initialize_rvTicker);
} else if (document.getElementById) {
 window.onload = initialize_rvTicker;
}
