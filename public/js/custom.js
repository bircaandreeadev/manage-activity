$(document).ready(function() {
    $('table').DataTable();
    $('.dataTables_filter').find('input').addClass('form-control form-control-sm');
    $('.dataTables_filter').find('label').addClass('d-flex');
    $('.dataTables_length').find('select').addClass('form-control-sm');

    $('.js-example-basic-multiple').select2({
        placeholder: 'Select options',
        allowClear: true
    });
} );