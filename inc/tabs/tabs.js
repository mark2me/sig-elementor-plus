
jQuery(document).ready(function($) {
    console.log('sig tabs loading....');

    $('body').on( 'click', '.sig-tabs-wrapper .sig-tab-title', function(e){
        $wrap = $(e.delegateTarget);
        index = $(this).data('tab');
                console.log($wrap,index);

        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        $('.sig-tab-content',$wrap).removeClass('active');
        $('.sig-tab-content',$wrap).eq(index-1).addClass('active');
    });
});
