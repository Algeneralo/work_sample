<link rel="stylesheet" href="https://fengyuanchen.github.io/datepicker/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="https://unpkg.com/lightpick@latest/css/lightpick.css">
<link rel="stylesheet" href="https://fengyuanchen.github.io/datepicker/css/datepicker.css">

<script defer src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script defer type="text/javascript" src="https://unpkg.com/lightpick@latest/lightpick.js"></script>

<script>
    $(document).ready(function () {
        $(".datePicker").each(function () {
            new Lightpick({
                field: $(this)[0],
                lang: 'de',
                format: "DD.MM.Y",
            });
        });
    })
</script>
