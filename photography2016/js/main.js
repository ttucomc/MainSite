$(function() {
    $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
            var e = $(this.hash);
            if (e = e.length ? e : $("[name=" + this.hash.slice(1) + "]"), e.length) return $("html, body").animate({
                scrollTop: e.offset().top
            }, 1e3), !1
        }
    })
});
var navDistance = $("nav").offset().top,
    $window = $(window),
    videoDistance = $("#landscape").offset().top,
    photoDistance = $("#portraiture").offset().top,
    multiDistance = $("#editorial").offset().top,
    audioDistance = $("#sports").offset().top;
    miscDistance = $("#miscellaneous").offset().top;
$window.scroll(function() {
    $window.scrollTop() >= navDistance ? $("#circle-nav").fadeIn("fast") : $("#circle-nav").fadeOut("fast"), $window.scrollTop() >= videoDistance && $window.scrollTop() + 200 < photoDistance && ($("#circle-nav a").removeClass("is-selected"), $("#circle-nav .first").addClass("is-selected")), $window.scrollTop() + 200 >= photoDistance && $window.scrollTop() + 200 < multiDistance && ($("#circle-nav a").removeClass("is-selected"), $("#circle-nav .second").addClass("is-selected")), $window.scrollTop() + 200 >= multiDistance && $window.scrollTop() + 200 < audioDistance && ($("#circle-nav a").removeClass("is-selected"), $("#circle-nav .third").addClass("is-selected")), $window.scrollTop() + 200 >= audioDistance && $window.scrollTop() + 200 < miscDistance && ($("#circle-nav a").removeClass("is-selected"), $("#circle-nav .fourth").addClass("is-selected")), $window.scrollTop() + 200 >= miscDistance && ($("#circle-nav a").removeClass("is-selected"), $("#circle-nav .fifth").addClass("is-selected"))
});
