$(function(){
    var proceed = false;
    $("#username").blur(function (e) {
        proceed = false;
        var username = e.currentTarget.value;
        if (username.length >= 3 && username.length <= 20) {
            if (/^[-._a-zA-Z0-9]+$/.test(username)) {
                $.post("Service/loginregistration.php", {
                    action: "checkusername",
                    username: $("#username").val()
                }, function (available) {
                    if (available) {
                        $("#username").popover({
                            content: "Username Non Esistente",
                            placement: "bottom"
                        }).popover("show");
                    } else {
                        proceed = true;
                    }
                }, "json");
            } else {
                $("#username").popover({
                    title: "Caratteri non consentiti",
                    content: "Sono consentiti solo caratteri alfanumerici e i caratteri '-' '_' '.'",
                    placement: "bottom"
                }).popover("show");
            }
        } else {
            $("#username").popover({
                content: "Username troppo corto",
                placement: "bottom"
            }).popover("show");
        }
    });
    $("#username").focus(function () {
        $("#username").popover("destroy");
    });
    
    $(document.forms[0]).submit(function(e) {
        e.preventDefault();
        if(!proceed) return false;
        $.post("Service/administration.php", {
            action: "changeRole",
            username: $("#username").val(),
            role: parseInt($("#role").val())
        }, function(success) {
            if(success)
                $(document.body).append("<div>Ruolo cambiato correttamente</div>");
            else
                $(document.body).append("<div>Erore nel cambio del ruolo</div>");
        }, "json");
    });
});

