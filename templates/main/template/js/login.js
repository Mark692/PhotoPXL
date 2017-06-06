$(function() {
    $("#login").click(function(){
        $.post("Service/loginregistration.php", 
            { action:"requirenonce" },
            function(data){
                $("#nonce").val(data);
            });
        

    });
    
});