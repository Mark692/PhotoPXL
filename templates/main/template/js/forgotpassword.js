$(function () {
    $("#username").blur(function (e) {
        var username = e.currentTarget.value;
        if (username.length >= 3 && username.length <= 20) {
            if (/^[-._a-zA-Z0-9]+$/.test(username)) {
                $.post("Service/loginregistration.php", {
                    action: "checkusername",
                    username: $("#username").val()
                }, function (available) {
                    if (!available) {
                        $("#username").popover({
                            content: "Username Non Disponibile",
                            placement: "left"
                        }).popover("show");
                    }
                }, "json");
            } else {
                $("#username").popover({
                    title: "Caratteri non consentiti",
                    content: "Sono consentiti solo caratteri alfanumerici e i caratteri '-' '_' '.'",
                    placement: "left"
                }).popover("show");
            }
        } else {
            $("#username").popover({
                content: "Username troppo corto",
                placement: "left"
            }).popover("show");
        }
    });
    $("#username").focus(function () {
        $("#username").popover("destroy");
    });
});