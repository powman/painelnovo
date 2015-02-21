


//TOOLTIP AND HOVERS

// tooltip demo
$('.tooltip-demo').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
});

// popover demo
$("[data-toggle=popover]")
    .popover();

//END TOOLTIP AND HOVERS


// Desabilit o # para o top
$("a[href=#]").click(function(event){
    event.preventDefault();
}); 