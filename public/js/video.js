
$(document).ready(function(){
    //$("#commentsForm").submit(function(e){
    //    e.preventDefault();
    //    $.post('/comments', {
    //        _token: $('input[name=_token]').val(),
    //        comment: $('#comment').val(),
    //        video_id: $('#video_id').val()
    //    }, function(data){
    //        console.log(data);
    //        $('#commentsSection').prepend("<li>" +
    //            "<span> "+data.user.name+" | "+data.created_at+"</span> " +
    //            "<p>"+data.comment+"</p>" +
    //            "</li>");
    //        $('#comment').val('');
    //    });
    //});

    $("#addFavourite").click(function(event){
        event.preventDefault();
        $.ajax({
            url:'/api/videos/favourite',
            method:'post',
            data: {
                _token: $('input[name=_token]').val(),
                video_id: $('#video_id').val()
            }
        }).done(function(data){
            $count = parseInt($("#video_count").html());
            if(data == 1) {
                $('.fa-heart').addClass('fa-red-heart animated shake');
                $('#video_count').html($count+1);
            } else {
                $('.fa-heart').removeClass('fa-red-heart animated shake');
                $('#video_count').html($count-1);
            }

        });

        return false;
    });
});