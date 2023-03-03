
document.addEventListener('DOMContentLoaded', (event) => {
    $('.status').on('change', checkPattern);
    checkPattern();
    $('.reject').on('change', checkPattern2);
    checkPattern2();
    initializeSelect2('.selectsub');

    const uploadButton = document.getElementById('upload_sig');
const imageDiv = document.getElementById('upload_signature');

// Add click event listeners to the buttons
uploadButton.addEventListener('click', () => {
    imageDiv.classList.remove('hidden');
    digitalDiv.classList.add('hidden');
});
});


$(document).ready(function () {
    $(".nonacadaward").change(function() {
        // Reset all form values
        $('#sports-value, #comp-value, #placement-value, #subject-value, #thesis-value, #designation-value').val('');
        $("#org-value").val("").trigger("change");

        // Get selected response ID
        var responseId = $(this).val();

        // Show/hide fields based on response ID
        if (responseId == "1") {
          $("#organization, #leadership_fields").show();
        } else {
          $("#organization, #leadership_fields").hide();
        }

        if (responseId == "2") {
          $("#sports").show();
        } else {
          $("#sports").hide();
        }

        if (responseId == "3") {
          $("#organization, #outstanding_fields").show();
        } else {
          $("#organization, #outstanding_fields").hide();
        }

        if (responseId == "4") {
          $("#subject_name, #thesis").show();
          $("#supporting").addClass("hidden");
        } else {
          $("#subject_name, #thesis").hide();
          $("#supporting").removeClass("hidden");
        }

        if (responseId == "3" || responseId == "4") {
            $("#photo_two").addClass("hidden");

          } else {
            $("#photo_two").removeClass("hidden");
          }

        if (responseId == "6") {
          $("#sa").show();
        } else {
          $("#sa").hide();
        }

        if (responseId == "7") {
          $("#outside").show();
        } else {
          $("#outside").hide();
        }

        if (responseId == "1" || responseId == "5" || responseId == "6" || responseId == "7") {
          $("#organization").show();
        } else {
          $("#organization").hide();
        }

        // Check if the #idPic element is visible after the show/hide logic is applied
        console.log($("#supporting").is(":visible"));
      });

});
//other
$(document).ready(function () {
    $(".studentorg").change(function () {
        $('#others').find(':input').val('');
        var responseId = $(this).val();
        if (responseId == "9") {
            $("#others").removeClass("hidden");
            $("#others").addClass("show");
        } else {
            $("#others").removeClass("show");
            $("#others").addClass("hidden");
        }
    });
});
//5th yeat tab
$(document).ready(function () {
    $(".5thyear").change(function () {
        var responseId = $(this).val();
        if (responseId == "5th Year") {
            $("#5th_1").removeClass("hidden");
            $("#5th_1").addClass("show");
            $("#5th_2").removeClass("hidden");
            $("#5th_2").addClass("show");
            $('#5th_1 :input').removeAttr('disabled');
            $('#5th_2 :input').removeAttr('disabled');
        } else {
            $("#5th_1").removeClass("show");
            $("#5th_1").addClass("hidden");
            $("#5th_2").removeClass("show");
            $("#5th_2").addClass("hidden");
            $('#5th_1 :input').attr('disabled', true);
            $('#5th_2 :input').attr('disabled', true);
        }
    });
});
// User--------------------------------------------------------------------------
$(document).ready(function () {
    $(".status").change(function () {
        var responseId = $(this).val();
        if (responseId == "2") {
            $("#reject").removeClass("hidden");
            $("#reject").addClass("show");
            // $("#others").removeClass("hidden");
            // $("#others").addClass("show");
        } else {
            $("#reject").removeClass("show");
            $("#reject").addClass("hidden");
            // $("#others").removeClass("show");
            // $("#others").addClass("hidden");
        }
    });
});
//show reject select option
var checkPattern = function() {
    if ($('.status').val() == '2') {
        $("#reject").removeClass("hidden");
        $("#reject").addClass("show");
    } else {
        $("#reject").removeClass("show");
        $("#reject").addClass("hidden");
    }
}
//show reason
var checkPattern2 = function() {
    if ($('.reject').val() == '1') {
        $("#others").removeClass("hidden");
        $("#others").addClass("show");
    } else {
        $("#others").removeClass("show");
        $("#others").addClass("hidden");
    }
}
// User--------------------------------------------------------------------------

//Phone Format
jQuery(document).ready(function($){
    $(".js-phone").inputmask({
        mask: ["+639999999999"],
        jitMasking: 3,
        showMaskOnHover: false,
        autoUnmask: true,
    });
});
//Student No. Validation
function limit(element) {
    var max_chars = 15;
    if (element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
    }
}
//Number Validation
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
//select
$(document).ready(function() {
    $('#session_year').select2({
        theme: 'bootstrap4',
        allowClear: true
    });
});

