$(document).ready(function(){
    $("#commentsForm").submit(function(e){
        e.preventDefault();
        $.post('/comments', {
            _token: $('input[name=_token]').val(),
            comment: $('#comment').val(),
            video_id: $('#video_id').val()
        }, function(data){
            $('#commentsSection').prepend("<li>" +
                "<span> "+data.user.name+" | "+data.created_at+"</span> " +
                "<p>"+data.comment+"</p>" +
                "</li>");
            $('#comment').val('');
        });
    });

});