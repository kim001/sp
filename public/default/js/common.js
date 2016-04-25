var gxunc = "http://localhost/shop11/";
$(function(){
    $('#checkAll').click(function() {
        var child = $('input[name="idstr"]');
        if( $(this).is(":checked") ) {
            child.each(function () {
                $(this).prop("checked", "true");
            })
        }
        else {
            child.each(function () {
                $(this).removeAttr("checked");
            })
        }
    });
	$('.all_pro').mouseover(function() {
		$('.all_pro_box').show();
	})
	$('.all_pro').mouseout(function() {
		$('.all_pro_box').hide();
	})
})
function redirection(jump, url) {
    if(jump == 1) {
        location.href = url;
    }
    else if(jump == 2) {
        window.location.reload();
    }
    $('.laytip').fadeOut(100).delay(100).remove();
}
$.extend({

    /*
        提示框
        调用：$.laytip()
    */
    laytip: function(options) {
        // 默认是提示成功
        var defaults = {
            status:'n',
            jump:3,
            url:'',
            bg: true,     // 默认关闭透明背景
            bgcolor: '#FF643A',  // 主题颜色
            img: gxunc+'/public/default/images/img-laytip-error.png',  // 提示图片
            msg: '提示消息：操作失败'  // 提示语
        };
        
        var config = $.extend({}, defaults, options);
        if(config.status == 'y') {  //成功
            config.img = gxunc+'/public/default/images/img-laytip-success.png';
            config.bgcolor = '#4DC07C';
        }
        else {
            config.img = gxunc+'/public/default/images/img-laytip-error.png';
            config.bgcolor = '#FF643A';
        }
        // 布局
        var laytip = '<div class="laytip">\
            <div class="laytip-content">\
                <div class="laytip-body" style="background: '+config.bgcolor+'">\
                    <span class="close">x</span>\
                    <img src="'+config.img+'" alt="">\
                    <p>'+config.msg+'</p>\
                </div>\
                <button class="laytip-confirm" type="button">确认</button>\
            </div>\
        </div>';
        $('body').append(laytip);

        // 判断是否需要透明背景
        if(config.bg) {
            $('.laytip').css('background', 'rgba(0,0,0,0.3)');
        }

        // 显示
        $('.laytip').fadeIn(100);

        // 删除
        $('.laytip .close').click(function(e) {
            clearTimeout(itime);
            $(this).parents('.laytip').fadeOut(100).delay(100).remove();
            if(config.jump == 1) {
                location.href = config.url;
            }
            else if(config.jump == 2) {
                window.location.reload();
            }
        });
        $('.laytip-confirm').click(function(e) {
            clearTimeout(itime);
            $(this).parents('.laytip').fadeOut(100).delay(100).remove();
            if(config.jump == 1) {
                location.href = config.url;
            }
            else if(config.jump == 2) {
                window.location.reload();
            }
        });
        // 点击其他区域删除
        $('.laytip').click(function() {
            clearTimeout(itime);
            if(config.jump == 1) {
                location.href = config.url;
            }
            else if(config.jump == 2) {
                window.location.reload();
            }
            $(this).fadeOut(100).delay(100).remove();
        });

        // 阻止事件冒泡
        $('.laytip-content').click(function(e) {
            e.stopPropagation();
        });
        itime = window.setTimeout("redirection('"+config.jump+"', '"+config.url+"')", 2000);
    },

    /*
        select框
        调用：$.select('.selectbox');
        callback在选择的时候回调用
    */
    select: function(ele, on, time, callback) {

        // 动画时间
        if(!time || time==null || time==0 || time=='undefined') {
            time = 60;
        }

        // 初始化
        if($(ele).children('input').val() == '') {
            var firstVal = $(ele).find('ul>li:first').text();
            $(ele).children('input').attr('value', firstVal);
        }

        // 显示下拉
        $(ele).children('input, .caret').click(function() {
            if($(this).parent().hasClass(on)) {
                $(this).parent().removeClass(on);
                $(this).siblings('ul').slideUp(time);
            } else {
                $(this).parent().addClass(on);
                $(this).siblings('ul').slideDown(time);
            }    
        });

        // 赋值
        $(ele).find('ul>li').click(function() {
            $(ele).children('input').attr('value', $(this).text());
            $(this).parent().slideUp().parent().removeClass(on);

            // 回调函数
            try {
                if (typeof(eval(callback)) == "function") {  // 判断参数是否是函数
                    callback();
                }
            } catch(e) {
                console.log(e.name + ": " + e.message);
            }
        });
    },
     /*
        弹出层
        调用：$.poplayer(触发按钮，弹出层，显示方式);
    */
    poplayer: function (options) {
        var defaults = {
            triggerBtn: null,
            modal: null,
            position: 'fixed',
			width:'570',
			height:'240'
        }

        var conf = $.extend({}, defaults, options);  

        // 显示
        $(conf.triggerBtn).click(function(e) {
            e.stopPropagation();
            $(conf.modal).fadeIn(100);

            // 显示方式和垂直居中
            if(conf.position == 'fixed') {
                $(conf.modal).css('position', conf.position).height($(window).height());
                $(conf.modal).find('.modal-dialog').css('marginTop', ($(window).height() - $(conf.modal).find('.modal-dialog').outerHeight()) /2 );
            } else if(conf.position == 'absolute') {
                $(conf.modal).css('position', conf.position).height($(document).outerHeight());
                $(conf.modal).find('.modal-dialog').css('marginBottom', 100);
            }
			$(conf.modal).find('.modal-dialog').css('width', conf.width+'px');
			$(conf.modal).find('.modal-dialog').css('min-height', conf.height+'px');
        });

        // 关闭
        $(conf.modal+' .modal-header .close').click(function() {
            $(this).parents(conf.modal).fadeOut(100);
        });

        // 阻止事件冒泡
        $(conf.modal+' .modal-dialog').click(function(e) {
            e.stopPropagation();
        });

        // 点击其他区域关闭
        $('body').click(function() {
            $(conf.modal).fadeOut(100);
        });
        $('.closedialog').click(function() {
            $(conf.modal).fadeOut(100);
        });
    }
});

