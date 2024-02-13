<!DOCTYPE html>
<html>

<head>
    <title>Smart-QR Code Product</title>
    <link rel="icon" href="{{ $fav_icon ?? 'icon.png' }}" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
          integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110599322-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-110599322-1');
    </script>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            background: whitesmoke;
        }


        .verification-code {
            max-width: 300px;
            position: relative;
            margin:50px auto;
            text-align:center;
        }
        .control-label{
            display:block;
            margin:40px auto;
            font-weight:900;
        }
        .verification-code--inputs input[type=text] {
            border: 2px solid #e1e1e1;
            width: 46px;
            height: 46px;
            padding: 10px;
            text-align: center;
            display: inline-block;
            box-sizing:border-box;
        }

        form input{
            display:inline-block;
            width:50px;
            height:50px;
            text-align:center;
        }

        .user_card {
            height: 450px;
            width: 350px;
            margin-top: auto;
            margin-bottom: auto;
            background: #e7e9ff;
            position: relative;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 10px;
            border: 1px solid rgb(212, 196, 196);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 5px;

        }

        .brand_logo_container {
            position: absolute;
            height: 170px;
            width: 170px;
            top: -75px;
            border-radius: 50%;
            /* background: url(images/pattern.jpg) #DFE0E2; */
            background: #fff;
            padding: 10px;
            text-align: center;
        }

        .brand_logo {
            margin-left: 4px;
            height: 150px;
            width: 150px;
            /* border-radius: 50%; */
            border: 0px solid white;
        }

        .form_container {
            margin-top: 100px;
        }

        .login_btn {
            width: 100%;
            background: #1F3075 !important;
            color: white !important;
            font-size: 18px;
            font-weight: bold;
            font-family: 'Sansita Swashed', cursive;
            text-shadow: 1px 1px rgb(71, 70, 70);
        }

        .login_btn:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .login_container {
            padding: 0 2rem;
        }

        .input-group-text {
            background: #1F3075 !important;
            color: white !important;
            border: 0 !important;
            border-radius: 0.25rem 0 0 0.25rem !important;
            font-weight: 800;
            text-shadow: 1px 1px rgb(71, 70, 70);

        }

        .input_user,
        .input_pass:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #1F3075 !important;
        }

    </style>
</head>
<!--Coded with love by Mutiullah Samim-->

<body>
<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container" style="background: #1F3075">
                    <img src="{{ asset('assets/images/gulf_logo.png') }}" class="brand_logo" alt="Logo">
                </div>
            </div>
            <div class="d-flex justify-content-center form_container">
                <form action="{{ route('verify') }}" method="POST">
                    @csrf
                    @if (\Session::has('message'))
                        <div class="alert alert-danger" style="padding: 6px;margin: 0px;">
                            {!! \Session::get('message') !!}
                        </div>
                    @endif
                    <strong>Please check your mail</strong><br>
                    <div class="verification-code">
                        <label class="control-label">Verification Code</label>
                        <div class="verification-code--inputs">
                            <input type="text" maxlength="1" />
                            <input type="text" maxlength="1" />
                            <input type="text" maxlength="1" />
                            <input type="text" maxlength="1" />
                        </div>
                        <input type="hidden" id="verificationCode" name="code"/>
                        <input type="hidden" name="id" value="{{ $userInfo->id }}">
                    </div>
{{--                    <div class="input-group mb-3">--}}
{{--                        <div class="input-group-append">--}}
{{--                            <span class="input-group-text"><i class="fas fa-code"></i></span>--}}
{{--                        </div>--}}
{{--                        <input type="number" name="code" class="form-control input_user"--}}
{{--                               placeholder="Enter Code" required>--}}
{{--                        <input type="hidden" name="id" value="{{ $userInfo->id }}">--}}
{{--                    </div>--}}
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="submit" class="btn login_btn">Verify</button>
                    </div>
                </form>
            </div>
            <div>
                <hr />
                <p style="color: blueviolet; text-align:center;">
                    <strong> Develop By: Smart Software Ltd.</strong>
                </p>
            </div>
        </div>
    </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function onlyNumber(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }


    //Code Verification
    var verificationCode = [];
    $(".verification-code input[type=text]").keyup(function (e) {

        // Get Input for Hidden Field
        $(".verification-code input[type=text]").each(function (i) {
            verificationCode[i] = $(".verification-code input[type=text]")[i].value;
            $('#verificationCode').val(Number(verificationCode.join('')));
            //console.log( $('#verificationCode').val() );
        });

        //console.log(event.key, event.which);

        if ($(this).val() > 0) {
            if (event.key == 1 || event.key == 2 || event.key == 3 || event.key == 4 || event.key == 5 || event.key == 6 || event.key == 7 || event.key == 8 || event.key == 9 || event.key == 0) {
                $(this).next().focus();
            }
        }else {
            if(event.key == 'Backspace'){
                $(this).prev().focus();
            }
        }

    }); // keyup

    $('.verification-code input').on("paste",function(event,pastedValue){
        console.log(event)
        $('#txt').val($content)
        console.log($content)
        //console.log(values)
    });

    // $editor.on('paste, keydown', function() {
    //     var $self = $(this);
    //     setTimeout(function(){
    //         var $content = $self.html();
    //         $clipboard.val($content);
    //     },100);
    // });

</script>



</body>

</html>
