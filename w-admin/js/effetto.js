$(document).ready(function () {

$(".sliding-element a").mouseover(function () {
$(this).stop().animate({ marginLeft: "20px" }, 500 );
});

$(".sliding-element a").mouseout(function () {
$(this).stop().animate({ marginLeft: "0px" }, 500 );
});

$(".sliding-element1 a").mouseover(function () {
$(this).stop().animate({ marginLeft: "20px" }, 500 );
});

$(".sliding-element1 a").mouseout(function () {
$(this).stop().animate({ marginLeft: "0px" }, 500 );
});

});