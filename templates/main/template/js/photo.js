$(function () {
    $("#like").click(function () {
        var id = $(this).prev().val();
        $.post("Service/photo.php", {
            action: "likeUnlike",
            photoId: id
        }, function (addRemove) {
            if (addRemove === 1) {
                $("#like").text("Non mi piace");
            } else if (addRemove === -1) {
                $("#like").text("Mi Piace");
            }
            var numLikes = parseInt($("#likes").text());
            numLikes += addRemove;
            $("#likes").text(numLikes);
        }, "json");
    });

    var commentHTML = '<div class="col-md-6 col-md-offset-3"><div class="well">' +
            '<p class="text-success">#user</p><textarea disabled>#text</textarea>' +
            '<div class="form-group"><input type="hidden" name="cid" value="#id"/>' +
            '<button type="button" class="btn btn-success">Modifica</button>' +
            '<button type="button" class="btn btn-success">Elimina</button></div>' +
            '</div></div>';

    $("#comment-send").click(function () {
        var text = $("#comment-body").val();
        if (text !== "") {
            var id = $(this).prev().val();
            $.post("Service/photo.php", {
                action: "comment",
                photoId: id,
                text: text
            }, function (success) {
                if (success) {
                    var comment = commentHTML;
                    comment = comment.replace(/#user/g, $("#profile").text());
                    comment = comment.replace(/#id/g, success);
                    comment = comment.replace(/#text/g, text);
                    $("#comments").append(comment);
                }
            });
        }
    });

    $(".edit").click(function () {
        var id = $(this).prev().val();
        $("#c" + id + " textarea").attr("disabled", false);
        $(this).css("display", "none");
        $(this).next().css("display", "inline-block");
    });

    $(".send").click(function () {
        var commentId = $(this).prev().prev().val();
        var text = $("#c" + commentId + " textarea").val();
        if (text !== "") {
            var photoId = location.href.substr(location.href.lastIndexOf("id") + 3, location.href.length); // fetched from address bar
            $.post("Service/photo.php", {
                action: "editComment",
                photoId: photoId,
                commentId: commentId,
                text: text
            }, function (success) {
                if (success) {
                    $("#c" + commentId + " textarea").text(text).attr("disabled", true);
                    $("#c" + commentId + " .edit").css("display", "inline-block");
                    $("#c" + commentId + " .send").css("display", "none");
                }
            }, "json");
        }
    });

    $(".delete").click(function () {
        var commentId = $(this).prev().prev().prev().val();
        $.post("Service/photo.php", {
            action: "deleteComment",
            commentId: commentId
        }, function(success) {
            if(success) {
                $("#c" + commentId).remove();
            }
        }, "json")
    });

    $("textarea").blur(function(e){
        var comment = $(this).val();
        if(comment.length < 1 || comment.length>2000){
            $(this).popover({
                content: "I commenti possono contenere da 1 a 2000 caratteri",
                placement: "top"
            }).popover("show");
        }
    });
    $("textarea").focus(function () {
        $(this).popover("destroy");
    });
});

