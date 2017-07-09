var imgLoaderFunc = function(){};
function addToOnloadFunc(func) {
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


function addToOnScroll(func) {
	var oldonscroll = window.onscroll; 
	if (typeof window.oldonscroll != 'function') { 
		window.onscroll = func; 
	} else { 
		window.onscroll = function() { 
			oldonscroll(); 
			func(); 
		}
	}
}
		
function Is3G() 
{ 
	var userAgentInfo = navigator.userAgent; 
	var Agents = new Array("Android", "iPhone", "Windows Phone", "iPad", "iPod"); 
	var flag = false; 
	for (var v = 0; v < Agents.length; v++) 
	{ 
		if (userAgentInfo.indexOf(Agents[v]) > 0) 
		{
			flag = true; 
			break; 
		} 
	} 
	return flag; 
}

if(YS === undefined){
	var YS = {};
(function(Y){
	/**
	 * 对象复制和替换 MIN version 如果对应的s里的值为0, null, undefined也会覆盖
	 * @param s {object} 需要加载的对象
	 * @param o {object} 加载到s上的对象
	 * @param w {boolean} 是否覆盖原有的方法 默认：false
	 //* @param pro {boolean} 是否为原型链加载 默认：false
	 * @return
	 */
	function mix(s, o, w, pro){
		var t1, t2, a;
		if(s === undefined || o === undefined)return {};
		w = w || 0;
		for(a in o){
			t1 = s[a];
			t2 = o[a];
			if(typeof t2 == 'object'){
				typeof t1 == 'object' ? mix(t1, t2, w, pro) : s[a] = t2;
			}
			// 是否覆盖, 原型是否存在a值，或者原型里对应的值为空
			if(w||!s.hasOwnProperty(a)||!t1)s[a] = t2;
		}
	}	
	/**
	 * 图片延迟加载组件
	 *@param config {object}
		*@attr placehold {url} 用于替换图片src
		//(已去掉) *@attr manual {boolean} default: true 手动模式，默认是手动模式，即填充imgs
		*@attr dataSrc {string} default: data-src 存放真实的图片地址
		*@attr tops {array} <private>所有需要加载的图片相对于body的最上方高度
		*@attr imgs {array} <protect>所有需要加载的图片 eg: jQuery('img'), NTES('img'),document.getElementsByTagName('img')
		*@attr screenValue {number} default: 1.5 相对于屏幕高度的倍数
		*@attr screenH {number} <private>default: 1.5倍的屏幕高度 图片距离浏览器屏幕上方高度的临界值，小于这个高度就加载。
	 *@undo:
	 *	不适合情况：有js大变动的改变body高度。
	 *@Description:
	 *	
	 *@return: null
	 */
	function imgLoadLater(o){
		var self = this;
		if(!(self instanceof imgLoadLater)){
			return new imgLoadLater(o);
		}
		config = self._config;
		
		// 强制合并config属性
		mix(config, o, true);
		
		config.screenH = self._getScreen();
		
		self._config = config;
		
		//log(self._config)
		// 初始化函数
		self._init();
		//return undefined;
	}
	mix(imgLoadLater.prototype , {
		_config: {//配置文件
			//placehold: null,
			//manual: true, //手动模式，默认为true 即用户自己填充imgs
			dataSrc: 'data',
			//tops: [],//存放每个元素相对于document的高度值
			//imgs: [],//存放每个img元素
			screenValue: 1.5 //距离浏览器当前屏幕的高度所需的距离
		},
		_getTop: function(elem){
			// 返回元素相对于当前浏览器屏幕顶部的高度
			return elem.getBoundingClientRect().top;
		},
		_imgLoad: function(){
			
			var self = this,
				config = self._config,
				imgs = config.imgs || [],
				tops = config.tops || [],
				dataSrc = config.dataSrc,
				l = imgs.length,
				winH = config.screenH + self._getScrollTop(),
				arrImgs=[],
				arrTops=[],
				attr, top, img;
			if(l < 1) return;
			while(l--){
				top = tops[l];
				img = imgs[l];
				// 小于对应的winH值则加载
				if(tops[l] <= winH){
					attr = img.getAttribute(dataSrc);
					attr&&(img.src = attr);
				}else{
					arrImgs.push(img);
					arrTops.push(top);
				}
			}
			//log(arrTops);
			self._config.imgs = arrImgs;
			self._config.tops = arrTops;
		},
		_getScreen: function(){
			// 距离浏览器框的高度
			return document.documentElement.clientHeight * this._config.screenValue;
		},
		_getScrollTop: function(){
			// 获取scrollTop
			if(document.body == null){
				return document.documentElement.scrollTop;
			}else if(document.documentElement == null){
				return document.documentElement.scrollTop;
			}else{
				return Math.max(document.body.scrollTop, document.documentElement.scrollTop);
			}
		},
		_filterImg: function(){
			var self = this,
				config = self._config,
				//tops = config.tops || [],
				tops = [],
				imgs = config.imgs || [],
				dataSrc = config.dataSrc,
				placehold = config.placehold,
				scrollTop = self._getScrollTop(),
				winH = config.screenH + scrollTop,
				arrImgs = imgs.length ? imgs : document.getElementsByTagName('img'),
				//isManual = config.manual,
				len = arrImgs.length,
				tmp;
			// 制空变量
			imgs = [];
			//tops = [];
			
			// 插入需要加载的imgs和tops
			while(len--){
				tmp = arrImgs[len];
				if(tmp.getAttribute(dataSrc)){
					// top = img相对浏览器屏幕的高度 + 滚动条高scroll top
					tops.push(self._getTop(tmp) + scrollTop);
					imgs.push(tmp);
					if(placehold){
						tmp.src = placehold;
					}
				}
			}
			self._config.imgs = imgs;
			self._config.tops = tops;
			// 制空对象
			self._filterImg = function(){};
		},
		_addEvent: function(elem, type, fn, b){
			if(elem.addEventListener){
				elem.addEventListener(type, fn, b || false);
			}else if(elem.attachEvent){
				elem.attachEvent('on'+type, fn);
			}else{
				elem['on'+type] = fn;
			}
		},
		_removeEvent: function(elem, type, fn){
			if(elem.removeEventListener){
				elem.removeEventListener(type, fn);
			}else if(elem.detachEvent){
				elem.detachEvent('on'+type, fn);
			}
			
		},
		// 初始化函数
		_init: function(){
			var self = this;
			//self._mix(config, o);
			// 初始化需要加载的Imgs
			self._filterImg();
			// 对应的scroll和resize事件加载
			self._addEvent(window, 'scroll', loader);
			self._addEvent(window, 'resize', (resizeLoader = function(){
				// 重新获取screenH
				self._config.screenH = self._getScreen();
				setTimeout(function(){ self._imgLoad();}, 100);
			}));
			
			// 加载img
			function loader(){
				self._imgLoad();
				if(self._config.imgs.length == 0){
					self._removeEvent(window, 'scroll', loader);
					self._removeEvent(window, 'resize', resizeLoader);
				}
			}
			
			// 第一次加载：
			loader();
		}
	});
	//log(1);
	Y._mix = mix;
	Y.imgLoadLazy = imgLoadLater;
	
	/**
	 * 手动调用图片数据加载组件
	 * @param imgs {array} img数组
	 * @param attr {string} 真实的img地址
	 * @Desc
	 *	等同上面的imgs，支持NTES、JQuery以及原生定义的img数组（document.getElementsByTagName('img')）
	 */
	Y.loadImgs = function(imgs, attr){
		var len = typeof imgs === 'object' && imgs.length, tmp, tmpAttr;
		if(len){
			attr = attr || 'data';
			while(len--){
				tmp = imgs[len], tmpAttr = tmp.getAttribute(attr);
				if(tmpAttr){
					tmp.setAttribute('src') = tmpAttr;
					tmp.removeAttribute(attr);
				}else{
					return true;
				}
			}
		}
		return false;
	}
})(YS);
}
addToOnloadFunc(function(){
	addToOnloadFunc(YS.imgLoadLazy());
});
//YS.imgLoadLazy();
 	
	
function AddFavorite(sURL, sTitle)
{
	try{
		window.external.addFavorite(sURL, sTitle);
	}catch (e)
	{
		try{
			window.sidebar.addPanel(sTitle, sURL, "");
		}catch (e){
			alert("加入收藏失败，请使用Ctrl+D进行添加");
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

function getScrollTop(){
    return document.documentElement.scrollTop+document.body.scrollTop;
}
function setScrollTop(value){
    if(document.documentElement.scrollTop){
		document.documentElement.scrollTop=value;
	}else{
		document.body.scrollTop=value;
	}
}

var g_goToTopObj = document.getElementById("goTopBtn");
function goTopEx(){
	if(g_goToTopObj != null){
		g_goToTopObj.onclick=function(){
	        var goTop=setInterval(scrollMove,10);
	        function scrollMove(){
	        	setScrollTop(getScrollTop()/1.1);
	        	if(getScrollTop()<1) clearInterval(goTop);
	       }
	    }
	} 
}
addToOnScroll(
		function(){
			getScrollTop() > 0 ? g_goToTopObj.style.display = "" : g_goToTopObj.style.display="none";
		}
		
);
goTopEx();

String.prototype.trim = function()
{
     return this.replace(/(^\s*)|(\s*$)/g,'');
}
function trim(text){
	return text.replace(/(^\s*)|(\s*$)/g,'');
}