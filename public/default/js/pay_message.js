$.extend({
    payplayer: function (options) {
        var defaults = {
            triggerBtn: null,
            modal: null,
            position: 'fixed',
			width:'570',
			height:'240'
        }

        var conf = $.extend({}, defaults, options);  

        // 显示
	   // $(conf.triggerBtn).stopPropagation();
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
$(function() {
	$('.pay_ok').click(function() {
		window.location.reload();
	});
	$('.pay_error').click(function() {
		$('#pay_dialog').fadeOut(100);
	});
})