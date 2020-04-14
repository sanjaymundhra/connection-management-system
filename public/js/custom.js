$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.send_friend_request').on('click', function(){
        user_two = $(this).attr('user-id');
        $this = $(this);
        $.ajax({
            type:'POST',
            url:"/friend_request/send",
            data:{
                user_two:user_two
            },
            success:function(response) {
                if(response=='ok'){
                    $this.removeClass('send_friend_request');
                    $this.text('Request sent!');
                }                   
            },
            error:function(error) {
                console.log(error);
            }
        });
    });
});