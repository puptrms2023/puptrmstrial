jQuery(function ($) {
    $(".js-phone").inputmask({
        mask: ["+639999999999", "8 999 999-99-99"],
        jitMasking: 3,
        showMaskOnHover: false,
        autoUnmask: true,
    });
});

function limit(element) {
    var max_chars = 15;
    if (element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
    }
}

function isFloatNumber(item, evt) {
    evt = evt ? evt : window.event;
    var charCode = evt.which ? evt.which : evt.keyCode;
    if (charCode == 46) {
        var regex = new RegExp(/\./g);
        var count = $(item).val().match(regex).length;
        if (count > 1) {
            return false;
        }
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$(document).ready(function () {
    $(".status").change(function () {
        var responseId = $(this).val();
        if (responseId == "2") {
            $("#reason").removeClass("hidden");
            $("#reason").addClass("show");
        } else {
            $("#reason").removeClass("show");
            $("#reason").addClass("hidden");
        }
    });
});

$(function () {
    var course_id = document.getElementById("course_id").value;
    var table = $(".table-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/achievers-award/" + course_id,
            data: function (d) {
                (d.status = $("#status").val()),
                    (d.search = $('input[type="search"]').val());
            },
        },
        columns: [
            {
                data: "users.stud_num",
                name: "users.stud_num",
                className: "font-weight-bold",
            },
            { data: "users.first_name", name: "users.first_name" },
            { data: "users.last_name", name: "users.last_name" },
            { data: "courses.course_code", name: "courses.course_code" },
            { data: "gwa_1st" },
            { data: "gwa_2nd" },
            {
                data: "image",
                className: "text-center",
            },
            { data: "status", className: "text-center" },
            {
                data: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    $("#status").change(function () {
        table.draw();
    });
});
