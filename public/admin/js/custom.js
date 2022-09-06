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
