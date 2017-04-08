"use strict";
~function ($) {
    var _ = new App(), $doc = $(document);


    $doc.on("change", 'input[name="file"]', _.handleFileUpload('/upload', _.showFileInfo));

    $doc.on("click", ".tabs a", function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;
        var target = $(this).attr('href'), tabs = $('.tabs a'), tab_content = $(".tab-content");
        if ($(target).length) {
            tabs.removeClass('active');
            $(this).addClass('active');

            tab_content.removeClass("active");
            $(target).addClass("active");
        }
    })
    function App(params) {
        var that = this,
            defaultParams = {};
        this.options = $.extend(defaultParams, params);

        this.handleFileUpload = function (url, callback) {
            return function () {
                var file_input, form_data;
                if ($(this).is("form")) {
                    file_input = $(this).find('input[type="file"]');
                } else if ($(this).is('input[type="file"]')) {
                    file_input = $(this);
                } else {
                    console.warn("Attached element is not a form or input");
                }
                if (file_input.length && file_input.prop('files').length) {
                    var files = file_input.prop('files');
                    form_data = new FormData();
                    for (var file in files) {
                        form_data.append('file', files[file]);
                    }
                    that.sendUploadedFiles(url, form_data, callback);

                } else {
                    console.warn("File input not found in current form");
                }
            }
        }
        this.showFileInfo = function(data) {
            console.log(data);
            if (data.success && data.files) {
                var html = ''
                for (let file_id in data.files) {
                    let file = data.files[file_id];
                    html += '<div class="file">';
                    html += '<div class="file-image">'
                    html += '<div class="image-wrapper">'
                    html += '<img src="' + file.image + '" title="' + file.filename + '">';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="file-info">';
                    html += 'File: ' + file.filename;
                    html += '<p>File ID : ' + file_id + '</p>';
                    html += '<p>Password :' + file.password + '</p>';
                    html += '<p>File size:' + file.size + '</p>';
                    html += '</div>';
                    html += '</div>';
                }
                console.log(html);
                $('.upload-info').html(html);
                $('.card').addClass("flipped");
            }
        }
        this.sendUploadedFiles = function (url, data, callback) {
            var data = data || {};
            if (!url) {
                console.error("Url not given!");
            }
            $.ajax({
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: 'post',
                success: callback
            });
        }
    }
}(jQuery)

$('#upload').on('click', function () {
    var file_data = $('#sortpicture').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    alert(form_data);
    $.ajax({
        url: 'upload.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (php_script_response) {
            alert(php_script_response); // display response from the PHP script, if any
        }
    });
});