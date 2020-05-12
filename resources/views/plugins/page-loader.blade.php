<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script>
    $.LoadingOverlay("show", {
        image: "",
        fontawesome: "fa fa-cog fa-spin"
    });
    document.addEventListener("DOMContentLoaded", function () {
        $.LoadingOverlay("hide", true);
    })
</script>