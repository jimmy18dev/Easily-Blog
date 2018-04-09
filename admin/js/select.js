$("#autofill").keydown(function(e) {
    if (e.keyCode == 13) { // enter
        if ($(".services").is(":visible")) {
            selectOption();
        } else {
            $(".services").show();
        }
        menuOpen = !menuOpen;
    }
    if (e.keyCode == 38) { // up
        var selected = $(".selected");
        $(".services li").removeClass("selected");
        if (selected.prev().length == 0) {
            selected.siblings().last().addClass("selected");
        } else {
            selected.prev().addClass("selected");
        }
    }
    if (e.keyCode == 40) { // down
        var selected = $(".selected");
        $(".services li").removeClass("selected");
        if (selected.next().length == 0) {
            selected.siblings().first().addClass("selected");
        } else {
            selected.next().addClass("selected");
        }
    }
});

$(".services li").mouseover(function() {
    $(".services li").removeClass("selected");
    $(this).addClass("selected");
}).click(function() {
    selectOption();
});

function selectOption() {
    $("#autofill").val($(".selected a").text());
    $(".services").hide();
}