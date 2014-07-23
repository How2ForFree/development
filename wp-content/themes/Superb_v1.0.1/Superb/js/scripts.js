/*
 * jQuery Tools 1.2.5 - The missing UI library for the Web
 * 
 * [tabs, tabs.slideshow, scrollable, scrollable.autoscroll, scrollable.navigator]
 * 
 * NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
 * 
 * http://flowplayer.org/tools/
 * 
 * File generated: Mon Nov 29 00:05:20 GMT 2010
 */
(function(c){function p(d,b,a){var e=this,l=d.add(this),h=d.find(a.tabs),i=b.jquery?b:d.children(b),j;h.length||(h=d.children());i.length||(i=d.parent().find(b));i.length||(i=c(b));c.extend(this,{click:function(f,g){var k=h.eq(f);if(typeof f=="string"&&f.replace("#","")){k=h.filter("[href*="+f.replace("#","")+"]");f=Math.max(h.index(k),0)}if(a.rotate){var n=h.length-1;if(f<0)return e.click(n,g);if(f>n)return e.click(0,g)}if(!k.length){if(j>=0)return e;f=a.initialIndex;k=h.eq(f)}if(f===j)return e;
g=g||c.Event();g.type="onBeforeClick";l.trigger(g,[f]);if(!g.isDefaultPrevented()){o[a.effect].call(e,f,function(){g.type="onClick";l.trigger(g,[f])});j=f;h.removeClass(a.current);k.addClass(a.current);return e}},getConf:function(){return a},getTabs:function(){return h},getPanes:function(){return i},getCurrentPane:function(){return i.eq(j)},getCurrentTab:function(){return h.eq(j)},getIndex:function(){return j},next:function(){return e.click(j+1)},prev:function(){return e.click(j-1)},destroy:function(){h.unbind(a.event).removeClass(a.current);
i.find("a[href^=#]").unbind("click.T");return e}});c.each("onBeforeClick,onClick".split(","),function(f,g){c.isFunction(a[g])&&c(e).bind(g,a[g]);e[g]=function(k){k&&c(e).bind(g,k);return e}});if(a.history&&c.fn.history){c.tools.history.init(h);a.event="history"}h.each(function(f){c(this).bind(a.event,function(g){e.click(f,g);return g.preventDefault()})});i.find("a[href^=#]").bind("click.T",function(f){e.click(c(this).attr("href"),f)});if(location.hash&&a.tabs=="a"&&d.find("[href="+location.hash+"]").length)e.click(location.hash);
else if(a.initialIndex===0||a.initialIndex>0)e.click(a.initialIndex)}c.tools=c.tools||{version:"1.2.5"};c.tools.tabs={conf:{tabs:"a",current:"current",onBeforeClick:null,onClick:null,effect:"default",initialIndex:0,event:"click",rotate:false,history:false},addEffect:function(d,b){o[d]=b}};var o={"default":function(d,b){this.getPanes().hide().eq(d).show();b.call()},fade:function(d,b){var a=this.getConf(),e=a.fadeOutSpeed,l=this.getPanes();e?l.fadeOut(e):l.hide();l.eq(d).fadeIn(a.fadeInSpeed,b)},slide:function(d,
b){this.getPanes().slideUp(200);this.getPanes().eq(d).slideDown(400,b)},ajax:function(d,b){this.getPanes().eq(0).load(this.getTabs().eq(d).attr("href"),b)}},m;c.tools.tabs.addEffect("horizontal",function(d,b){m||(m=this.getPanes().eq(0).width());this.getCurrentPane().animate({width:0},function(){c(this).hide()});this.getPanes().eq(d).animate({width:m},function(){c(this).show();b.call()})});c.fn.tabs=function(d,b){var a=this.data("tabs");if(a){a.destroy();this.removeData("tabs")}if(c.isFunction(b))b=
{onBeforeClick:b};b=c.extend({},c.tools.tabs.conf,b);this.each(function(){a=new p(c(this),d,b);c(this).data("tabs",a)});return b.api?a:this}})(jQuery);
(function(c){function p(g,a){function m(f){var e=c(f);return e.length<2?e:g.parent().find(f)}var b=this,i=g.add(this),d=g.data("tabs"),h,j=true,n=m(a.next).click(function(){d.next()}),k=m(a.prev).click(function(){d.prev()});c.extend(b,{getTabs:function(){return d},getConf:function(){return a},play:function(){if(h)return b;var f=c.Event("onBeforePlay");i.trigger(f);if(f.isDefaultPrevented())return b;h=setInterval(d.next,a.interval);j=false;i.trigger("onPlay");return b},pause:function(){if(!h)return b;
var f=c.Event("onBeforePause");i.trigger(f);if(f.isDefaultPrevented())return b;h=clearInterval(h);i.trigger("onPause");return b},stop:function(){b.pause();j=true}});c.each("onBeforePlay,onPlay,onBeforePause,onPause".split(","),function(f,e){c.isFunction(a[e])&&c(b).bind(e,a[e]);b[e]=function(q){return c(b).bind(e,q)}});a.autopause&&d.getTabs().add(n).add(k).add(d.getPanes()).hover(b.pause,function(){j||b.play()});a.autoplay&&b.play();a.clickable&&d.getPanes().click(function(){d.next()});if(!d.getConf().rotate){var l=
a.disabledClass;d.getIndex()||k.addClass(l);d.onBeforeClick(function(f,e){k.toggleClass(l,!e);n.toggleClass(l,e==d.getTabs().length-1)})}}var o;o=c.tools.tabs.slideshow={conf:{next:".forward",prev:".backward",disabledClass:"disabled",autoplay:false,autopause:true,interval:3E3,clickable:true,api:false}};c.fn.slideshow=function(g){var a=this.data("slideshow");if(a)return a;g=c.extend({},o.conf,g);this.each(function(){a=new p(c(this),g);c(this).data("slideshow",a)});return g.api?a:this}})(jQuery);
(function(e){function p(f,c){var b=e(c);return b.length<2?b:f.parent().find(c)}function u(f,c){var b=this,n=f.add(b),g=f.children(),l=0,j=c.vertical;k||(k=b);if(g.length>1)g=e(c.items,f);e.extend(b,{getConf:function(){return c},getIndex:function(){return l},getSize:function(){return b.getItems().size()},getNaviButtons:function(){return o.add(q)},getRoot:function(){return f},getItemWrap:function(){return g},getItems:function(){return g.children(c.item).not("."+c.clonedClass)},move:function(a,d){return b.seekTo(l+
a,d)},next:function(a){return b.move(1,a)},prev:function(a){return b.move(-1,a)},begin:function(a){return b.seekTo(0,a)},end:function(a){return b.seekTo(b.getSize()-1,a)},focus:function(){return k=b},addItem:function(a){a=e(a);if(c.circular){g.children("."+c.clonedClass+":last").before(a);g.children("."+c.clonedClass+":first").replaceWith(a.clone().addClass(c.clonedClass))}else g.append(a);n.trigger("onAddItem",[a]);return b},seekTo:function(a,d,h){a.jquery||(a*=1);if(c.circular&&a===0&&l==-1&&d!==
0)return b;if(!c.circular&&a<0||a>b.getSize()||a<-1)return b;var i=a;if(a.jquery)a=b.getItems().index(a);else i=b.getItems().eq(a);var r=e.Event("onBeforeSeek");if(!h){n.trigger(r,[a,d]);if(r.isDefaultPrevented()||!i.length)return b}i=j?{top:-i.position().top}:{left:-i.position().left};l=a;k=b;if(d===undefined)d=c.speed;g.animate(i,d,c.easing,h||function(){n.trigger("onSeek",[a])});return b}});e.each(["onBeforeSeek","onSeek","onAddItem"],function(a,d){e.isFunction(c[d])&&e(b).bind(d,c[d]);b[d]=function(h){h&&
e(b).bind(d,h);return b}});if(c.circular){var s=b.getItems().slice(-1).clone().prependTo(g),t=b.getItems().eq(1).clone().appendTo(g);s.add(t).addClass(c.clonedClass);b.onBeforeSeek(function(a,d,h){if(!a.isDefaultPrevented())if(d==-1){b.seekTo(s,h,function(){b.end(0)});return a.preventDefault()}else d==b.getSize()&&b.seekTo(t,h,function(){b.begin(0)})});b.seekTo(0,0,function(){})}var o=p(f,c.prev).click(function(){b.prev()}),q=p(f,c.next).click(function(){b.next()});if(!c.circular&&b.getSize()>1){b.onBeforeSeek(function(a,
d){setTimeout(function(){if(!a.isDefaultPrevented()){o.toggleClass(c.disabledClass,d<=0);q.toggleClass(c.disabledClass,d>=b.getSize()-1)}},1)});c.initialIndex||o.addClass(c.disabledClass)}c.mousewheel&&e.fn.mousewheel&&f.mousewheel(function(a,d){if(c.mousewheel){b.move(d<0?1:-1,c.wheelSpeed||50);return false}});if(c.touch){var m={};g[0].ontouchstart=function(a){a=a.touches[0];m.x=a.clientX;m.y=a.clientY};g[0].ontouchmove=function(a){if(a.touches.length==1&&!g.is(":animated")){var d=a.touches[0],h=
m.x-d.clientX;d=m.y-d.clientY;b[j&&d>0||!j&&h>0?"next":"prev"]();a.preventDefault()}}}c.keyboard&&e(document).bind("keydown.scrollable",function(a){if(!(!c.keyboard||a.altKey||a.ctrlKey||e(a.target).is(":input")))if(!(c.keyboard!="static"&&k!=b)){var d=a.keyCode;if(j&&(d==38||d==40)){b.move(d==38?-1:1);return a.preventDefault()}if(!j&&(d==37||d==39)){b.move(d==37?-1:1);return a.preventDefault()}}});c.initialIndex&&b.seekTo(c.initialIndex,0,function(){})}e.tools=e.tools||{version:"1.2.5"};e.tools.scrollable=
{conf:{activeClass:"active",circular:false,clonedClass:"cloned",disabledClass:"disabled",easing:"swing",initialIndex:0,item:null,items:".items",keyboard:true,mousewheel:false,next:".next",prev:".prev",speed:400,vertical:false,touch:true,wheelSpeed:0}};var k;e.fn.scrollable=function(f){var c=this.data("scrollable");if(c)return c;f=e.extend({},e.tools.scrollable.conf,f);this.each(function(){c=new u(e(this),f);e(this).data("scrollable",c)});return f.api?c:this}})(jQuery);
(function(b){var f=b.tools.scrollable;f.autoscroll={conf:{autoplay:true,interval:3E3,autopause:true}};b.fn.autoscroll=function(c){if(typeof c=="number")c={interval:c};var d=b.extend({},f.autoscroll.conf,c),g;this.each(function(){var a=b(this).data("scrollable");if(a)g=a;var e,h=true;a.play=function(){if(!e){h=false;e=setInterval(function(){a.next()},d.interval)}};a.pause=function(){e=clearInterval(e)};a.stop=function(){a.pause();h=true};d.autopause&&a.getRoot().add(a.getNaviButtons()).hover(a.pause,
a.play);d.autoplay&&a.play()});return d.api?g:this}})(jQuery);
(function(d){function p(b,g){var h=d(g);return h.length<2?h:b.parent().find(g)}var m=d.tools.scrollable;m.navigator={conf:{navi:".navi",naviItem:null,activeClass:"active",indexed:false,idPrefix:null,history:false}};d.fn.navigator=function(b){if(typeof b=="string")b={navi:b};b=d.extend({},m.navigator.conf,b);var g;this.each(function(){function h(a,c,i){e.seekTo(c);if(j){if(location.hash)location.hash=a.attr("href").replace("#","")}else return i.preventDefault()}function f(){return k.find(b.naviItem||
"> *")}function n(a){var c=d("<"+(b.naviItem||"a")+"/>").click(function(i){h(d(this),a,i)}).attr("href","#"+a);a===0&&c.addClass(l);b.indexed&&c.text(a+1);b.idPrefix&&c.attr("id",b.idPrefix+a);return c.appendTo(k)}function o(a,c){a=f().eq(c.replace("#",""));a.length||(a=f().filter("[href="+c+"]"));a.click()}var e=d(this).data("scrollable"),k=b.navi.jquery?b.navi:p(e.getRoot(),b.navi),q=e.getNaviButtons(),l=b.activeClass,j=b.history&&d.fn.history;if(e)g=e;e.getNaviButtons=function(){return q.add(k)};
f().length?f().each(function(a){d(this).click(function(c){h(d(this),a,c)})}):d.each(e.getItems(),function(a){n(a)});e.onBeforeSeek(function(a,c){setTimeout(function(){if(!a.isDefaultPrevented()){var i=f().eq(c);!a.isDefaultPrevented()&&i.length&&f().removeClass(l).eq(c).addClass(l)}},1)});e.onAddItem(function(a,c){c=n(e.getItems().index(c));j&&c.history(o)});j&&f().history(o)});return b.api?g:this}})(jQuery);