//Dropdown Reject Hide and Show
$(document).ready(function () {
    $(".status").change(function () {
        var responseId = $(this).val();
        if (responseId == "2") {
            $("#reject").removeClass("hidden");
            $("#reject").addClass("show");
        } else {
            $("#reject").removeClass("show");
            $("#reject").addClass("hidden");
        }
    });
    //show
    $(".reject").change(function () {
        var responseId = $(this).val();
        if (responseId == "1") {
            $("#others").removeClass("hidden");
            $("#others").addClass("show");
        } else {
            $("#others").removeClass("show");
            $("#others").addClass("hidden");
        }
    });
});
//select2
function initializeSelect2(selector) {
    $(selector).select2({
        theme: 'bootstrap4',
        width: $(selector).data('width') ? $(selector).data('width') : $(selector).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(selector).data('placeholder'),
        allowClear: Boolean($(selector).data('allow-clear')),
        closeOnSelect: !$(selector).attr('multiple'),
    });
}
//Award Application Validation Dropdown
var $selectYear = $('#selectYear'),
		$selectAward = $('#selectAward'),
    $options = $selectAward.find('option');

$selectYear.on('change', function() {
	$selectAward.html($options.filter('[data-state="'+this.value+'"]'));
}).trigger('change');

//1st Term
$(document).ready(function () {
    $("#add_btn").on("click", function () {
        var html = "";
        html += "<tr>";
        html +=
            '<td><select name="subjects[]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>';
        html += '<option selected="selected"></option>';
        for (var i = 0; i < sub.length; i++) {
            html += '<option value="' + sub[i].id + '">' + sub[i].s_code + ' - ' + sub[i].s_name + '</option>';
        }
        html += '</select></td>';
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
        initializeSelect2('.selectsub');
    });
});

