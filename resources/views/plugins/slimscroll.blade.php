<script src="{{asset("/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>

<!-- Page JS Helpers (SlimScroll plugin) -->
<script>
    jQuery(function () {
    });
    //re initialize slimscroll after page livewire request
    document.addEventListener("livewire:load", function (event) {
        window.livewire.hook('afterDomUpdate', () => {
            Codebase.helpers(['slimscroll']);
        });
    });
</script>