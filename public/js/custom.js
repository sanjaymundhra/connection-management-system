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
                    $this.addClass('request-sent');
                    $this.text('Request sent!');
                }                   
            },
            error:function(error) {
                console.log(error);
            }
        });
    });

    //accept request
    $('.request-recieved').on('click', function(){
        user_one = $(this).attr('user-id');
        $this = $(this);
        $.ajax({
            type:'POST',
            url:"/friend_request/accept",
            data:{
                user_one:user_one
            },
            success:function(response) {
                if(response=='ok'){
                    $this.removeClass('request-recieved');
                    $this.addClass('request-accepted');
                    $this.text('Your Friend');
                }                   
            },
            error:function(error) {
                console.log(error);
            }
        });
    });

    //block a user
    $('.block').on('click', function(){
        user_two = $(this).attr('user-id');
        $this = $(this);
        $.ajax({
            type:'POST',
            url:"/friend_request/block",
            data:{
                user_two:user_two
            },
            success:function(response) {
                if(response=='ok'){
                    $this.removeClass('block');
                    $this.addClass('blocked');
                    $this.text('Blocked');
                }                   
            },
            error:function(error) {
                console.log(error);
            }
        });
    });
});