<!DOCTYPE html>


<html lang="en">


@include('layouts.includes.head')




<body class="no-skin" style="font-family: 'Fira Sans', sans-serif;">

    @include('partials._header')


    <div class="main-container ace-save-state" id="main-container">



        <!-- sidebar -->

    @include('partials._sidebar')







        <!-- main content -->
        <div class="main-content">

            <div class="main-content-inner" style="background: #f2f2f2">

                <div class="page-content" style="background: transparent; padding-bottom: 0;">


                    <!-- MAIN / DYNAMIC CONTENT -->
                    @yield('content', 'Default Content')





                </div>
            </div>
        </div>





        <!-- footer -->
        @include('partials._footer')
    </div>



    <!-- master file script -->
    @include('layouts.includes.master-file-script')







    <!-- delete form -->
    <form action="" id="deleteItemForm" method="POST">
        @csrf @method("DELETE")
    </form>


    <!-- Notification alert -->
{{--     @include('partials._payment_notification')--}}

</body>

</html>
