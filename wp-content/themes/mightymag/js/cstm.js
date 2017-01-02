/**
 * Created by Adi Umbas Primadarma on 1/2/2017.
 */
$(document).ready(function() {
    $(".dropdownmenucustom").hover(function () {
        $("#vdropdown").css("color", "#ffa200");
        $(".subdropmenu").css("visibility","visible").show(400);
        $("#mgm-toolbar").css("overflow", "visible");
    }, function () {
        $(".subdropmenu").css("visibility","hidden");
    });

});