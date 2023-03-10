// DataTable initialization with Buttons Feature
if($(".data-table").length > 0){
    $(".data-table").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');
}

