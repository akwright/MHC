function ajaxRequest(){var t=["Msxml2.XMLHTTP","Microsoft.XMLHTTP"];if(!window.ActiveXObject)return window.XMLHttpRequest?new XMLHttpRequest:!1;for(var e=0;e<t.length;e++)try{return new ActiveXObject(t[e])}catch(i){}}function loadCustomPosts(t,e){for(var i=window.location.origin+"/Freelance/MHC/wordpress/",n=i+"wp-admin/admin-ajax.php",s=new ajaxRequest,a="",o=document.getElementById("js-taxName"),r=document.getElementsByClassName("js-ajax"),l=0,c;c=r[l];l++)c.classList.remove("active");a=void 0!==e?"action=load-filter2&term="+e:"action=load-filter2",t.classList.add("active"),o.innerHTML=t.getAttribute("data-name"),s.onreadystatechange=function(){4===s.readyState&&(200===s.status||-1===window.location.href.indexOf("http")?document.getElementsByClassName("posts")[0].innerHTML=s.responseText:alert("There was an error with the request."))},s.open("POST",n,!0),s.setRequestHeader("Content-type","application/x-www-form-urlencoded"),s.send(a)}Element.prototype.hasClass=function(t){return this.className&&new RegExp("(^|\\s)"+t+"(\\s|$)").test(this.className)},function(){var t,e,i,n,s;for(i=function(t){var e,i;i=t.getAttribute("data-defer-src"),e=document.createAttribute("src"),e.nodeValue=i,t.setAttributeNode(e)},e=document.querySelectorAll("img[data-defer-src]"),n=0,s=e.length;s>n;n++)t=e[n],i(t)}.call(this),function(){var t=document.getElementById("page-header"),e=document.getElementsByTagName("body")[0],i={init:function(){this.scrollHeader()},featuredImage:function(){function i(t){s.setAttribute("style","margin-top:"+(e.hasClass("home")?n.clientHeight-74:n.clientHeight+t)+"px")}var n=document.getElementById("featured-image"),s=document.getElementById("content");window.addEventListener("resize",function(){i(window.innerWidth>=930?t.clientHeight:81)}),i(t.clientHeight)},scrollHeader:function(){var t=300,i=document.getElementById("featured-image"),n=i.getElementsByClassName("js-featured_text")[0];window.onscroll=function(){window.pageYOffset>t?e.classList.remove("no-bg"):e.classList.add("no-bg"),window.pageYOffset<=i.offsetHeight&&(n.style.top=50-window.pageYOffset/7*.1+"%")}}};i.init()}(),function(){var t;t=function(){function t(t,e){this.element=t,this.options="[object Object]"===Object.prototype.toString.call(e)?e:{},this.init(),this.gotoslide(0),this.autoplay&&this.play()}var e,i,n,s,a,o;return t.prototype.pause=function(){clearTimeout(this.interval)},t.prototype.play=function(){clearTimeout(this.interval),this.interval=setTimeout(e,this.duration,this)},t.prototype.next=function(){var t;t=this.currentIndex<this.slides.length-1?this.currentIndex+1:0,this.gotoslide(t)},t.prototype.gotoslide=function(t){var e,i;this.currentIndex!==t&&(e=this.element.parentNode.querySelector(".visible"),e&&e===this.slideA?(this.slideB.style.backgroundPosition="0px "+String(this.options.height*t*-1)+"px",this.slideA.className=this.slideA.className.replace(new RegExp("(\\s|^)visible(\\s|$)"),""),this.slideB.className+=" visible"):(this.slideA.style.backgroundPosition="0px "+String(this.options.height*t*-1)+"px",this.slideB.className=this.slideB.className.replace(new RegExp("(\\s|^)visible(\\s|$)"),""),this.slideA.className+=" visible"),e=this.navigation.querySelector(".active"),e&&e.removeAttribute("class"),e=document.createAttribute("class"),e.nodeValue="active",this.navigation.childNodes.item(t).setAttributeNode(e),i=-1===this.currentIndex?0:this.currentIndex,this.slides[i].el.className=this.slides[i].el.className.replace(new RegExp("(\\s|^)active(\\s|$)"),""),this.slides[t].el.className+=" active",this.currentIndex=t)},t.prototype.init=function(){var t,e,n,r,l,c,h,d,u;if(e=this,this.options.width||(this.options.width=this.element.offsetWidth),this.options.height||(this.options.height=this.element.offsetHeight),this.autoplay=!0,this.duration=5e3,this.currentIndex=-1,this.element.className.match(new RegExp("(\\s|^)fss(\\s|$)"))||(this.element.className+=" fss"),this.caption=this.element.querySelector(".captions"),this.caption){for(t=this.caption.firstChild,l=0,this.slides=[];t;)t&&3!==t.nodeType&&this.slides.push({ndx:l++,el:t}),t=t.nextSibling;for(this.container=i("div","slide-container"),this.slideA=i("div","slide-a visible"),this.slideB=i("div","slide-b"),this.element.insertBefore(this.container,this.caption),this.container.appendChild(this.slideA),this.container.appendChild(this.slideB),this.slideA.style.width=this.slideB.style.width=this.options.width+"px",this.slideA.style.height=this.slideB.style.height=this.options.height+"px",this.navigation=i("ul","fss-nav"),u=this.slides,n=h=0,d=u.length;d>h;n=++h)c=u[n],r=i("li"),r.appendChild(document.createTextNode(String(n+1))),this.navigation.appendChild(r),r.onclick=o(r,this);this.container.appendChild(this.navigation),this.container.onmouseover=function(t){return a(t,e)},this.container.onmouseout=function(t){return s(t,e)}}},i=function(t,e){var i,n;return n=document.createElement(t),e?(i=document.createAttribute("class"),i.nodeValue=e,n.setAttributeNode(i),n):n},n=function(t,e){if(t===e)return!1;for(;t&&t!==e;)t=t.parentNode;return t===e},e=function(t){t&&(t.next(),t.play())},o=function(t,e){return function(){var i;for(e.pause(),i=0;e.navigation.childNodes.item(i);){if(e.navigation.childNodes.item(i)===t)return void e.gotoslide(i);i++}}},a=function(t,e){if(t){if(!n(t.target,e.container))return t.cancelBubble=!0,t.stopPropagation(),!1;e.pause(),e.navigation.className.match(new RegExp("(\\s|^)active(\\s|$)"))||(e.navigation.className+=" active")}},s=function(t,e){return n(t.relatedTarget,e.container)?(t.cancelBubble=!0,t.stopPropagation(),!1):(e.play(),void(e.navigation.className.match(new RegExp("(\\s|^)active(\\s|$)"))&&(e.navigation.className=e.navigation.className.replace(new RegExp("(\\s|^)active(\\s|$)"),""))))},t}()}.call(this),function(){var t;t=function(){function t(t,e){this.element=t,this.options="[object Object]"===Object.prototype.toString.call(e)?e:{},this.options.resizeImage=!1,this.init()}var e,i,n,s;return t.prototype.init=function(){var t;t=this,this.element.onclick=function(i){return e(i,t)}},t.prototype.createOverlay=function(t){var e;e=this,this.overlay=document.createElement("div"),this.overlay.setAttribute("id","flb-overlay"),this.overlay.innerHTML='<div id="flb-container"><a href="#" title="Close" class="closingElement">&nbsp;</a></div><div id="flb-content"><a id="flb-image" class="closingElement" href="#" title="Close"></a><a id="flb-close" class="closingElement" href="#" title="Close">&times;</a></div>',document.getElementsByTagName("body")[0].appendChild(this.overlay),this.container=document.getElementById("flb-content"),this.container.onclick=this.overlay.onclick=function(t){return i(t,e)},this.imgContainer=document.getElementById("flb-image"),this.imgContainer.style.background="url("+t+") no-repeat 50% 50%",this.image=new Image,this.image.onload=function(t){return n(t,e)},this.image.src=t},n=function(t,e){var i,n,a,o;e.options.resizeImage?(o=document.documentElement.clientHeight-40,e.image.height<o?(n=e.image.height,a=e.image.width):(n=o,a=Math.round(o*e.image.width/e.image.height),e.image.height=n,e.image.width=a)):(n=e.image.height,a=e.image.width),i=function(){return s(e.container,a,n)},setTimeout(i,600)},s=function(t,e,i){t.style.width=e+"px",t.style.height=i+"px",t.style.margin="-"+(i+28)/2+"px 0 0 -"+e/2+"px",t.setAttribute("class","active")},e=function(t,e){return e.createOverlay(t.currentTarget.getAttribute("href")),t.cancelBubble=!0,t.stopPropagation(),!1},i=function(t,e){e.container.setAttribute("class",""),document.getElementsByTagName("body")[0].removeChild(e.overlay)},t}()}.call(this);