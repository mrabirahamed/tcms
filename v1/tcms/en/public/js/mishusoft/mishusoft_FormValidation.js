$(document).ready(function () {
    $('#md_name').keypress(function () {
        if (!$(this).val()) {
            $('#md_name_main').addClass("has-error");
            $('#md_name_icon').addClass("glyphicon-remove");
        } else {
            $('#md_name_main').removeClass("has-error").addClass("has-success");
            $('#md_name_icon').removeClass("glyphicon-remove").addClass("glyphicon-ok");
        }
    })
        .keydown(function () {
            if (!$(this).val()) {
                $('#md_name_main').addClass("has-error");
                $('#md_name_icon').addClass("glyphicon-remove");
            } else {
                $('#md_name_main').removeClass("has-error").addClass("has-success");
                $('#md_name_icon').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            }
        });

    $('#md_status').keypress(function () {
        if (!$(this).val()) {
            $('#md_status_main').addClass("has-error");
            $('#md_status_icon').addClass("glyphicon-remove");
        } else {
            $('#md_status_main').removeClass("has-error").addClass("has-success");
            $('#md_status_icon').removeClass("glyphicon-remove").addClass("glyphicon-ok");
        }
    })
        .keydown(function () {
            if (!$(this).val()) {
                $('#md_status_main').addClass("has-error");
                $('#md_status_icon').addClass("glyphicon-remove");
            } else {
                $('#md_status_main').removeClass("has-error").addClass("has-success");
                $('#md_status_icon').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            }
        });
});
