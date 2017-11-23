<html>
<head>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<header class="header" style="margin-top: 10%"></header>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="chat-box">
                @foreach($chat as $chat)
                    <div class="alert alert-info">{{$chat->msg}}</div>
                @endforeach

            </div>
            <input class="form-control send" placeholder="Messages">
        </div>
    </div>
</div>



<script src="{{asset('js/jQuery/jquery.min.js')}}"></script>
<script>
    $(document).on('keydown','.send',function (e) {
        var msg = $(this).val();
        var element = $(this);
        if (!msg== '' &&e.keyCode == 13 && !e.shiftKey)
        {
            $.ajax({
               url: 'chat',
                type: 'post',
                data:{
                   _token:'{{csrf_token()}}',
                    msg:msg,
                }
            });

            element.val('');
        }
    });
        $(document).ready(function () {
           livechat();
        });
    function livechat()
    {
        $.ajax({
           url: '/chat/ajax',
            data: {
               _token: '{{csrf_token()}}',
//                msg:msg
            },  
            success:function (data)
            {
                $('.chat-box').append('<div class="alert alert-info">'+ data['msg'] +'</div>');
                setTimeout(livechat,1000);
            },
            error:function ()
            {
                setTimeout(livechat,5000);
            }

        });
    }
</script>
</body>
</html>