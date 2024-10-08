<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">

    <main role="main" class="container">
        <div
            class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif




            <div class="col-md-6">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                role="tab" aria-controls="v-pills-home" aria-selected="true">Freekassa</a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                                role="tab" aria-controls="v-pills-profile" aria-selected="false">Payeer</a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-messages"
                                role="tab" aria-controls="v-pills-messages" aria-selected="false">Webmoney</a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-m"
                                role="tab" aria-controls="v-pills-messages" aria-selected="false">Litekassa</a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-ms"
                                role="tab" aria-controls="v-pills-messages" aria-selected="false">Payok</a>    
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">

                                <h3> Пополнить через Freekassa </h3>
                                <form class="mt-4" action="/payment/freekassa_form" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input name="action" value="fk_go" class="main_input" type="hidden">
                                        <label for="exampleInputEmail1">Логин</label>
                                        <input class="form-control" name="name" placeholder="Логин"
                                            class="main_input" type="text" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="sum">Сумма</label>
                                        <input class="form-control" id="text" name="sum" placeholder="Сумма"
                                            class="main_input" type="number" value="25">
                                    </div>

                                    <?php if (Auth::check()) {
                                        echo '
                                                                                  <div class="form-group">
                                                                                  <label for="checkbox">Выбрать аккаунт</label><br>  
                                                                                <input type="checkbox" name="checkbox" value="" item_cat="' .
                                            Auth::check()->name .
                                            '"> Мой аккаунт
                                                                                  </div><br>';
                                    } ?>


                                    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
                                    <script>
                                        $(document).on('click', 'input[name="checkbox"]', function() {
                                                $('input[name="account"]').val(
                                                    $('input[name="checkbox"]:checked')
                                                    .map(function() {
                                                        return this.getAttribute('item_cat')

                                                    })

                                                    .get()
                                                );

                                            }


                                        );
                                    </script>

                                    <div class="col-md-4">Вы получите<br></div>
                                    <div class="col-md-5" id="result"> <i class="las la-gem"></i></div>
                                    <div class="col-md-3"><br></div>

                                    <br>





                                    <button type="submit" class="btn btn-slide btn-slide-info mt-4"
                                        class="dl_btn">Пополнить с Freekassa</button>

                                </form>



                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <h3> Пополнить через Payeer </h3>
                                <form class="mt-4" action="/payment/payeer_form" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input name="action" value="fk_go" class="main_input" type="hidden">
                                        <label for="exampleInputEmail1">Логин</label>
                                        <input class="form-control" name="name" placeholder="Логин"
                                            class="main_input" type="text" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="sum">Сумма</label>
                                        <input class="form-control" id="text1" name="sum"
                                            placeholder="Сумма" class="main_input" type="number" value="25">
                                    </div>

                                    <?php if (Auth::check()) {
                                        echo '
                                                                                  <div class="form-group">
                                                                                  <label for="checkbox">Выбрать аккаунт</label><br>  
                                                                                <input type="checkbox" name="checkbox" value="" item_cat="' .
                                            Auth::check()->name .
                                            '"> Мой аккаунт
                                                                                  </div><br>';
                                    } ?>


                                    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
                                    <script>
                                        $(document).on('click', 'input[name="checkbox"]', function() {
                                                $('input[name="account"]').val(
                                                    $('input[name="checkbox"]:checked')
                                                    .map(function() {
                                                        return this.getAttribute('item_cat')

                                                    })

                                                    .get()
                                                );

                                            }


                                        );
                                    </script>

                                    <div class="col-md-4">Вы получите<br></div>
                                    <div class="col-md-5" id="result1"> <i class="las la-gem"></i></div>
                                    <div class="col-md-3"><br></div>

                                    <br>





                                    <button type="submit" class="btn btn-slide btn-slide-info mt-4"
                                        class="dl_btn">Пополнить с Payeer</button>

                                </form>

                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                aria-labelledby="v-pills-messages-tab">
                                <h3> Пополнить через Webmoney </h3>
                                <form class="mt-4" action="/payment/webmoney_form" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input name="action" value="fk_go" class="main_input" type="hidden">
                                        <label for="exampleInputEmail1">Логин</label>
                                        <input class="form-control" name="name" placeholder="Логин"
                                            class="main_input" type="text" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="sum">Сумма</label>
                                        <input class="form-control" id="text" name="sum"
                                            placeholder="Сумма" class="main_input" type="number" value="25">
                                    </div>

                                    <?php if (Auth::check()) {
                                        echo '
                                                                                  <div class="form-group">
                                                                                  <label for="checkbox">Выбрать аккаунт</label><br>  
                                                                                <input type="checkbox" name="checkbox" value="" item_cat="' .
                                            Auth::check()->name .
                                            '"> Мой аккаунт
                                                                                  </div><br>';
                                    } ?>


                                    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
                                    <script>
                                        $(document).on('click', 'input[name="checkbox"]', function() {
                                                $('input[name="account"]').val(
                                                    $('input[name="checkbox"]:checked')
                                                    .map(function() {
                                                        return this.getAttribute('item_cat')

                                                    })

                                                    .get()
                                                );

                                            }


                                        );
                                    </script>

                                    <div class="col-md-4">Вы получите<br></div>
                                    <div class="col-md-5" id="result"> <i class="las la-gem"></i></div>
                                    <div class="col-md-3"><br></div>

                                    <br>





                                    <button type="submit" class="btn btn-slide btn-slide-info mt-4"
                                        class="dl_btn">Пополнить с Webmoney</button>

                                </form>






                            </div>

                        <div class="tab-pane fade" id="v-pills-m" role="tabpanel"
                                aria-labelledby="v-pills-messages-tab">
                                <h3> Пополнить через Litekassa </h3>
                                <form class="mt-4" action="/payment/litekassa_form" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input name="action" value="fk_go" class="main_input" type="hidden">
                                        <label for="exampleInputEmail1">Логин</label>
                                        <input class="form-control" name="name" placeholder="Логин"
                                            class="main_input" type="text" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="sum">Сумма</label>
                                        <input class="form-control" id="text" name="sum"
                                            placeholder="Сумма" class="main_input" type="number" value="25">
                                    </div>

                                    <?php if (Auth::check()) {
                                        echo '
                                                                                  <div class="form-group">
                                                                                  <label for="checkbox">Выбрать аккаунт</label><br>  
                                                                                <input type="checkbox" name="checkbox" value="" item_cat="' .
                                            Auth::check()->name .
                                            '"> Мой аккаунт
                                                                                  </div><br>';
                                    } ?>


                                    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
                                    <script>
                                        $(document).on('click', 'input[name="checkbox"]', function() {
                                                $('input[name="account"]').val(
                                                    $('input[name="checkbox"]:checked')
                                                    .map(function() {
                                                        return this.getAttribute('item_cat')

                                                    })

                                                    .get()
                                                );

                                            }


                                        );
                                    </script>

                                    <div class="col-md-4">Вы получите<br></div>
                                    <div class="col-md-5" id="result"> <i class="las la-gem"></i></div>
                                    <div class="col-md-3"><br></div>

                                    <br>





                                    <button type="submit" class="btn btn-slide btn-slide-info mt-4"
                                        class="dl_btn">Пополнить с Litekassa</button>

                                </form>








                            </div>


                            <div class="tab-pane fade" id="v-pills-ms" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab">
                            <h3> Пополнить через Payok </h3>
                            <form class="mt-4" action="/payment/payok_form" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input name="action" value="fk_go" class="main_input" type="hidden">
                                    <label for="exampleInputEmail1">Логин</label>
                                    <input class="form-control" name="name" placeholder="Логин"
                                        class="main_input" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label for="sum">Сумма</label>
                                    <input class="form-control" id="text" name="sum"
                                        placeholder="Сумма" class="main_input" type="number" value="25">
                                </div>

                                <?php if (Auth::check()) {
                                    echo '
                                                                              <div class="form-group">
                                                                              <label for="checkbox">Выбрать аккаунт</label><br>  
                                                                            <input type="checkbox" name="checkbox" value="" item_cat="' .
                                        Auth::check()->name .
                                        '"> Мой аккаунт
                                                                              </div><br>';
                                } ?>


                                <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
                                <script>
                                    $(document).on('click', 'input[name="checkbox"]', function() {
                                            $('input[name="account"]').val(
                                                $('input[name="checkbox"]:checked')
                                                .map(function() {
                                                    return this.getAttribute('item_cat')

                                                })

                                                .get()
                                            );

                                        }


                                    );
                                </script>

                                <div class="col-md-4">Вы получите<br></div>
                                <div class="col-md-5" id="result"> <i class="las la-gem"></i></div>
                                <div class="col-md-3"><br></div>

                                <br>





                                <button type="submit" class="btn btn-slide btn-slide-info mt-4"
                                    class="dl_btn">Пополнить с Payok</button>

                            </form>



                           




                        </div>




                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                aria-labelledby="v-pills-settings-tab">...</div>

                        </div>

                        



                    </div>
                </div>




            </div>
            <script>
                $('#text').bind('input', function() {

                    if ($(this).val() >= 500 && $(this).val() <= 999) {
                        $('#result').html($(this).val() * 1.05 + ' <i class="las la-gem"></i> (+5%)');
                    } else if ($(this).val() >= 1000 && $(this).val() <= 1999) {
                        $('#result').html($(this).val() * 1.10 + ' <i class="las la-gem"></i> (+10%)');
                    } else if ($(this).val() >= 2000 && $(this).val() <= 3499) {
                        $('#result').html($(this).val() * 1.15 + ' <i class="las la-gem"></i> (+15%)');
                    } else if ($(this).val() >= 3500 && $(this).val() <= 4999) {
                        $('#result').html($(this).val() * 1.20 + ' <i class="las la-gem"></i> (+20%)');
                    } else if ($(this).val() >= 5000 && $(this).val() <= 7499) {
                        $('#result').html($(this).val() * 1.25 + ' <i class="las la-gem"></i> (+25%)');
                    } else if ($(this).val() >= 7500 && $(this).val() <= 9999) {
                        $('#result').html($(this).val() * 1.30 + ' <i class="las la-gem"></i> (+30%)');
                    } else if ($(this).val() >= 10000 && $(this).val() <= 11999) {
                        $('#result').html($(this).val() * 1.35 + ' <i class="las la-gem"></i> (+35%)');
                    } else if ($(this).val() >= 12500 && $(this).val() <= 14999) {
                        $('#result').html($(this).val() * 1.40 + ' <i class="las la-gem"></i> (+40%)');
                    } else if ($(this).val() >= 15000 && $(this).val() <= 19999) {
                        $('#result').html($(this).val() * 1.50 + ' <i class="las la-gem"></i> (+50%)');
                    } else if ($(this).val() >= 20000 && $(this).val() <= 199999) {
                        $('#result').html($(this).val() * 1.50 + ' <i class="las la-gem"></i> (+50%)');
                    } else {
                        $('#result').html($(this).val() + ' <i class="las la-gem"></i>');
                    }


                });
            </script>
            <script>
                $('#text1').bind('input', function() {

                    if ($(this).val() >= 500 && $(this).val() <= 999) {
                        $('#result1').html($(this).val() * 1.05 + ' <i class="las la-gem"></i> (+5%)');
                    } else if ($(this).val() >= 1000 && $(this).val() <= 1999) {
                        $('#result1').html($(this).val() * 1.10 + ' <i class="las la-gem"></i> (+10%)');
                    } else if ($(this).val() >= 2000 && $(this).val() <= 3499) {
                        $('#result1').html($(this).val() * 1.15 + ' <i class="las la-gem"></i> (+15%)');
                    } else if ($(this).val() >= 3500 && $(this).val() <= 4999) {
                        $('#result1').html($(this).val() * 1.20 + ' <i class="las la-gem"></i> (+20%)');
                    } else if ($(this).val() >= 5000 && $(this).val() <= 7499) {
                        $('#result1').html($(this).val() * 1.25 + ' <i class="las la-gem"></i> (+25%)');
                    } else if ($(this).val() >= 7500 && $(this).val() <= 9999) {
                        $('#result1').html($(this).val() * 1.30 + ' <i class="las la-gem"></i> (+30%)');
                    } else if ($(this).val() >= 10000 && $(this).val() <= 11999) {
                        $('#result1').html($(this).val() * 1.35 + ' <i class="las la-gem"></i> (+35%)');
                    } else if ($(this).val() >= 12500 && $(this).val() <= 14999) {
                        $('#result1').html($(this).val() * 1.40 + ' <i class="las la-gem"></i> (+40%)');
                    } else if ($(this).val() >= 15000 && $(this).val() <= 19999) {
                        $('#result1').html($(this).val() * 1.50 + ' <i class="las la-gem"></i> (+50%)');
                    } else if ($(this).val() >= 20000 && $(this).val() <= 199999) {
                        $('#result1').html($(this).val() * 1.50 + ' <i class="las la-gem"></i> (+50%)');
                    } else {
                        $('#result1').html($(this).val() + ' <i class="las la-gem"></i>');
                    }


                });
            </script>
            <div class="col-md-6"></div>


    </main><!-- /.container -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>


    </div>
</body>

</html>