jQuery.easing['jswing'] = jQuery.easing['swing'];

if(typeof jQuery.easing != 'function') {
	jQuery.extend( jQuery.easing,
	{
		def: 'easeOutQuad',
		swing: function (x, t, b, c, d) {
			//alert(jQuery.easing.default);
			return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
		},
		easeInQuad: function (x, t, b, c, d) {
			return c*(t/=d)*t + b;
		},
		easeOutQuad: function (x, t, b, c, d) {
			return -c *(t/=d)*(t-2) + b;
		},
		easeInOutQuad: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) return c/2*t*t + b;
			return -c/2 * ((--t)*(t-2) - 1) + b;
		},
		easeInCubic: function (x, t, b, c, d) {
			return c*(t/=d)*t*t + b;
		},
		easeOutCubic: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t + 1) + b;
		},
		easeInOutCubic: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) return c/2*t*t*t + b;
			return c/2*((t-=2)*t*t + 2) + b;
		},
		easeInQuart: function (x, t, b, c, d) {
			return c*(t/=d)*t*t*t + b;
		},
		easeOutQuart: function (x, t, b, c, d) {
			return -c * ((t=t/d-1)*t*t*t - 1) + b;
		},
		easeInOutQuart: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
			return -c/2 * ((t-=2)*t*t*t - 2) + b;
		},
		easeInQuint: function (x, t, b, c, d) {
			return c*(t/=d)*t*t*t*t + b;
		},
		easeOutQuint: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t*t*t + 1) + b;
		},
		easeInOutQuint: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
			return c/2*((t-=2)*t*t*t*t + 2) + b;
		},
		easeInSine: function (x, t, b, c, d) {
			return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
		},
		easeOutSine: function (x, t, b, c, d) {
			return c * Math.sin(t/d * (Math.PI/2)) + b;
		},
		easeInOutSine: function (x, t, b, c, d) {
			return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
		},
		easeInExpo: function (x, t, b, c, d) {
			return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
		},
		easeOutExpo: function (x, t, b, c, d) {
			return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
		},
		easeInOutExpo: function (x, t, b, c, d) {
			if (t==0) return b;
			if (t==d) return b+c;
			if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
			return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
		},
		easeInCirc: function (x, t, b, c, d) {
			return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
		},
		easeOutCirc: function (x, t, b, c, d) {
			return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
		},
		easeInOutCirc: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
			return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
		},
		easeInElastic: function (x, t, b, c, d) {
			var s=1.70158;var p=0;var a=c;
			if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
			if (a < Math.abs(c)) { a=c; var s=p/4; }
			else var s = p/(2*Math.PI) * Math.asin (c/a);
			return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		},
		easeOutElastic: function (x, t, b, c, d) {
			var s=1.70158;var p=0;var a=c;
			if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
			if (a < Math.abs(c)) { a=c; var s=p/4; }
			else var s = p/(2*Math.PI) * Math.asin (c/a);
			return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
		},
		easeInOutElastic: function (x, t, b, c, d) {
			var s=1.70158;var p=0;var a=c;
			if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
			if (a < Math.abs(c)) { a=c; var s=p/4; }
			else var s = p/(2*Math.PI) * Math.asin (c/a);
			if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
			return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
		},
		easeInBack: function (x, t, b, c, d, s) {
			if (s == undefined) s = 1.70158;
			return c*(t/=d)*t*((s+1)*t - s) + b;
		},
		easeOutBack: function (x, t, b, c, d, s) {
			if (s == undefined) s = 1.70158;
			return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
		},
		easeInOutBack: function (x, t, b, c, d, s) {
			if (s == undefined) s = 1.70158; 
			if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
			return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
		},
		easeInBounce: function (x, t, b, c, d) {
			return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
		},
		easeOutBounce: function (x, t, b, c, d) {
			if ((t/=d) < (1/2.75)) {
				return c*(7.5625*t*t) + b;
			} else if (t < (2/2.75)) {
				return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
			} else if (t < (2.5/2.75)) {
				return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
			} else {
				return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
			}
		},
		easeInOutBounce: function (x, t, b, c, d) {
			if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
			return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
		}
	});
}

