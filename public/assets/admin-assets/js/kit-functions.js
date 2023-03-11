// DataTable initialization with Buttons Feature
if ($(".data-table").length > 0) {
    $(".data-table")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        })
        .buttons()
        .container()
        .appendTo(".dataTables_wrapper .col-md-6:eq(0)");
}

//Initialize Select2 Elements
if ($(".select2").length > 0) {
    $(".select2").select2();
}
if ($(".select2bs4").length > 0) {
    $(".select2bs4").select2({
        theme: "bootstrap4",
    });
}

// Toaster message
function showMessage(type, message) {
    if (type == undefined || type == "") return;

    var className = "";
    if (type.toUpperCase() == "SUCCESS") {
        className = "bg-success";
    } else if (type.toUpperCase() == "ERROR") {
        className = "bg-danger";
    } else if (type.toUpperCase() == "INFO") {
        className = "bg-info";
    } else if (type.toUpperCase() == "WARNING") {
        className = "bg-warning";
    }

    if (className == "") return;

    $(document).Toasts("create", {
        class: className,
        title: type.toUpperCase(),
        autohide: true,
        delay: 3000,
        body: message,
    });
}


$(document).on('click', '.mainform-submit', function(e){
    e.preventDefault();
    submitForm($(this).parents('form'));
})

function submitForm(mainform){
    $.ajax({
        'type': $(mainform).attr('method'),
        'url': $(mainform).attr('action'),
        'data': $(mainform).serialize(),
        'dataType': 'json',
        'success': function(data) {
            console.log({data});
            // if (data.status == 'success') {
            //     $('#myModal').modal('hide');
            //     location.reload();
            // } else {
            //     alert(data.message);
            // }
        }
    });
}