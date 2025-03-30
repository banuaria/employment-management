import Swal from 'sweetalert2';

async function alertConfirmation(event) {
    return await Swal.fire({
        text: event.title,
        icon: 'warning',
        iconColor: '#FAB51E',
        color: '#374151',
        allowOutsideClick: false,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Yes',
        confirmButtonColor: '#1E2642',
        cancelButtonText: 'No',
        cancelButtonColor: '#CCCCCC'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                text: 'Processing...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                },
            });
            Livewire.dispatchTo(event.to, 'listen-alert-confirmation', event.data);
        }
    });
}

async function alertSuccess(event) {
    return await Swal.fire({
        text: event.title,
        icon: 'success',
        iconColor: '#3FAE19',
        color: '#374151',
        allowOutsideClick: false,
        showConfirmButton: false,
        timer: 1500,
    }).then(() => {
        if (event.redirect != null) {
            Livewire.navigate(event.redirect);
        }
    });
}

function alertFailure(event) {
    return Swal.fire({
        text: event.title,
        icon: 'error',
        iconColor: '#D21818',
        color: '#374151',
        allowOutsideClick: true,
        confirmButtonColor: '#1E2642',
    });
}

export { alertConfirmation, alertSuccess, alertFailure }; 