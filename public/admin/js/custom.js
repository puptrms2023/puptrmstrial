jQuery(function ($) {
    $(".js-phone").inputmask({
        mask: ["+639999999999", "8 999 999-99-99"],
        jitMasking: 3,
        showMaskOnHover: false,
        autoUnmask: true,
    });
});
