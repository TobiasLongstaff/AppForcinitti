$('.btn-cancelar').on('click', function(e)
{
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire
    ({
        title: 'Estas sguro?',
        text: 'Al salir se cancelara el pedido',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'No cancelar pedido',
        confirmButtonText: 'Cancelar',
    }).then((result) =>
    {
        if(result.value)
        {
            document.location.href = href;
        }
    })
})

$('.btn-finalizar').on('click', function(e)
{
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire
    ({
        title: 'Terminar pedido?',
        text: 'Seguro que queres terminar el pedido?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No terminar',
        confirmButtonText: 'Terminar',
    }).then((result) =>
    {
        if(result.value)
        {
            document.location.href = href;
        }
    })
})

$('.btn-eliminar').on('click', function(e)
{
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire
    ({
        title: 'Eliminar producto?',
        text: 'Una vez se elimine el producto no se podra recuperar',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Eliminar',
    }).then((result) =>
    {
        if(result.value)
        {
            document.location.href = href;
        }
    })
})
