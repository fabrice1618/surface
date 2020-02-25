$(function () {
    new PerfectScrollbar($('.sidebar-content'), {
        wheelSpeed: 10,
        wheelPropagation: !0,
        minScrollbarLength: 5
    });
});