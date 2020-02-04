$(document).on("click", ".comment-btn", function(e) {

    let comment = $(e.currentTarget).siblings(".comment").val();
    
    if(comment.trim() == "") {
        alert("공백을 입력할수 없습니다.");
        $("#comment").val("");
        return;
    }
    let board_id = $(e.currentTarget).data("id");
    let user_name = $(e.currentTarget).data("username");
    $.ajax({
        url: '/comment',
        method: 'post',
        data: {comment : comment, board_id : board_id},
        success: function(){
            $(".comment-box").append(`<div class="comment-form">
            <p class="comment-writer">${user_name}</p>
            <p class="comment-text">${comment}</p>
        </div>`);
        }
        
    });
    $("#comment").val("");
});