$(function(){
    $("select").select2({
        placeholder: "Categoria"
    });
    $("#title").blur(function () {
        var title = $(this).val();
        if (title.length < 3 || title.length > 30) {
            $(this).popover({
                content: "Lunghezza titolo non valida",
                placement: "bottom"
            }).popover("show");
        }
    });
    
    $("#title").focus(function() {
        $(this).popover("destroy");
    });
    
    $("#description").blur(function() {
       var description = $(this).val();
       if(description.length>500){
           $(this).popover({
               content: "Descrizione troppo lunga",
               placement: "bottom"
           }).popover("show");
       }
    });
    $("#description").focus(function(){
        $(this).popover("destroy");
    });
})

