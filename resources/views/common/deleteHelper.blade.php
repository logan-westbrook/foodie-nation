<script>
    $(() => {
        $('body').on('click', '.delete-item', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: (response) => {
                            if (response.status === 200) {
                                toastr.success(response.message);
                                window.location.reload();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: (error) => toastr.error(
                            error?.responseJSON?.message ??
                            'An Error has occurred during deletion'
                        ),
                    })
                }
            })
        });
    });
</script>
