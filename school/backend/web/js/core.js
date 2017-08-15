/*
 * @Copyright Copyright (c) 2016 @core.js By Kami
 * @License http://www.yuzhai.tv/
 */
(function( $ ){
    $.fn.modalDialog = function() {
        // 没有必要再作 $(this) ，因为"this"已经是 jQuery 对象了
        // $(this) 与 $($('#element')) 是相同的
        $("#activity-create-link").click(function(e) {
            $.get(
                "create",
                function (data)
                {
                    $("#activity-modal").find(".modal-body").html(data);
                    //$(".modal-body").html(data);
                    $(".modal-title").html("创建");
                    $("#activity-modal").modal("show");
                }
            );
        });
        /*this.fadeIn('normal', function(){
        });*/
    };
})( jQuery );