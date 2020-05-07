$(document).ready(function() {
    $('table').DataTable({
        "order": [],
        // Your other options here...
    });
    $('.dataTables_filter').find('input').addClass('form-control form-control-sm');
    $('.dataTables_filter').find('label').addClass('d-flex');
    $('.dataTables_length').find('select').addClass('form-control-sm');

    $('.js-example-basic-multiple').select2({
        placeholder: 'Select options',
        allowClear: true
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('.add-task').click(function() {
        modal = $("#create-task");
        modal.css('display', 'block');
    });

    $('.close-modal').click(function() {
        modal = $("#create-task");
        modal.removeClass('d-block');
        modal.css('display', 'none');
        $('input').removeClass('is-invalid');
        $('select').removeClass('is-invalid');
    });

    $('.update-task').on('click', function() {
       
        var id= $(this).attr('id');
        
        $.get('../tasks/' + id , function (data) {
            //success data
            $('.form-update').attr("action", data.url);
            
            $('#title').val(data.title);
            $('#board_id').val(data.board_id);     
            $('#user_id').val(data.user_id);  
            $('#label_id').val(data.label_id);  
            $('#project_id').val(data.project_id);  
            $('#due_date').val(data.due_date);  
            
            $('#btn-save').val("update");

            
        });
        modal = $("#update-task");
        modal.css('display', 'block');
    });

    $('.close-modal-edit').click(function() {
        modal = $("#update-task");
        modal.removeClass('d-block');
        modal.css('display', 'none');
        $('input').removeClass('is-invalid');
        $('select').removeClass('is-invalid');
    });

    $('.add-board').click(function() {
        modal = $("#create-board");
        modal.css('display', 'block');
    });

    $('.close-modal').click(function() {
        modal = $("#create-board");
        modal.removeClass('d-block');
        modal.css('display', 'none');
        $('input').removeClass('is-invalid');
        $('select').removeClass('is-invalid');
    });
} );