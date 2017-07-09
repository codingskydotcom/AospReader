window.onerror = function(){
}
function getElementEx(name){
	return document.getElementById(name);
}

function addToOnloadFuncEx(func) {
	var oldonload = window.onload; 
	if (typeof window.onload != 'function') { 
		window.onload = func; 
	} else { 
		window.onload = function() { 
			oldonload(); 
			func(); 
		}
	}
}

function getXmlHttpRequest(){
    var xmlHttpRequest = null;
    if(window.ActiveXObject){
        xmlHttpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    } else if(window.XMLHttpRequest){
        xmlHttpRequest = new XMLHttpRequest();
    }
    return xmlHttpRequest;
}

function request(url,callback){
    var xmlHttpRequest = getXmlHttpRequest();
    if(null != xmlHttpRequest){
        xmlHttpRequest.open("GET", url, true);
        xmlHttpRequest.onreadystatechange = ajaxCallback;
        xmlHttpRequest.send(null);
    }
 
    function ajaxCallback(){
        if(xmlHttpRequest.readyState == 4) {
            if(xmlHttpRequest.status == 200){
                if(callback != null){
                    var responseText = xmlHttpRequest.responseText;
                    callback(responseText);
                }
            }
        }
    }
}

function getUrlAddress(){
	var currentPageUrl = "";
	if(typeof this.href === "undefined"){
		currentPageUrl = document.location.toString().toLowerCase();
	}else{
		currentPageUrl = this.href.toString().toLowerCase();
	}
	return currentPageUrl;
}

function getBrowserType(){
	if(navigator.userAgent.indexOf("MSIE")>0) {
		//msie : 1
		return 1; 
	} 
	return 0;
}

//获取QueryString的数组
function getQueryString(){
     var result = location.search.match(new RegExp("[\?\&][^\?\&]+=[^\?\&]+","g")); 
     if(result == null){
         return "";
     }
     for(var i = 0; i < result.length; i++){
         result[i] = result[i].substring(1);
     }
     return result;
}

//根据QueryString参数名称获取值
function getQueryStringByName(name){
     var result = location.search.match(new RegExp("[\?\&]" + name+ "=([^\&]+)","i"));
     if(result == null || result.length < 1){
         return "";
     }
     return result[1];
}

//根据QueryString参数索引获取值
function getQueryStringByIndex(index){
     if(index == null){
         return "";
     }
     var queryStringList = getQueryString();
     if (index >= queryStringList.length){
         return "";
     }
	 
     var result = queryStringList[index];
     var startIndex = result.indexOf("=") + 1;
     result = result.substring(startIndex);
     return result;
}
