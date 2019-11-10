<script>
    let confirm
    Swal.fire({
    title: 'Are you sure?',
    text: 'You will not be able to recover this imaginary file!',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, keep it'
    }).then((result) => {
    if (result.value) {
        Swal.fire(
        confirm = true;
        'Deleted!',
        'Your imaginary file has been deleted.',
        'success'
        )
    // For more information about handling dismissals please visit
    // https://sweetalert2.github.io/#handling-dismissals
    } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire(
        confirm = false;   
        'Cancelled',
        'Your imaginary file is safe :)',
        'error'
        )
    }
    })
    confirm = JSON.stringify(confirm);
    return confirm;
</script>