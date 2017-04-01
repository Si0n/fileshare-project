~function($) {
    var $doc = $(document);


    $doc.on("change", 'input[name="file"]', function(e) {
        $(this).closest('form').submit();
    });



} (jQuery)
