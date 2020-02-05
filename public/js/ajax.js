$(document).on("click", ".comment-btn", function(e) {
    let comment = $(e.currentTarget).siblings(".comment").val();
    let board_id = $(e.currentTarget).data("id");
    let user_name = $(e.currentTarget).data("username");

    if(comment.trim() == "") {
        alert("공백을 입력할수 없습니다.");
        $("#comment").val("");
        return;
    }
    $.ajax({
        url: '/comment',
        method: 'post',
        data: {comment : comment, board_id : board_id, name : user_name},
        success: function(){
            $(e.currentTarget).find("#comment").val("");
            $(e.currentTarget).parent().parent().find(".comment-box").append(`<div class="comment-form"><p class="comment-writer">${user_name}</p><p class="comment-text">${comment}</p></div>`);   
        }            
    });

});



$(document).on("click", ".like_btn", function (e) {
    let like = $(e.currentTarget).siblings(".like_count").val();
    console.log(like);
    let like_cnt = $(e.currentTarget).data("like");
    let board_id = $(e.currentTarget).data("id");
    $.ajax({ 
        url: '/like',
        method: 'post',
        data: {board_id : board_id},
        success: function() {
            $(e.currentTarget).siblings(".like_count").text(`좋아요 ${like_cnt + 1}개`);
        }
    })
});