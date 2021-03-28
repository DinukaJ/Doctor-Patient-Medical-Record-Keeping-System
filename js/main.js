       
function open(modal) {
    //modal.style.display = "block";
    $(modal).slideDown();
}
function close(modal){
    // modal.style.display = "none";
    $(modal).slideUp();
} 



$("#menuBtn").click(function(){
    $(".sidePanel.c-12").css("left","0px");
    $(".sidePanelCont").css("left","0px");
});

$("#sideNavClose").click(function(){
    $(".sidePanelCont").css("left","-800px");
    setTimeout(function(){
        $(".sidePanel.c-12").css("left","-800px");
    },400);
});
