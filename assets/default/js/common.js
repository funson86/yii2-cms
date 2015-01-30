
/* --- banner幻灯片 --- */
$(function() {
    $(".banner").hover(function(){
		$(this).addClass('banner-hover');
	},function(){
		$(this).removeClass('banner-hover');
	});
	
	var aPage = $('.slider_page a'); //分页按钮
    var aImg = $('.banner ul li'); //图像集合
    var iSize = aImg.size(); //图像个数
    var index = 0; //切换索引
    var t;
    $('.up').click(function() { //左边按钮点击
        index--;
        if (index < 0) {
            index = iSize - 1
        }
        change(index);
    })
	$('.down').click(function() { //右边按钮点击
        index++;
        if (index > iSize - 1) {
            index = 0
        }
        change(index);
    })
    //分页按钮点击
    aPage.click(function() {
        index = $(this).index();
        change(index);
    });
    //切换过程
    function change(index) {
        aPage.removeClass('current');
        aPage.eq(index).addClass('current');
        aImg.stop();
        //隐藏除了当前元素，所以图像
        aImg.eq(index).siblings().animate({
            opacity: 0.8
        },
        1000).hide();
        //显示当前图像
        aImg.eq(index).animate({
            opacity: 1
        },
        1000).show();
    }
    function autoshow() {
        index = index + 1;
        if (index <= iSize - 1) {
            change(index);
        } else {
            index = 0;
            change(index);
        }
    }
    int = setInterval(autoshow, 6000);
    function clearInt() {
        $('.up,.down,.slider_page a').mouseover(function() {
            clearInterval(int);
        })
    }
    function setInt() {
        $('.up,.down,.slider_page a').mouseout(function() {
            int = setInterval(autoshow, 6000);
        })
    }
    clearInt();
    setInt();
});

/* --- 焦点图切换 --- */
var FeatureList = function(fobj,options) {
  function feature_slide(nr) {
    if (typeof nr == "undefined") {
      nr = visible_idx + 1;
      nr = nr >= total_items ? 0 : nr;
    }

    tabs.removeClass(onclass).addClass(offclass).filter(":eq(" + nr + ")").removeClass(offclass).addClass(onclass);
    output.stop(true, true).filter(":visible").hide();
	    output.filter(":eq(" + nr + ")").fadeIn("slow",function() {
	    visible_idx = nr; 
    });
  }

  fobj = (typeof(fobj) == 'string')?$(fobj):fobj;
  fobj = $(fobj).eq(0);
  if(!fobj || fobj.size() == 0) return;

  //轮询间隔，默认2S
  var options      = options || {};
  var visible_idx  = options.startidx || 0;
  var onclass = options.onclass || "current";
  var offclass = options.offclass || "";
  var speed = options.speed || 10000;
  options.pause_on_act = options.pause_on_act || "click";
  options.interval  = options.interval  || 50000;

  var tabs = fobj.find(".nums li");
  var output = fobj.find(".focus li");
  var total_items = tabs.length;
 
  //初始设定
  output.hide().eq( visible_idx ).fadeIn("slow");
  tabs.eq( visible_idx ).addClass(onclass);

  if (options.interval > 0) {
    var timer = setInterval(function () {
      feature_slide();
    }, options.interval);
    output.mouseenter(function() {clearInterval( timer );}).mouseleave(function() {clearInterval( timer );timer = setInterval(function () {feature_slide();}, options.interval);});
    if (options.pause_on_act == "mouseover") {
        tabs.mouseenter(function() {
        clearInterval( timer );
        
        var idx = tabs.index($(this));
        feature_slide(idx);
      }).mouseleave(function() {
        clearInterval( timer );
        timer = setInterval(function () {
          feature_slide();
        }, options.interval);
      });
    } else {
        tabs.click(function() {
        clearInterval( timer );
        var idx = tabs.index($(this));
        feature_slide(idx);
      });
    }
  }
}

/* --- 成功案例 --- */

$(function() {
    $(".case-scroll").hover(function() {
        $(this).addClass("hover");
    },
    function() {
        $(this).removeClass("hover");
    });
});

$(function(){
	$(".case-scroll ul li").hover(function(){
		$(this).addClass('on');
	},function(){
		$(this).removeClass('on');
	});
});

