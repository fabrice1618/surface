$(function () {

    //refresh function
    $('#refresh').click(function () {
        $('table').bootstrapTable('refresh');
    });

    /*
    //resize functions
    $('.exp-block').click(function () {
        $(this).closest('.showhide').toggleClass('col-lg-12 col-xl-6 col-12');
        $('.exp-block').toggleClass('ik-chevron-right ik-chevron-left');
    });
    */

    //portlet functions
    $(".column").sortable({
        connectWith: ".column",
        handle: ".portlet-header",
        cancel: ".portlet-toggle, .input-search",
        placeholder: "portlet-placeholder ui-corner-all"
    });

    //resize with drop
    $("div.droptrue").sortable({
        connectWith: ".column"
    });

    $("div.dropfalse").sortable({
        connectWith: ".column",
        dropOnEmpty: true
    });

    $(".portlet-toggle").click(function () {
        var icon = $(this);
        icon.toggleClass("ik-minus ik-plus");
        icon.closest(".portlet").find(".portlet-content").toggle("slow");
        icon.closest(".portlet").find(".portlet-header").toggleClass("radius");
        $(this).closest('div').find('.input-search').fadeToggle();
    });
});