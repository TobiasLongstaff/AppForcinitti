
function mensaje(){
        Swal.fire({
        title: 'Estas seguro de eliminar el pedido?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar'
        }).then((result) => {
        if (result.value) {
        Swal.fire(
            'Eliminardo!',
            'El pedido a sido eliminardo.',
            'success'
        )
        }
    })
};
