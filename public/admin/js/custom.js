// 'use strict';
//   (() => {
//     const modified_inputs = new Set();
//     const defaultValue = 'defaultValue';
//     // store default values
//     addEventListener('beforeinput', evt => {
//       const target = evt.target;
//       if (!(defaultValue in target.dataset)) {
//         target.dataset[defaultValue] = ('' + (target.value || target.textContent)).trim();
//       }
//     });

//     // detect input modifications
//     addEventListener('input', evt => {
//       const target = evt.target;
//       let original = target.dataset[defaultValue];

//       let current = ('' + (target.value || target.textContent)).trim();

//       if (original !== current) {
//         if (!modified_inputs.has(target)) {
//           modified_inputs.add(target);
//         }
//       } else if (modified_inputs.has(target)) {
//         modified_inputs.delete(target);
//       }
//     });

//     addEventListener(
//       'saved',
//       function(e) {
//         modified_inputs.clear()
//       },
//       false
//     );

//     addEventListener('beforeunload', evt => {
//       if (modified_inputs.size) {
//         const unsaved_changes_warning = 'Changes you made may not be saved.';
//         evt.returnValue = unsaved_changes_warning;
//         return unsaved_changes_warning;
//       }
//     });

//   })();

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

$(document).ready(function () {
    $("#add_btn").on("click", function () {
        var html = "";
        html += "<tr>";
        html +=
            '<td><input type="text" name="subjects[]" class="form-control" required></td>';
        html +=
            '<td><input type="text" name="units[]" class="form-control units multi" id="units" min="1" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onpaste="return false" required></td>';
        html +=
            '<td><input type="text" name="grades[]" class="form-control grades multi" id="grades" onkeypress="return isFloatNumber(this,event)" required></td>';
        html +=
            '<td><button type="button" class="btn btn-secondary" id="remove"><i class="fa-solid fa-circle-minus"></i></button></td>';
        html +=
            '<td style="display:none"><input type="text" name="total[]" class="form-control total" id="total" readonly></td>';
        html += "</tr>";
        $("#calculation").append(html);
    });
});

$(document).on("click", "#remove", function () {
    $(this).closest("tr").remove();
    grandTotal();
    totalUnits();
    getGWA();
});

$(document).ready(function () {
    $("#calculation").on("input", ".multi", function () {
        var parent = $(this).closest("tr");
        var unit = $(parent).find("#units").val();
        var grade = $(parent).find("#grades").val();

        $(parent)
            .find("#total")
            .val(unit * grade);
        grandTotal();
        totalUnits();
        getGWA();
    });
});

function grandTotal() {
    var total_avg = 0;

    $(".total").each(function () {
        total_avg += Number($(this).val());
    });
    document.getElementById("weight").value = isNaN(total_avg)
        ? "0.00"
        : total_avg.toFixed(2);
}

function totalUnits() {
    var total_units = 0;

    $(".units").each(function () {
        total_units += parseFloat($(this).val());
    });
    document.getElementById("totalUnits").value = total_units;
    document.getElementById("totalUnit").innerHTML = isNaN(total_units)
        ? "0"
        : total_units.toFixed(2);
}

function getGWA() {
    var total_units = $("#totalUnits").val();
    var weight = $("#weight").val();
    var gwa = weight / total_units;

    document.getElementById("gwa").value = isNaN(gwa) ? "0.00" : gwa.toFixed(2);
}

$(document).ready(function () {
    $("#add_btn1").on("click", function () {
        var html = "";
        html += "<tr>";
        html +=
            '<td><input type="text" name="subjects1[]" class="form-control" required></td>';
        html +=
            '<td><input type="text" name="units1[]" class="form-control units1 multi1" id="units1" min="1" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onpaste="return false" required></td>';
        html +=
            '<td><input type="text" name="grades1[]" class="form-control grades1 multi1" id="grades1" onkeypress="return isFloatNumber(this,event)" required></td>';
        html +=
            '<td><button type="button" class="btn btn-secondary" id="remove1"><i class="fa-solid fa-circle-minus"></i></button></td>';
        html +=
            '<td style="display:none"><input type="text" name="total1[]" class="form-control total1" id="total1" readonly></td>';
        html += "</tr>";
        $("#calculation1").append(html);
    });
});

