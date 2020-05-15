<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $(document).on('click', '.delete-button', function (e) {
        e.preventDefault();
        let deleteForm = $($(this).data("delete-form-id"))
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
                console.log(deleteForm)
                deleteForm.submit()
            }
        })
    })
</script>