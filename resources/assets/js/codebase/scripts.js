document.addEventListener("DOMContentLoaded", function () {
    $("button[type='reset']").on("click", function () {
        $(this).blur();
    });

    $(".in-progress").on("click", function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'In Bearbeitung',
            text: 'In Bearbeitung',
            type: 'info',
            confirmButtonText: 'OK'
        });
    });

    $(window).bind('scroll', function () {
        let nav = $(".content-header");
        if ($(window).width() < 993) {
            if ($(window).scrollTop() > nav.height()) {
                nav.addClass('fixed');
            } else {
                nav.removeClass('fixed');
            }
        }
    });
})