$(document).ready (function () {
	//无缝滚动
	//获取元素的宽度
	var $sliw = $('.scrollCon li:first').outerWidth(true);
	
	//鼠标左按钮触发右移事件函数
	$('#case-scroll a.lButton').click(function () {
		var $l    = parseInt($('.scrollCon').css('left'));
		if ($l == 0) {
			$('.scrollCon li:last').prependTo($('.scrollCon'));
			$('.scrollCon').css({'left' : -$sliw + 'px'}).stop(true,true).animate({'left' :0 +'px'});

		} else {
			$('.scrollCon').stop(true,false).animate({'left' :0 +'px'},function () {
				$('.scrollCon li:last').prependTo($('.scrollCon'));
				$('.scrollCon').css({'left' : -$sliw + 'px'});
			});
		}

	});
	
	//鼠标右按钮触发左移事件函数
	$('#case-scroll a.rButton').click(function () {
		//点击时，获取当前移动块的左偏移
		var $l    = parseInt($('.scrollCon').css('left'));
		//如果目标偏移量正好与当前的偏移量相同，那么把块里的第一个元素移一最后，并把移动块强制拉回到到点（0），
		//然后再向目标地运动
		if ($l == -$sliw) {
			$('.scrollCon li:first').appendTo($('.scrollCon'));
			$('.scrollCon').css({'left' : 0 + 'px'}).stop(true,true).animate({'left' : -$sliw + 'px'});
		} else {
			//如果目标偏移量与当前不一样，好直接作运动就行
			$('.scrollCon').stop(true,false).animate({'left' : -$sliw + 'px'},function () {
				$('.scrollCon li:first').appendTo($('.scrollCon'));
				$('.scrollCon').css({'left' : 0 + 'px'});
			});
		}
		
	});
	
	//启动滚动
	var th=0;
	function startLoop(){
		th = window.setInterval(function(){
			$("#case-scroll a.rButton").click();
		},3000);
	}
	if($("#scrollCon li").length>7) {
		startLoop();
		$("#scrollCon").mouseenter(function() {
			window.clearInterval(th); 
			th = 0;
		});
		$("#scrollCon").mouseleave(function() {
			if(th==0) {
				startLoop();
			}  
		});
	}

}) ;

//文章栏目显示高亮
$(function(){
	var str;
	str=$(":input[name=highlight]").val();
	if(str=="light5" || str=="light6" || str=="light7" || str=="light8" ){
		$("#nav3").addClass("hover");	  
	}
})

//改变申请代理显示
var changstyle = function(style){

	var style1 =
				'<dl>'+
				'	<dt>手机/电话：</dt>'+
				'	<dd><input name="tel" type="text" /><em class="red">*</em></dd>'+
				'</dl>'+
				'<dl>'+
				'	<dt>公司名称：</dt>'+
				'	<dd><input name="company" type="text" /><em class="red">*</em></dd>'+
				'</dl>'+
				'<dl>'+
				'	<dt>所属行业是否与汽车经销商合作：</dt>'+
				'	<dd>'+
				'		<label><input name="is_cooperation" type="radio" value="1" class="radio" checked  />是</label>'+
				'		<label><input name="is_cooperation" type="radio" value="2" class="radio" />否</label>'+
				'	</dd>'+					
				'</dl>'+			
				'<dl>'+
				'	<dt>申请理由：</dt>'+
				'	<dd><textarea name="reason"></textarea><em class="red">*</em></dd>'+
				'</dl>';
	var style2 =
				'<dl>'+
				'	<dt>手机/电话：</dt>'+
				'	<dd><input name="tel" type="text" /><em class="red">*</em></dd>'+
				'</dl>'+
				'<dl>'+
				'	<dt>从业背景是否与汽车行业相关：</dt>'+
				'	<dd>'+
				'		<label><input name="is_relation" type="radio" value="1" class="radio" checked  />是</label>'+
				'		<label><input name="is_relation" type="radio" value="2" class="radio" />否</label>'+
				'	</dd>'+
				'</dl>'+
				'<dl>'+
				'	<dt>申请理由：</dt>'+
				'	<dd><textarea name="reason"></textarea><em class="red">*</em></dd></dd>'+
				'</dl>';

	if(style.value == 1){
		$("#style").html(style1);
	}else{
		$("#style").html(style2);	
	}			
	
}