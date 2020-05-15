<script type="text/javascript" src="{{asset("/js/plugins/jquery-validation/jquery.validate.min.js")}}"></script>
<script type="text/javascript"
        src="{{asset("/js/plugins/jquery-validation/localization/messages_de.min.js")}}"></script>
<script>
    jQuery.validator.addMethod("maxParticipantsCount", function (value, element, max) {

        let items = value.replace('[', '').replace(']', '').split(',')
        jQuery.validator.messages["maxParticipantsCount"] = "Geben Sie bitte einen Wert größer oder gleich " + max + " ein.";
        return items.length <= max;
    }, '');
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