$(document).on("click", "#remove1", function () {
    $(this).closest("tr").remove();
    grandTotal1();
    totalUnits1();
    getGWA1();
});

$(document).ready(function () {
    $("#calculation1").on("input", ".multi1", function () {
        var parent1 = $(this).closest("tr");
        var unit = $(parent1).find("#units1").val();
        var grade = $(parent1).find("#grades1").val();

        $(parent1)
            .find("#total1")
            .val(unit * grade);
        grandTotal1();
        totalUnits1();
        getGWA1();
    });
});

function grandTotal1() {
    var total_avg1 = 0;
    $(".total1").each(function () {
        total_avg1 += Number($(this).val());
    });
    document.getElementById("weight1").value = isNaN(total_avg1)
        ? "0.00"
        : total_avg1.toFixed(2);
}

function totalUnits1() {
    var total_units = 0;

    $(".units1").each(function () {
        total_units += parseFloat($(this).val());
    });
    document.getElementById("totalUnits1").value = total_units;
    document.getElementById("totalUnit1").innerHTML = isNaN(total_units)
        ? "0"
        : total_units.toFixed(2);
}

function getGWA1() {
    var total_units = $("#totalUnits1").val();
    var weight = $("#weight1").val();
    var gwa = weight / total_units;

    document.getElementById("gwa1").value = isNaN(gwa)
        ? "0.00"
        : gwa.toFixed(2);
}

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
                searchable: false,
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

$(function () {
    var course_id = document.getElementById("course_id").value;
    var table = $(".table-data-dl").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/deans-list-award/" + course_id,
            data: function (d) {
                (d.status = $("#status").val()),
                    (d.year = $("#year").val()),
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
            { data: "year_level" },
            { data: "gwa_1st" },
            { data: "gwa_2nd" },
            {
                data: "image",
                searchable: false,
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

    $("#year,#status").change(function () {
        table.draw();
    });
});
$(function () {
    var course_id = document.getElementById("course_id").value;
    var table = $(".table-data-pl").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/presidents-list-award/" + course_id,
            data: function (d) {
                (d.status = $("#status").val()),
                    (d.year = $("#year_pl").val()),
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
            { data: "year_level" },
            { data: "gwa_1st" },
            { data: "gwa_2nd" },
            {
                data: "image",
                searchable: false,
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

    $("#year_pl,#status").change(function () {
        table.draw();
    });
});

$(document).ready(function () {
    $(".view-accepted").click(function () {
        var course_id = document.getElementById("course_id").value;
        var select = document.getElementById("year");
        var year = select.options[select.selectedIndex].value;
        var link =
            "/admin/deans-list-award/" +
            course_id +
            "/" +
            year +
            "/view-approved-students-pdf";
        window.open(link, "_blank");
    });
});
$(document).ready(function () {
    $(".view-rejected").click(function () {
        var course_id = document.getElementById("course_id").value;
        var select = document.getElementById("year");
        var year = select.options[select.selectedIndex].value;
        var link =
            "/admin/deans-list-award/" +
            course_id +
            "/" +
            year +
            "/view-rejected-students-pdf";
        window.open(link, "_blank");
    });
});
$(document).ready(function () {
    $(".view-accepted-pl").click(function () {
        var course_id = document.getElementById("course_id").value;
        var select = document.getElementById("year_pl");
        var year = select.options[select.selectedIndex].value;
        var link =
            "/admin/presidents-list-award/" +
            course_id +
            "/" +
            year +
            "/view-approved-students-pdf";
        window.open(link, "_blank");
    });
});
$(document).ready(function () {
    $(".view-rejected-pl").click(function () {
        var course_id = document.getElementById("course_id").value;
        var select = document.getElementById("year_pl");
        var year = select.options[select.selectedIndex].value;
        var link =
            "/admin/presidents-list-award/" +
            course_id +
            "/" +
            year +
            "/view-rejected-students-pdf";
        window.open(link, "_blank");
    });
});