function countDown(time,day_elem,hour_elem,minute_elem,second_elem) {
    var end_time = new Date(time).getTime(),sys_second = (end_time-new Date().getTime())/1000;
    var timer1 = setInterval(function() {
        if (sys_second > 0) {
            sys_second -= 1;
            var day = Math.floor((sys_second/3600)/24);
            var hour = Math.floor((sys_second / 3600) % 24);
            var minute = Math.floor((sys_second / 60) % 60);
            var second = Math.floor(sys_second % 60);
            day_elem && $(day_elem).text(day);//计算天
            $(hour_elem).text(hour<10?"0"+hour:hour);//计算小时
            $(minute_elem).text(minute<10?"0"+minute:minute);//计算分
            $(second_elem).text(second<10?"0"+second:second);// 计算秒
        }
        else { 
            clearInterval(timer1);
        }
    }, 1000);
}

/*非零正浮点数
 *Gxunc
 **/
function moneyRule(obj) {
    var rule = /^[+]?(([0-9]\d*[.]?))(\d{0,2})?$/;
    //var rule = /^\d+(\.\d{2})?$/;
    if (!rule.test($(obj).val())) {
        $(obj).val('');
    }
    var rule1 = /^(([0])|(0\.[0])){2,}$/;
    if (rule1.test($(obj).val())) {
        $(obj).val('');
    }
    var rule2 = /^[0][1-9]$/;
    if (rule2.test($(obj).val())) {
        $(obj).val('');
    }
}
/*正浮点数
 *Gxunc
 **/
function moneyIntRule(obj) {
    var rule = /^([+]?(([1-9]\d*[.]?))(\d{0,2})|([0]{1}))$/;
    if (!rule.test($(obj).val())) {
        $(obj).val('');
    }
}