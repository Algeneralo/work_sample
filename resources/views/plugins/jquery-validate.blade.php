<script type="text/javascript" src="{{asset("/js/plugins/jquery-validation/jquery.validate.min.js")}}"></script>
<script type="text/javascript"
        src="{{asset("/js/plugins/jquery-validation/localization/messages_de.min.js")}}"></script>
<script>
    jQuery.validator.addMethod("maxParticipantsCount", function (value, element, max) {

        let items = value.replace('[', '').replace(']', '').split(',')
        jQuery.validator.messages["maxParticipantsCount"] = `Max. ${max} Teilnehmer erlaubt.`;
        return items.length <= max;
    }, '');

    //change required default behavior, trim whitespaces
    jQuery.validator.addMethod('required', function (value, element, param) {

        // Check if dependency is met
        if (!this.depend(param, element)) {
            return "dependency-mismatch";
        }
        if (element.nodeName.toLowerCase() === "select") {

            // Could be an array for select-multiple or a string, both are fine this way
            var val = $(element).val();
            return val && val.length > 0;
        }
        if (this.checkable(element)) {
            return this.getLength(value, element) > 0;
        }

        if (element.nodeName.toLowerCase() === "textarea" && element.className === "js-summernote") {
            value = value.replace(/<[^>]*>/gi, '').replace(/&nbsp;/g, '').trim()
        }
        if (value !== undefined)
            value = value.trim()

        return value !== undefined && value !== null && value.length > 0;
    });
    jQuery(".js-validation-bootstrap").validate({
        ignore: ".ignore-validation,hidden,.note-editable.card-block",
        errorClass: "invalid-feedback animated fadeInDown",
        errorElement: "div",
        errorPlacement: function (e, r) {
            let parent = ".form-group";
            if (!$(e).hasClass("hidden") && $(r).css("display") !== "none" && jQuery(r).parents(".form-group").find("div").length > 0) {
                parent = ".form-group div";
            }
            jQuery(r).parent(parent).append(e)
        },
        highlight: function (e) {
            //focus hidden fields
            if ($(e).hasClass("hidden"))
                $(e).closest(".form-group").attr("tabindex", -1).focus();

            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
        },
        success: function (e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid");
            jQuery(e).remove()
        }
    });

</script>