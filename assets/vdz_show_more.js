/*
 * @ author ( Zikiy Vadim )
 * @ site http://online-services.org.ua
 * @ VDZ Show More Plugin jQuery Plugin
 * @ copyright Copyright (C) 2016 All rights reserved.
 */
(function ($) {
	$(document).ready(function () {
        var vdz_more_btn = $('.vdz_sm_btn');
        // console.log(vdz_content_block);
        vdz_more_btn.on('click', function(){
            $vdz_more_btn_click = $(this);
            var vdz_content_block = $vdz_more_btn_click.parents('.vdz_show_more').find('.vdz_sm_content');
            var vdz_effect_duration = vdz_content_block.data('vdz_effect_duration') || null;
            // $(this).hide().siblings('.vdz_sm_btn').show();
            $vdz_more_btn_click.toggleClass('vdz_sm_btn_hide');
            $vdz_more_btn_click.siblings('.vdz_sm_btn').toggleClass('vdz_sm_btn_hide');
            // vdz_content_block.toggleClass('vdz_sm_content_show');
            vdz_content_block.toggle(vdz_effect_duration);
        })
    });
})(jQuery);