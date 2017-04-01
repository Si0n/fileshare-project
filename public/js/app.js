~function($) {
    var $doc = $(document);


    $doc.on("change", 'input[name="file"]', function(e) {
        $(this).closest('form').submit();
    });

    $doc.on("click", ".tabs a", function(e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;
        var target = $(this).attr('href'), tabs = $('.tabs a'), tab_content = $(".tab-content");
        if ($(target).length) {
            tabs.removeClass('active');
            $(this).addClass('active');

            tab_content.removeClass("active");
            $(target).addClass("active");
        }
    })

} (jQuery)