// Fuck You IE
if ( jQuery.browser.msie && jQuery.browser.version >= 9 ){
    jQuery.support.noCloneEvent = true;
}
jQuery.noConflict();
jQuery(document).ready(function($){
	function d(object) {
		try{
			console.log(object);
		} catch(err) {}
	}
	
	// check easing presence
	if(typeof jQuery.easing == 'undefined') {
		d("jQuery Easing plugin is missing");
	}
	
	// Divider top link behavior
	$('.uds-divider a').click(function(){
		$('html,body').animate({
			scrollTop: 0
		}, {
			duration: 300,
			easing: 'easeOutCubic'
		});
		return false;
	});
	
	//Menu setup
	var $nav = $('.nav');
	$('.nav li ul,.nav li ul li').css('visibility', 'visible');
	if($('.current-menu-item-right').length === 0) {
		$('.menu>ul>.curren_menu_item,.menu>ul>.current_page_item,.menu>ul>.current_page_parent').append('<span class="current-menu-item-right"></span>');
	}
	
	// fix for some browsers
	$('a', $nav).attr('title','');
	
	$.fn.reverse = [].reverse;
	$('ul li ul', $nav).reverse().each(function(){
		$(this).data('height', $(this).height()); // can be read only after menu has been shown
		$(this).hide();
	}).hide();
	
	$('li:has(ul)', $nav).hover(function(){
		var $ul = $('>ul', this);

		var height = $ul.data('height');
		
		var origin, anim;
		if($.browser.msie && $.browser.version < 8){
			origin = {
				height: '0px',
				overflow: 'visible'
			};
			anim = {
				height: height+'px'
			};
		} else {
			origin = {
				opacity: 0,
				height: '0px',
				overflow: 'visible'
			};
			anim = {
				opacity: 1,
				height: height+'px'
			};
		}
		
		$ul.show().css(origin).stop().animate(anim, {
			duration: 400,
			easing: 'easeOutExpo'
		});

		if($ul.offset().left + $ul.width() > $(window).width()){
			$ul.css({
				'left': - $ul.width() + 5 + 'px'
			});
		}
	}, function(){
		var $ul = $('>ul', this);

		var anim;
		if($.browser.msie && $.browser.version < 8){
			anim = {
				height: '0px'
			};
		} else {
			anim = {
				opacity: 0,
				height: '0px'
			};
		}
		
		$ul.stop().animate(anim,{
			duration: 400,
			easing: 'easeOutExpo',
			complete: function() { $(this).hide(); }
		});
	});
	
	var rad = '3px';
	// apply corner radius
	$('.nav>ul ul').css({
		'-moz-border-radius-bottomleft': '4px',
		'-moz-border-radius-bottomright': '4px',
		'-webkit-border-bottom-left-radius': '4px',
		'-webkit-border-bottom-right-radius': '4px'
	});
	
	$('.nav>ul>li>ul>li:last-child').css({
		'-moz-border-radius-bottomleft': rad,
		'-moz-border-radius-bottomright': rad,
		'-webkit-border-bottom-left-radius': rad,
		'-webkit-border-bottom-right-radius': rad
	});
	
	$('.nav>ul>li>ul>li:first-child').css({
		'-moz-border-radius-topleft': rad,
		'-moz-border-radius-topright': rad,
		'-webkit-border-top-left-radius': rad,
		'-webkit-border-top-right-radius': rad
	});
	
	$('.nav>ul ul ul>li:first-child').css({
		'-moz-border-radius-topleft': rad,
		'-moz-border-radius-topright': rad,
		'-webkit-border-top-left-radius': rad,
		'-webkit-border-top-right-radius': rad
	});
	
	$('.nav>ul ul ul>li:last-child').css({
		'-moz-border-radius-bottomleft': rad,
		'-moz-border-radius-bottomright': rad,
		'-webkit-border-bottom-left-radius': rad,
		'-webkit-border-bottom-right-radius': rad
	});

	
	// move last menus to the left if it overflows
	var $lastUl = $('>ul>li:last-child>ul', $nav);
	var lastUlWidth = $lastUl.width();
	var lastLiWidth = $('>ul>li:last-child', $nav).width();
	if(lastUlWidth > lastLiWidth){
		var newLeft = lastUlWidth - lastLiWidth;
		$lastUl.css('left', '-' + newLeft + 'px');
	}
	$lastUl.css('background-position', '120px 0px');
	
	// fix trim for IE
	if(typeof String.prototype.trim !== 'function') {
		String.prototype.trim = function() {
			return this.replace(/^\s+|\s+$/, ''); 
		};
	}
	
	// add .last
	$('ul>li:last>a,ul>li:last', $nav).addClass('last');
	
	// ammend current menu item
	$('.nav>ul>.current-menu-item,.nav>.menu>ul>.current_page_item').click(function(){
		$('.current-menu-item-right').add('a', this).addClass('active');
	});
	
	// searchbars, form elements default text removal
	var setupField = function(){
		$(this).data('value', $(this).val())
		.focus(function(){
			if($(this).val() == $(this).data('value')){
				$(this).val('');
			}
		}).blur(function(){
			if($(this).val() === ''){
				$(this).val($(this).data('value'));
			}
		});
	};
	
	$('#top-search,input[name=uds-email],input[name=uds-subject],textarea[name=uds-text]').each(setupField);
	
	// Sidebar slideshow
	$('.uds-slideshow-widget .images img').each(function(i, el){
		var link = $('<div>' + (i + 1) + '</div>');
		if(i !== 0) {
			$(this).hide();
		} else {
			$(link).addClass('active');
		}
		$(link).click(function(event){
			$('.uds-slideshow-widget .control div').removeClass('active');
			$(this).addClass('active');
			
			if($('.uds-slideshow-widget .images img:eq(' + i + ')').is(':visible')) return;
			
			$('.uds-slideshow-widget .images img:visible').animate({opacity: 0}, {
				duration: 800, 
				easing: 'easeOutExpo', 
				complete:function(){
					$(this).hide();
					$('.uds-slideshow-widget').height($(this).height());
				}
			});
			
			$('.uds-slideshow-widget .images img:eq(' + i + ')').show().css({opacity: 0}).animate({opacity: 1},{
				duration: 800,
				easing: 'easeOutExpo'
			});
		});
		$('.uds-slideshow-widget .control').append(link);
	});
	$('.uds-slideshow-widget').height($('.uds-slideshow-widget .images img:first').height());
	$('.uds-slideshow-widget .images img:first').load(function(){
		$('.uds-slideshow-widget').height($('.uds-slideshow-widget .images img:first').height());
	});
	
	// Shortcode suport
	// Tabs
	if(typeof jQuery.tools == 'object') {
		$('.uds-tabs-wrapper').each(function(){
			$('.uds-tabs', this).tabs($('.uds-panes>div', this));
		});
		
		// Acordions
		$('.uds-accordion-wrapper').each(function(){
			$(this).tabs($('.pane', this), {tabs: 'h2', effect: 'slide', initialIndex: 0});
		});
		
		$('.uds-accordion-wrapper.horizontal').each(function(){
			$(this).tabs($('.pane', this), {tabs: 'h2', effect: 'horizontal', initialIndex: 0});
		});
		
		$('.uds-overlay').each(function(){
			$(this).overlay({
				//effect: 'apple',
				target: $(this).next()
			});
		});
		
		$('.uds-tour').height($('.uds-tour .pages').height());
		
		$('.uds-tour-status>li:first').addClass('active');
		$('.uds-tour').scrollable({
			items: '.page'
		}).navigator('.uds-tour-status');
	}
	
	if(typeof jQuery.fancybox == 'function') {
		$('.fancybox,.gallery-icon a').fancybox();
	}
	
	// footer social icons hover
	$('.social-footer img.social').css('opacity', 0);
	$('.social-footer a').hover(function(){
		$('img', this).stop().animate({opacity: 1}, 200);
	}, function(){
		$('img', this).stop().animate({opacity: 0}, 200);
	});
	
	// Togglers
	$('.uds-toggle').hide();
	$('.uds-toggler').click(function(){
		if($(this).next().is(':visible')) {
			$(this).removeClass('open').next().stop().slideUp(300);
		} else {
			$(this).addClass('open').next().stop().slideDown(300);
		}
	});
	
	// Flickr widget 
	$('.uds-flickr-widget a').hover(function(){
		$('.uds-flickr-widget a').stop().not(this).animate({
			opacity: 0.6
		}, 300);
		$(this).animate({
			opacity: 1
		}, 300);
	}, function(){
		$('.uds-flickr-widget a').stop().animate({
			opacity: 1
		}, 300);
	});
	
	function pad(number, length) {
		var str = '' + number;
		while (str.length < length) {
			str = '0' + str;
		}

		return str;
	}
	
	function updateDateValues() {
		now = new Date();
		remainingDays = Math.floor((date.getTime()/1000 - now.getTime()/1000) / (24 * 3600));
		remainingHours = Math.floor((date.getTime()/1000 - now.getTime()/1000 - remainingDays * 24 * 3600) / 3600);
		remainingMinutes = Math.floor((date.getTime()/1000 - now.getTime()/1000 - remainingDays * 24 * 3600 - remainingHours * 3600) / 60);
		remainingSeconds = Math.floor((date.getTime()/1000 - now.getTime()/1000 - remainingDays * 24 * 3600 - remainingHours * 3600 - remainingMinutes * 60));
	}
	
	function animateDateValues() {
		var daysEl = $('#construction .days .number');
		var hoursEl = $('#construction .hours .number');
		var minutesEl = $('#construction .minutes .number');
		var secondsEl = $('#construction .seconds .number');
		
		var speed = 100;
		
		if(remainingDays < 0) {
			remainingDays = 0;
		}
		if(parseInt(daysEl.text(), 10) != remainingDays) {
			daysEl.fadeOut(speed, function(){
				$(this).text(pad(remainingDays, 2)).fadeIn(speed);
			});
		}
		
		if(remainingHours < 0) {
			remainingHours = 0;
		}
		if(parseInt(hoursEl.text(), 10) != remainingHours) {
			hoursEl.fadeOut(speed, function(){
				$(this).text(pad(remainingHours, 2)).fadeIn(speed);
			});
		}
		
		if(remainingMinutes < 0) {
			remainingMinutes = 0;
		}
		if(parseInt(minutesEl.text(), 10) != remainingMinutes) {
			minutesEl.fadeOut(speed, function(){
				$(this).text(pad(remainingMinutes, 2)).fadeIn(speed);
			});
		}
		
		if(remainingSeconds < 0) {
			remainingSeconds = 0;
		}
		if(parseInt(secondsEl.text(), 10) != remainingSeconds) {
			secondsEl.fadeOut(speed, function(){
				$(this).text(pad(remainingSeconds, 2)).fadeIn(speed);
			});
		}
	}
	
	function constructionTimer() {
		updateDateValues();
		animateDateValues();
	}
	
	// maintenance mode
	if($('#construction').length > 0) {
		var height = $(window).height() - 109 - 137 - 38;
		if(height < 600) {
			height = 600;
		}
		$('#content').height(height);
		
		var date = new Date(
			parseInt($('#construction .date').text().substr(0, 4), 10), 
			parseInt($('#construction .date').text().substr(5, 2), 10) - 1, 
			parseInt($('#construction .date').text().substr(8, 2), 10), 
			parseInt($('#construction .time').text().substr(0, 2), 10), 
			parseInt($('#construction .time').text().substr(3, 2), 10),
			0
		);

		var now = new Date();
		var remainingDays;
		var remainingHours;
		var remainingMinutes;
		var remainingSeconds;
		
		setInterval(constructionTimer, 1000);
	}
});