<link rel="stylesheet" href="{{asset("/js/plugins/summernote/summernote-bs4.css")}}">
<script src="{{asset("/js/plugins/summernote/summernote-bs4.min.js")}}"></script>
<script src="{{asset("/js/plugins/summernote/lang/summernote-de-DE.min.js")}}"></script>

<script>
    jQuery(function () {
        $('.js-summernote').summernote({
            lang: 'de-DE',
            callbacks: {
                onChange: function (contents, editable) {
                    let textarea = $(this).closest(".form-group").find("textarea.js-summernote");
                    //this will fire jquery validation
                    textarea.val(contents.replace(/<[^>]*>/gi, '').replace(/&nbsp;/g, '').trim())
                    textarea.blur();
                },
            },
        });
    });
</script>

