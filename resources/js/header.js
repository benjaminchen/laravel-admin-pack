$('.user-box').click(function() {
    $(this).find('.header-option').toggle();
});

$(document).click(function(e) {
    var target = e.target;
    if (!$(target).is('.user-box') && $('.user-box').find(target).length <= 0) $('.user-box .header-option').fadeOut();
});