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
