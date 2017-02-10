$('.sidebar-menu>li').each(function(index) {
    var me = $(this);
    var wPath = window.location.pathname;
    var aPath = me.children('a')[0].pathname;
    if (index == 0 && wPath.slice(-5) == 'admin') {
        me.addClass('active');
    } else if (index != 0 && wPath.includes(aPath, 0)) {
        me.addClass('active');
    }
});

$('.sidebar-toggle').click(function() {
    $('.sidebar-menu').toggle("slow");
});