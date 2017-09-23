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

    var commentHTML = '<div id="c#id" class="col-md-6 col-md-offset-3"><div class="well">' +
            '<p class="text-success">#user</p><textarea disabled>#text</textarea>' +
            '<div class="form-group"><input type="hidden" name="cid" value="#id"/>' +
            '<button type="button" class="btn btn-success edit">Modifica</button>' +
            '<button type="submit" class="send btn btn-success">Invia</button>' +
            '<button type="button" class="btn btn-success delete">Elimina</button></div>' +
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
                    $("#comment-body").val("");
                    var comment = commentHTML;
                    comment = comment.replace(/#user/g, $("#profile").text());
                    comment = comment.replace(/#id/g, success);
                    comment = comment.replace(/#text/g, text);
                    var commentBody = $(comment);
                    commentBody.find(".edit").click(edit);
                    commentBody.find(".send").click(send);
                    commentBody.find(".delete").click(del);
                    $("#comments").append(commentBody);
                }
            });
        }
    });

    $(".edit").click(edit);

    $(".send").click(send);

    $(".delete").click(del);

    $("textarea").blur(function () {
        var comment = $(this).val();
        if (comment.length < 1 || comment.length > 2000) {
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

var edit = function (e) {
    var id = $(e.currentTarget).prev().val();
    $("#c" + id + " textarea").attr("disabled", false);
    $(e.currentTarget).css("display", "none");
    $(e.currentTarget).next().css("display", "inline-block");
};

var send = function (e) {
    var commentId = $(e.currentTarget).prev().prev().val();
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
};

var del = function (e) {
    var commentId = $(e.currentTarget).prev().prev().prev().val();
    $.post("Service/photo.php", {
        action: "deleteComment",
        commentId: commentId
    }, function (success) {
        if (success) {
            $("#c" + commentId).remove();
        }
    }, "json");
}
;