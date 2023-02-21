// Call the dataTables jQuery plugin
$(document).ready(function() {
 $('#dataTable').DataTable({
    'columnDefs': [{
        'targets': 0,
        'searchable': false,
        'orderable': false
    }],
    "aaSorting": [],
    'order': []
}).on('draw', function() {
    $('input[class="user-checkboxes"]').each(function() {
        this.checked = false;
    });
    $('input[class="checkAll"]').prop('checked', false);
    $('button#bulk_delete').addClass('d-none');
});

});
