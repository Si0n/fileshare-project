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
                    html += '<li>';
                    html += '<a href="/files/' + file.file_id + '">';
                    html += '<span class="file-name">File name : <b>' +  file.filename + '</b></span>';
                    html += '<span class="file-password">Password: <b>' +  file.password + '</b></span>';
                    html += '</a>';
                    html += '</li>';
                }
                $('#upload-list').append(html);
                $('.uploads-container').addClass('expanded');
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