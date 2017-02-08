$(".model-row-delete").click(function() {
    var path = window.location.pathname;
    var token = $(this).data("token");
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        url: path + '/' + $(this).data("key"),
        type: "POST",
        dataType: 'json',
        contentType: 'application/json',
        data: '{"_method":"delete"}',
        success: function(data) {
            alert(data.message);
            location.reload();
        },
        error: function() {
            alert("Delete fail");
        }
    });
});