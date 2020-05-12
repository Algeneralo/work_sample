<script>
    document.addEventListener("livewire:load", function (event) {
        try {
            $('.select2.perPage').on('change', function (e) {
            @this.set('perPage', e.target.value);
            });

            $('.select2.lastMonth').on('change', function (e) {
            @this.set('lastMonth', e.target.value);
            });
            $('.select2.category').on('change', function (e) {
            @this.set('category', e.target.value);
            });
        } catch (e) {
            @if(app()->environment()=="locale")
                console.log(e)
            @endif
        }
    });
</script>