$(document).on("click", "#remove", function () {
    $(this).closest("tr").remove();
    grandTotal();
    totalUnits();
    getGWA();
    displayResult();
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
        displayResult();
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
//2nd Term
$(document).ready(function () {
    $("#add_btn1").on("click", function () {
        var html = "";
        html += "<tr>";
        html +=
            '<td><select name="subjects1[]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>';
        html += '<option selected="selected"></option>';
        for (var i = 0; i < sub.length; i++) {
            html += '<option value="' + sub[i].id + '">' + sub[i].s_code + ' - ' + sub[i].s_name + '</option>';
        }
        html += '</select></td>';
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
        initializeSelect2('.selectsub');
    });
});

$(document).on("click", "#remove1", function () {
    $(this).closest("tr").remove();
    grandTotal1();
    totalUnits1();
    getGWA1();
    displayResult();
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
        displayResult();
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
//Third Term
$(document).ready(function() {
    $("#add_btn3").on("click", function() {
        var html = "";
        html += "<tr>";
        html +=
            '<td><select name="subjects3[]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>';
        html += '<option selected="selected"></option>';
        for (var i = 0; i < sub.length; i++) {
            html += '<option value="' + sub[i].id + '">' + sub[i].s_code + ' - ' + sub[i].s_name + '</option>';
        }
        html += '</select></td>';
        html +=
            '<td><input type="text" name="units3[]" class="form-control units3 multi3" id="units3" min="1" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onpaste="return false" required></td>';
        html +=
            '<td><input type="text" name="grades3[]" class="form-control grades3 multi3" id="grades3" onkeypress="return isFloatNumber(this,event)" required></td>';
        html +=
            '<td><button type="button" class="btn btn-secondary" id="remove3"><i class="fa-solid fa-circle-minus"></i></button></td>';
        html +=
            '<td style="display:none"><input type="text" name="total3[]" class="form-control total3" id="total3" readonly></td>';
        html += "</tr>";
        $("#calculation3").append(html);
        initializeSelect2('.selectsub');
    });
});

$(document).on("click", "#remove3", function() {
    $(this).closest("tr").remove();
    grandTotal3();
    totalUnits3();
    getGWA3();
});

$(document).ready(function() {
    $("#calculation3").on("input", ".multi3", function() {
        var parent = $(this).closest("tr");
        var unit = $(parent).find("#units3").val();
        var grade = $(parent).find("#grades3").val();

        console.log(unit);

        $(parent)
            .find("#total3")
            .val(unit * grade);
        grandTotal3();
        totalUnits3();
        getGWA3();
    });
});

function grandTotal3() {
    var total_avg = 0;

    $(".total3").each(function() {
        total_avg += Number($(this).val());
    });
    document.getElementById("weight3").value = isNaN(total_avg) ?
        "0.00" :
        total_avg.toFixed(2);
}

function totalUnits3() {
    var total_units = 0;

    $(".units3").each(function() {
        total_units += parseFloat($(this).val());
    });
    document.getElementById("totalUnits3").value = total_units;
    document.getElementById("totalUnit3").innerHTML = isNaN(total_units) ?
        "0" :
        total_units.toFixed(2);
}

function getGWA3() {
    var total_units = $("#totalUnits3").val();
    var weight = $("#weight3").val();
    var gwa = weight / total_units;

    document.getElementById("gwa3").value = isNaN(gwa) ? "0.00" : gwa.toFixed(2);
}
//Fourth Term
$(document).ready(function() {
    $("#add_btn4").on("click", function() {
        var html = "";
        html += "<tr>";
        html +=
            '<td><select name="subjects4[]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>';
        html += '<option selected="selected"></option>';
        for (var i = 0; i < sub.length; i++) {
            html += '<option value="' + sub[i].id + '">' + sub[i].s_code + ' - ' + sub[i].s_name + '</option>';
        }
        html +=
            '<td><input type="text" name="units4[]" class="form-control units4 multi4" id="units4" min="1" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 14) ? null : event.charCode >= 48 && event.charCode <= 57" onpaste="return false" required></td>';
        html +=
            '<td><input type="text" name="grades4[]" class="form-control grades4 multi4" id="grades4" onkeypress="return isFloatNumber(this,event)" required></td>';
        html +=
            '<td><button type="button" class="btn btn-secondary" id="remove4"><i class="fa-solid fa-circle-minus"></i></button></td>';
        html +=
            '<td style="display:none"><input type="text" name="total4[]" class="form-control total4" id="total4" readonly></td>';
        html += "</tr>";
        $("#calculation4").append(html);
        initializeSelect2('.selectsub');
    });
});

$(document).on("click", "#remove4", function() {
    $(this).closest("tr").remove();
    grandTotal4();
    totalUnits4();
    getGWA4();
});

$(document).ready(function() {
    $("#calculation4").on("input", ".multi4", function() {
        var parent = $(this).closest("tr");
        var unit = $(parent).find("#units4").val();
        var grade = $(parent).find("#grades4").val();

        console.log(unit);

        $(parent)
            .find("#total4")
            .val(unit * grade);
        grandTotal4();
        totalUnits4();
        getGWA4();
    });
});

function grandTotal4() {
    var total_avg = 0;

    $(".total4").each(function() {
        total_avg += Number($(this).val());
    });
    document.getElementById("weight4").value = isNaN(total_avg) ?
        "0.00" :
        total_avg.toFixed(2);
}

function totalUnits4() {
    var total_units = 0;

    $(".units4").each(function() {
        total_units += parseFloat($(this).val());
    });
    document.getElementById("totalUnits4").value = total_units;
    document.getElementById("totalUnit4").innerHTML = isNaN(total_units) ?
        "0" :
        total_units.toFixed(2);
}

function getGWA4() {
    var total_units = $("#totalUnits4").val();
    var weight = $("#weight4").val();
    var gwa = weight / total_units;

    document.getElementById("gwa4").value = isNaN(gwa) ? "0.00" : gwa.toFixed(2);
}
//5th Term
$(document).ready(function() {
    $("#add_btn5").on("click", function() {
        var html = "";
        html += "<tr>";
        html +=
            '<td><select name="subjects5[]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>';
        html += '<option selected="selected"></option>';
        for (var i = 0; i < sub.length; i++) {
            html += '<option value="' + sub[i].id + '">' + sub[i].s_code + ' - ' + sub[i].s_name + '</option>';
        }
        html +=
            '<td><input type="text" name="units5[]" class="form-control units5 multi5" id="units5" min="1" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onpaste="return false" required></td>';
        html +=
            '<td><input type="text" name="grades5[]" class="form-control grades5 multi5" id="grades5" onkeypress="return isFloatNumber(this,event)" required></td>';
        html +=
            '<td><button type="button" class="btn btn-secondary" id="remove5"><i class="fa-solid fa-circle-minus"></i></button></td>';
        html +=
            '<td style="display:none"><input type="text" name="total5[]" class="form-control total5" id="total5" readonly></td>';
        html += "</tr>";
        $("#calculation5").append(html);
        initializeSelect2('.selectsub');
    });
});

$(document).on("click", "#remove5", function() {
    $(this).closest("tr").remove();
    grandTotal5();
    totalUnits5();
    getGWA5();
});

$(document).ready(function() {
    $("#calculation5").on("input", ".multi5", function() {
        var parent5 = $(this).closest("tr");
        var unit = $(parent5).find("#units5").val();
        var grade = $(parent5).find("#grades5").val();

        $(parent5)
            .find("#total5")
            .val(unit * grade);
        grandTotal5();
        totalUnits5();
        getGWA5();
    });
});

function grandTotal5() {
    var total_avg5 = 0;
    $(".total5").each(function() {
        total_avg5 += Number($(this).val());
    });
    document.getElementById("weight5").value = isNaN(total_avg5) ?
        "0.00" :
        total_avg5.toFixed(2);
}

function totalUnits5() {
    var total_units = 0;

    $(".units5").each(function() {
        total_units += parseFloat($(this).val());
    });
    document.getElementById("totalUnits5").value = total_units;
    document.getElementById("totalUnit5").innerHTML = isNaN(total_units) ?
        "0" :
        total_units.toFixed(2);
}

function getGWA5() {
    var total_units = $("#totalUnits5").val();
    var weight = $("#weight5").val();
    var gwa = weight / total_units;

    document.getElementById("gwa5").value = isNaN(gwa) ?
        "0.00" :
        gwa.toFixed(2);
}
//6th Term
$(document).ready(function() {
    $("#add_btn6").on("click", function() {
        var html = "";
        html += "<tr>";
        html +=
            '<td><select name="subjects6[]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>';
        html += '<option selected="selected"></option>';
        for (var i = 0; i < sub.length; i++) {
            html += '<option value="' + sub[i].id + '">' + sub[i].s_code + ' - ' + sub[i].s_name + '</option>';
        }
        html +=
            '<td><input type="text" name="units6[]" class="form-control units6 multi6" id="units6" min="1" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onpaste="return false" required></td>';
        html +=
            '<td><input type="text" name="grades6[]" class="form-control grades6 multi6" id="grades6" onkeypress="return isFloatNumber(this,event)" required></td>';
        html +=
            '<td><button type="button" class="btn btn-secondary" id="remove6"><i class="fa-solid fa-circle-minus"></i></button></td>';
        html +=
            '<td style="display:none"><input type="text" name="total6[]" class="form-control total6" id="total6" readonly></td>';
        html += "</tr>";
        $("#calculation6").append(html);
        initializeSelect2('.selectsub');
    });
});

$(document).on("click", "#remove6", function() {
    $(this).closest("tr").remove();
    grandTotal6();
    totalUnits6();
    getGWA6();
});

$(document).ready(function() {
    $("#calculation6").on("input", ".multi6", function() {
        var parent6 = $(this).closest("tr");
        var unit = $(parent6).find("#units6").val();
        var grade = $(parent6).find("#grades6").val();

        $(parent6)
            .find("#total6")
            .val(unit * grade);
        grandTotal6();
        totalUnits6();
        getGWA6();
    });
});

function grandTotal6() {
    var total_avg6 = 0;
    $(".total6").each(function() {
        total_avg6 += Number($(this).val());
    });
    document.getElementById("weight6").value = isNaN(total_avg6) ?
        "0.00" :
        total_avg6.toFixed(2);
}

function totalUnits6() {
    var total_units = 0;

    $(".units6").each(function() {
        total_units += parseFloat($(this).val());
    });
    document.getElementById("totalUnits6").value = total_units;
    document.getElementById("totalUnit6").innerHTML = isNaN(total_units) ?
        "0" :
        total_units.toFixed(2);
}

function getGWA6() {
    var total_units = $("#totalUnits6").val();
    var weight = $("#weight6").val();
    var gwa = weight / total_units;

    document.getElementById("gwa6").value = isNaN(gwa) ?
        "0.00" :
        gwa.toFixed(2);
}
//7th Term
$(document).ready(function() {
    $("#add_btn7").on("click", function() {
        var html = "";
        html += "<tr>";
        html +=
            '<td><select name="subjects7[]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>';
        html += '<option selected="selected"></option>';
        for (var i = 0; i < sub.length; i++) {
            html += '<option value="' + sub[i].id + '">' + sub[i].s_code + ' - ' + sub[i].s_name + '</option>';
        }
        html +=
            '<td><input type="text" name="units7[]" class="form-control units7 multi7" id="units7" min="1" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onpaste="return false" required></td>';
        html +=
            '<td><input type="text" name="grades7[]" class="form-control grades7 multi7" id="grades7" onkeypress="return isFloatNumber(this,event)" required></td>';
        html +=
            '<td><button type="button" class="btn btn-secondary" id="remove7"><i class="fa-solid fa-circle-minus"></i></button></td>';
        html +=
            '<td style="display:none"><input type="text" name="total7[]" class="form-control total7" id="total7" readonly></td>';
        html += "</tr>";
        $("#calculation7").append(html);
        initializeSelect2('.selectsub');
    });
});

$(document).on("click", "#remove7", function() {
    $(this).closest("tr").remove();
    grandTotal7();
    totalUnits7();
    getGWA7();
});

$(document).ready(function() {
    $("#calculation7").on("input", ".multi7", function() {
        var parent7 = $(this).closest("tr");
        var unit = $(parent7).find("#units7").val();
        var grade = $(parent7).find("#grades7").val();

        $(parent7)
            .find("#total7")
            .val(unit * grade);
        grandTotal7();
        totalUnits7();
        getGWA7();
    });
});

function grandTotal7() {
    var total_avg7 = 0;
    $(".total7").each(function() {
        total_avg7 += Number($(this).val());
    });
    document.getElementById("weight7").value = isNaN(total_avg7) ?
        "0.00" :
        total_avg7.toFixed(2);
}

function totalUnits7() {
    var total_units = 0;

    $(".units7").each(function() {
        total_units += parseFloat($(this).val());
    });
    document.getElementById("totalUnits7").value = total_units;
    document.getElementById("totalUnit7").innerHTML = isNaN(total_units) ?
        "0" :
        total_units.toFixed(2);
}

function getGWA7() {
    var total_units = $("#totalUnits7").val();
    var weight = $("#weight7").val();
    var gwa = weight / total_units;

    document.getElementById("gwa7").value = isNaN(gwa) ?
        "0.00" :
        gwa.toFixed(2);
}
//8th Term
$(document).ready(function() {
    $("#add_btn8").on("click", function() {
        var html = "";
        html += "<tr>";
        html +=
            '<td><select name="subjects8[]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>';
        html += '<option selected="selected"></option>';
        for (var i = 0; i < sub.length; i++) {
            html += '<option value="' + sub[i].id + '">' + sub[i].s_code + ' - ' + sub[i].s_name + '</option>';
        }
        html +=
            '<td><input type="text" name="units8[]" class="form-control units8 multi8" id="units8" min="1" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onpaste="return false" required></td>';
        html +=
            '<td><input type="text" name="grades8[]" class="form-control grades8 multi8" id="grades8" onkeypress="return isFloatNumber(this,event)" required></td>';
        html +=
            '<td><button type="button" class="btn btn-secondary" id="remove8"><i class="fa-solid fa-circle-minus"></i></button></td>';
        html +=
            '<td style="display:none"><input type="text" name="total8[]" class="form-control total8" id="total8" readonly></td>';
        html += "</tr>";
        $("#calculation8").append(html);
        initializeSelect2('.selectsub');
    });
});

$(document).on("click", "#remove8", function() {
    $(this).closest("tr").remove();
    grandTotal8();
    totalUnits8();
    getGWA8();
});

$(document).ready(function() {
    $("#calculation8").on("input", ".multi8", function() {
        var parent8 = $(this).closest("tr");
        var unit = $(parent8).find("#units8").val();
        var grade = $(parent8).find("#grades8").val();

        $(parent8)
            .find("#total8")
            .val(unit * grade);
        grandTotal8();
        totalUnits8();
        getGWA8();
    });
});

function grandTotal8() {
    var total_avg8 = 0;
    $(".total8").each(function() {
        total_avg8 += Number($(this).val());
    });
    document.getElementById("weight8").value = isNaN(total_avg8) ?
        "0.00" :
        total_avg8.toFixed(2);
}

function totalUnits8() {
    var total_units = 0;

    $(".units8").each(function() {
        total_units += parseFloat($(this).val());
    });
    document.getElementById("totalUnits8").value = total_units;
    document.getElementById("totalUnit8").innerHTML = isNaN(total_units) ?
        "0" :
        total_units.toFixed(2);
}

function getGWA8() {
    var total_units = $("#totalUnits8").val();
    var weight = $("#weight8").val();
    var gwa = weight / total_units;

    document.getElementById("gwa8").value = isNaN(gwa) ?
        "0.00" :
        gwa.toFixed(2);
}
//5th year 1st sem
$(document).ready(function() {
    $("#add_btn10").on("click", function() {
        var html = "";
        html += "<tr>";
        html +=
            '<td><select name="subjects10[]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub">';
        html += '<option selected="selected"></option>';
        for (var i = 0; i < sub.length; i++) {
            html += '<option value="' + sub[i].id + '">' + sub[i].s_code + ' - ' + sub[i].s_name + '</option>';
        }
        html +=
            '<td><input type="text" name="units10[]" class="form-control units10 multi10" id="units10" min="1" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onpaste="return false"></td>';
        html +=
            '<td><input type="text" name="grades10[]" class="form-control grades10 multi10" id="grades10" onkeypress="return isFloatNumber(this,event)"></td>';
        html +=
            '<td><button type="button" class="btn btn-secondary" id="remove10"><i class="fa-solid fa-circle-minus"></i></button></td>';
        html +=
            '<td style="display:none"><input type="text" name="total10[]" class="form-control total10" id="total10" readonly></td>';
        html += "</tr>";
        $("#calculation10").append(html);
        initializeSelect2('.selectsub');
    });
});

$(document).on("click", "#remove10", function() {
    $(this).closest("tr").remove();
    grandTotal10();
    totalUnits10();
    getGWA10();
});

$(document).ready(function() {
    $("#calculation10").on("input", ".multi10", function() {
        var parent10 = $(this).closest("tr");
        var unit = $(parent10).find("#units10").val();
        var grade = $(parent10).find("#grades10").val();

        $(parent10)
            .find("#total10")
            .val(unit * grade);
        grandTotal10();
        totalUnits10();
        getGWA10();
    });
});

function grandTotal10() {
    var total_avg10 = 0;
    $(".total10").each(function() {
        total_avg10 += Number($(this).val());
    });
    document.getElementById("weight10").value = isNaN(total_avg10) ?
        "0.00" :
        total_avg10.toFixed(2);
}

function totalUnits10() {
    var total_units = 0;

    $(".units10").each(function() {
        total_units += parseFloat($(this).val());
    });
    document.getElementById("totalUnits10").value = total_units;
    document.getElementById("totalUnit10").innerHTML = isNaN(total_units) ?
        "0" :
        total_units.toFixed(2);
}

function getGWA10() {
    var total_units = $("#totalUnits10").val();
    var weight = $("#weight10").val();
    var gwa = weight / total_units;

    document.getElementById("gwa10").value = isNaN(gwa) ?
        "0.00" :
        gwa.toFixed(2);
}

//5th year 2nd -sem
$(document).ready(function() {
    $("#add_btn11").on("click", function() {
        var html = "";
        html += "<tr>";
        html +=
            '<td><select name="subjects11[]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub">';
        html += '<option selected="selected"></option>';
        for (var i = 0; i < sub.length; i++) {
            html += '<option value="' + sub[i].id + '">' + sub[i].s_code + ' - ' + sub[i].s_name + '</option>';
        }
        html +=
            '<td><input type="text" name="units11[]" class="form-control units11 multi11" id="units11" min="1" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onpaste="return false"></td>';
        html +=
            '<td><input type="text" name="grades11[]" class="form-control grades11 multi11" id="grades11" onkeypress="return isFloatNumber(this,event)"></td>';
        html +=
            '<td><button type="button" class="btn btn-secondary" id="remove11"><i class="fa-solid fa-circle-minus"></i></button></td>';
        html +=
            '<td style="display:none"><input type="text" name="total11[]" class="form-control total11" id="total11" readonly></td>';
        html += "</tr>";
        $("#calculation11").append(html);
        initializeSelect2('.selectsub');
    });
});

$(document).on("click", "#remove11", function() {
    $(this).closest("tr").remove();
    grandTotal11();
    totalUnits11();
    getGWA11();
});

$(document).ready(function() {
    $("#calculation11").on("input", ".multi11", function() {
        var parent11 = $(this).closest("tr");
        var unit = $(parent11).find("#units11").val();
        var grade = $(parent11).find("#grades11").val();

        $(parent11)
            .find("#total11")
            .val(unit * grade);
        grandTotal11();
        totalUnits11();
        getGWA11();
    });
});

function grandTotal11() {
    var total_avg11 = 0;
    $(".total11").each(function() {
        total_avg11 += Number($(this).val());
    });
    document.getElementById("weight11").value = isNaN(total_avg11) ?
        "0.00" :
        total_avg11.toFixed(2);
}

function totalUnits11() {
    var total_units = 0;

    $(".units11").each(function() {
        total_units += parseFloat($(this).val());
    });
    document.getElementById("totalUnits11").value = total_units;
    document.getElementById("totalUnit11").innerHTML = isNaN(total_units) ?
        "0" :
        total_units.toFixed(2);
}

function getGWA11() {
    var total_units = $("#totalUnits11").val();
    var weight = $("#weight11").val();
    var gwa = weight / total_units;

    document.getElementById("gwa11").value = isNaN(gwa) ?
        "0.00" :
        gwa.toFixed(2);
}
//Summer Subjects and Grades
$(document).ready(function() {
    $("#add_btn9").on("click", function() {
        var html = "";
        html += "<tr>";
        html +=
            '<td><select name="subjects9[]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub">';
        html += '<option selected="selected"></option>';
        for (var i = 0; i < sub.length; i++) {
            html += '<option value="' + sub[i].id + '">' + sub[i].s_code + ' - ' + sub[i].s_name + '</option>';
        }
        html +=
            '<td><input type="text" name="units9[]" class="form-control units9 multi9" id="units9" min="9" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onpaste="return false"></td>';
        html +=
            '<td><input type="text" name="grades9[]" class="form-control grades9 multi9" id="grades9" onkeypress="return isFloatNumber(this,event)"></td>';
        html +=
            '<td><button type="button" class="btn btn-secondary" id="remove9"><i class="fa-solid fa-circle-minus"></i></button></td>';
        html +=
            '<td style="display:none"><input type="text" name="total9[]" class="form-control total9" id="total9" readonly></td>';
        html += "</tr>";
        $("#calculation9").append(html);
        initializeSelect2('.selectsub');
    });
});

$(document).on("click", "#remove9", function() {
    $(this).closest("tr").remove();
    grandTotal9();
    totalUnits9();
    getGWA9();
});

$(document).ready(function() {
    $("#calculation9").on("input", ".multi9", function() {
        var parent9 = $(this).closest("tr");
        var unit = $(parent9).find("#units9").val();
        var grade = $(parent9).find("#grades9").val();

        $(parent9)
            .find("#total9")
            .val(unit * grade);
        grandTotal9();
        totalUnits9();
        getGWA9();
    });
});

function grandTotal9() {
    var total_avg9 = 0;
    $(".total9").each(function() {
        total_avg9 += Number($(this).val());
    });
    document.getElementById("weight9").value = isNaN(total_avg9) ?
        "0.00" :
        total_avg9.toFixed(2);
}

function totalUnits9() {
    var total_units = 0;

    $(".units9").each(function() {
        total_units += parseFloat($(this).val());
    });
    document.getElementById("totalUnits9").value = total_units;
    document.getElementById("totalUnit9").innerHTML = isNaN(total_units) ?
        "0" :
        total_units.toFixed(2);
}

function getGWA9() {
    var total_units = $("#totalUnits9").val();
    var weight = $("#weight9").val();
    var gwa = weight / total_units;

    document.getElementById("gwa9").value = isNaN(gwa) ?
        "0.00" :
        gwa.toFixed(2);
}
//refresh page
function refreshPage() {
        location.reload();
    }
//Checkbox for multiple delete in yajra Datatable
$(document).on('click', 'input[name="main_checkbox"]', function() {
    if (this.checked) {
        $('input[name="form_checkbox"]').each(function() {
            this.checked = true;
        });
    } else {
        $('input[name="form_checkbox"]').each(function() {
            this.checked = false;
        });
    }
    togglebulk_delete();
});
$(document).on('change', 'input[name="form_checkbox"]', function() {

    if ($('input[name="form_checkbox"]').length == $(
            'input[name="form_checkbox"]:checked').length) {
        $('input[name="main_checkbox"]').prop('checked', true);
    } else {
        $('input[name="main_checkbox"]').prop('checked', false);
    }
    togglebulk_delete();
});
function togglebulk_delete() {
    if ($('input[name="form_checkbox"]:checked').length > 0) {
        $('button#bulk_delete').text('Archive (' + $('input[name="form_checkbox"]:checked').length +
                ')')
            .removeClass('d-none');
    } else {
        $('button#bulk_delete').addClass('d-none');
    }
}
//checkbox for multiple delete
$(document).on('click', 'input[class="checkAll"]', function() {
    if (this.checked) {
        $('input[class="user-checkboxes"]').each(function() {
            this.checked = true;
        });
    } else {
        $('input[class="user-checkboxes"]').each(function() {
            this.checked = false;
        });
    }
    togglebulk_delete_plain_table();
});
$(document).on('change', 'input[class="user-checkboxes"]', function() {

    if ($('input[class="user-checkboxes"]').length == $(
            'input[class="user-checkboxes"]:checked').length) {
        $('input[class="checkAll"]').prop('checked', true);
    } else {
        $('input[class="checkAll"]').prop('checked', false);
    }
    togglebulk_delete_plain_table();
});
function togglebulk_delete_plain_table() {
    if ($('input[class="user-checkboxes"]:checked').length > 0) {
        $('button#bulk_delete').text('Delete (' + $('input[class="user-checkboxes"]:checked').length +
                ')')
            .removeClass('d-none');
    } else {
        $('button#bulk_delete').addClass('d-none');
    }
}
//archive multiple data without yajra
$(document).on('click', 'input[class="checkAllArchive"]', function() {
    if (this.checked) {
        $('input[class="user-checkboxes-archive"]').each(function() {
            this.checked = true;
        });
    } else {
        $('input[class="user-checkboxes-archive"]').each(function() {
            this.checked = false;
        });
    }
    togglebulk_delete_plain_table_archive();
});
$(document).on('change', 'input[class="user-checkboxes-archive"]', function() {

    if ($('input[class="user-checkboxes-archive"]').length == $(
            'input[class="user-checkboxes-archive"]:checked').length) {
        $('input[class="checkAllArchive"]').prop('checked', true);
    } else {
        $('input[class="checkAllArchive"]').prop('checked', false);
    }
    togglebulk_delete_plain_table_archive();
});
function togglebulk_delete_plain_table_archive() {
    if ($('input[class="user-checkboxes-archive"]:checked').length > 0) {
        $('button#bulk_delete').text('Archive (' + $('input[class="user-checkboxes-archive"]:checked').length +
                ')')
            .removeClass('d-none');
    } else {
        $('button#bulk_delete').addClass('d-none');
    }
}
//Hide and Show summer using checkbox
$(document).ready(function() {
    handleStatusChanged();
});

function handleStatusChanged() {
    $('#chkSummer').on('change', function() {
        toggleStatus();
    });
}

function toggleStatus() {
    if ($('#chkSummer').is(':checked')) {
        $('#dvSummer :input').removeAttr('disabled');
    } else {
        $('#dvSummer :input').attr('disabled', true);
    }
}
$(function() {
    $("#chkSummer").click(function() {
        if ($(this).is(":checked")) {
            $("#dvSummer").show();
        } else {
            $("#dvSummer").hide();
        }
    });
});
//Admin Print
$(function() {
    //deans list filter by year
    $(".view-accepted").click(function () {
        var course_id = document.getElementById("course_id").value;
        var select = document.getElementById("year");
        var year = select.options[select.selectedIndex].value;
        var link =
            baseURL + "/admin/deans-list-award/" +
            course_id +
            "/" +
            year +
            "/view-approved-students-pdf";
        window.open(link, "_blank");
    });

    $(".view-rejected").click(function () {
        var course_id = document.getElementById("course_id").value;
        var select = document.getElementById("year");
        var year = select.options[select.selectedIndex].value;
        var link = baseURL + "/admin/deans-list-award/" +
            course_id +
            "/" +
            year +
            "/view-rejected-students-pdf";
        window.open(link, "_blank");
    });

    //president list filter by year
    $(".view-accepted-pl").click(function () {
        var course_id = document.getElementById("course_id").value;
        var select = document.getElementById("year_pl");
        var year = select.options[select.selectedIndex].value;
        var link =
            baseURL + "/admin/presidents-list-award/" +
            course_id +
            "/" +
            year +
            "/view-approved-students-pdf";
        window.open(link, "_blank");
    });

    $(".view-rejected-pl").click(function () {
        var course_id = document.getElementById("course_id").value;
        var select = document.getElementById("year_pl");
        var year = select.options[select.selectedIndex].value;
        var link =
            baseURL + "/admin/presidents-list-award/" +
            course_id +
            "/" +
            year +
            "/view-rejected-students-pdf";
        window.open(link, "_blank");
    });
    //academic excellence list filter by year
    $(".view-accepted-ae").click(function () {
        var course_id = document.getElementById("course_id").value;
        var select = document.getElementById("year_ae");
        var year = select.options[select.selectedIndex].value;
        var link =
            baseURL + "/admin/academic-excellence-award/" +
            course_id +
            "/" +
            year +
            "/view-approved-students-pdf";
        window.open(link, "_blank");
    });

    $(".view-rejected-ae").click(function () {
        var course_id = document.getElementById("course_id").value;
        var select = document.getElementById("year_ae");
        var year = select.options[select.selectedIndex].value;
        var link =
            baseURL + "/admin/academic-excellence-award/" +
            course_id +
            "/" +
            year +
            "/view-rejected-students-pdf";
        window.open(link, "_blank");
    });
});
//checkbox to sending email uncheck
$(function() {
    $('.checkAll').click(function() {
        if (this.checked) {
            $(".email-checkboxes").prop("checked", true);
        } else {
            $(".email-checkboxes").prop("checked", false);
        }
    });

    $(".email-checkboxes").click(function() {
        var numberOfCheckboxes = $(".email-checkboxes").length;
        var numberOfCheckboxesChecked = $('.email-checkboxes:checked').length;
        if (numberOfCheckboxes == numberOfCheckboxesChecked) {
            $(".checkAll").prop("checked", true);
        } else {
            $(".checkAll").prop("checked", false);
        }
    });
});

//date time picker format and calendar radio button
$(function() {
    $('#allDay,#startLongDay,#endLongDay').datetimepicker({
        format: 'L',
        minDate: new Date()
    });
    $('#startTimeDuration,#endTimeDuration,#startAllDay').datetimepicker({
        minDate: new Date(),
        icons: {
            time: "fa-solid fa-clock"
        }
    });
});

$(function() {
    $("input[name='eventRadio']").click(function() {
        $('#all-value').val('');
        $('#longstart-value').val('');
        $('#longend-value').val('');
        $('#allid-value').val('');
        $('#startduration_value').val('');
        $('#endduration_value').val('');
        if ($("#inlineRadio1").is(":checked")) {
            $("#all").show();
        } else {
            $("#all").hide();
        }
        if ($("#inlineRadio2").is(":checked")) {
            $("#long").show();
        } else {
            $("#long").hide();
        }
        if ($("#inlineRadio3").is(":checked")) {
            $("#alld").show();
        } else {
            $("#alld").hide();
        }
        if ($("#inlineRadio4").is(":checked")) {
            $("#duration").show();
        } else {
            $("#duration").hide();
        }
    });
});

//data privacy policy
// get the checkbox elements
const checkbox1 = document.getElementById("termsCheckbox1");
const checkbox2 = document.getElementById("termsCheckbox2");

// get the submit button element
const submitButton = document.getElementById("form_submit");

// disable the submit button initially
submitButton.disabled = true;

// add an event listener to the checkboxes
checkbox1.addEventListener("change", updateButtonState);
checkbox2.addEventListener("change", updateButtonState);

function updateButtonState() {
  // check if both checkboxes are checked
  if (checkbox1.checked && checkbox2.checked) {
    // enable the submit button
    submitButton.disabled = false;
  } else {
    // disable the submit button
    submitButton.disabled = true;
  }
}


//redirect
$("#redirect-to-new-page").click(function(e) {
    e.preventDefault();
    var link = $(this).attr("href");
    if (!$("#exampleModal").hasClass("show")) {
        window.location.href = link;
    }
});


