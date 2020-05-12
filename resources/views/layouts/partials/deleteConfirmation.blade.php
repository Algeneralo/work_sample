<script>

    $(document).on('click', '.delete-button', function (e) {
        e.preventDefault();
        Swal.fire({
            title: '@lang("messages.delete-confirmation.title")',
            text: '@lang("messages.delete-confirmation.message")',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#226DAE',
            cancelButtonColor: '#d33',
            cancelButtonText: '@lang("messages.delete-confirmation.cancel")',
            confirmButtonText: '@lang("messages.delete-confirmation.delete")'
        }).then((result) => {
            if (result.value) {
                //new way using livewire
                window.livewire.emit('deleteItem',$(this).data("id"))
                //old way using reload page
                // $(this).siblings().submit()
            }
        })
    })
</script>