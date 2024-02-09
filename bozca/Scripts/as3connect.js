var jsReady = false;
 function isReady() {
     return jsReady;
 }
 function asInit() {
     jsReady = true;
     //document.forms["form1"].output.value += "\n" + "JavaScript is ready.\n";
 }
 function thisMovie(movieName) {
     if (navigator.appName.indexOf("Microsoft") != -1) {
         return window[movieName];
     } else {
         return document[movieName];
     }
 }
 function sendToActionScript(value) {
     thisMovie("flashContent").sendToActionScript(value);
 }
 function sendToJavaScript(value) {
     //document.forms["form1"].output.value += "ActionScript says: " + value + "\n";
 }
