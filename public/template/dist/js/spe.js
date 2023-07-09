let table = new DataTable('#myTable')
var base_url = window.location.protocol + "//" + window.location.host

function generateControllerURL(controller) {
    if (controller == 0) {
        return controller = base_url + '/inbox/'
    } else if (controller == 1) {
        return controller = base_url + '/mailbox/'
    } else if (controller == 2) {
        return controller = base_url + '/user/updateStatus/'
    } else if (controller == 3) {
        return controller = base_url + '/user/'
    } else if (controller == 4) {
        return controller = base_url + '/inventory/'
    }
}

function openModalEdit(id, nama, status, controller, surat = true) {
    $('#status-modal').modal('show')

    var controller = generateControllerURL(controller)

    var url = controller + id

    $('#formUpdate').attr('action', url)
    $('#nama_user').text(nama)
    $('#status').val(status)

    if (!surat) {
        if (status == 0) {
            $('#status-text-label').text('Aktifkan akun dengan Nomor Induk:')
        } else if (status == 1) {
            $('#status-text-label').text('Nonaktifkan akun dengan Nomor Induk:')
        }
    }
}

function openModalDelete(id, controller) {
    $('#delete-modal').modal('show')

    var controller = generateControllerURL(controller)

    var url = controller + id

    $('#formDelete').attr('action', url)
}