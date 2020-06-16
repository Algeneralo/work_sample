{{--<link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}">--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/de.js"></script>
<script>
    let minimumResultsForSearch = 7
    $(document).ready(function () {
        $(".select2").select2({
            minimumResultsForSearch: minimumResultsForSearch,
        });
    });
    //re initialize select2 after page livewire request
    document.addEventListener("livewire:load", function (event) {
        window.livewire.hook('afterDomUpdate', () => {
            $(".select2").select2({
                minimumResultsForSearch: minimumResultsForSearch,
            })
        });
    });

</script>
