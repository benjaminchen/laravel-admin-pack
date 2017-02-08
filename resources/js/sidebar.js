$('.sidebar-menu>li').each(function() {
    var me = $(this);
    var a = me.children('a');
    if (a.attr('href') == '/admin') return;
    if (window.location.pathname.includes(a.attr('href'), 0)) {
        me.addClass('active');
    }
});

$('.sidebar-toggle').click(function() {
    $('.sidebar-menu').toggle("slow");
});