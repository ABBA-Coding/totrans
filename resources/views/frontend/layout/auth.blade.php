<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta
        name="viewport"
        content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=6.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <title>TOTRANS </title>

    <!-- seo -->
    <meta name="title" content="TOTRANS ">
    <meta name="description"
          content="TOTRANS DESCRIPTION">
    <meta name="author" content="totrans.uz">
    <meta property="og:title" content="TOTRANS ">
    <meta property="og:description"
          content="TOTRANS DESCRIPTION">
    <meta data-rh="true" property="og:image" content="/frontend/images/main.png">
    <meta property="og:image" content="/frontend/images/main.png">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <meta property="og:image:secure_url" content="/frontend/images/main.png">
    <meta property="og:type" content="article">
    <meta name="author" content="totrans.uz">
    <meta property="og:url" content="https://totrans.uz/">
    <meta property="og:site_name" content="totrans.uz">
    <meta property="twitter:title" content="TOTRANS ">
    <meta property="twitter:url" content="https://totrans.uz">
    <meta property="twitter:description"
          content="TOTRANS DESCRIPTION">
    <meta property="twitter:image" content="/frontend/images/main.png">
    <meta data-rh="true" property="al:android:app_name" content="Medium">
    <meta name="telegram:channel" content="@Mr_Xasanovich">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@totrans.uz">
    <meta name="twitter:creator" content="@totrans.uz">
    <link rel="icon" type="image/ico" href="/frontend/favicon.svg" sizes="32x32">

    <link rel="stylesheet" href="/frontend/styles/vendor.css">
    <link rel="stylesheet" href="/frontend/styles/main.css">
    <!-- dev_css -->
    <link rel="stylesheet" href="/frontend/styles/custom.css">
</head>
<body>


<div class="page-wrapper">
    <div class="page-content">
        @yield('section')
    </div>
    @include('frontend.layout.footer')
</div>


<script src="/frontend/scripts/jQuery-3.4.1.min.js"></script>
<script src="/frontend/scripts/vendor.min.js"></script>
<script src="/frontend/scripts/main.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if (session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '@lang('static.error')',
            text: "{{ session()->get('error') }}",
            showConfirmButton: false,
            timer: 3000
        })
    </script>
@endif

@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <script>
            Swal.fire({
                icon: 'error',
                title: '@lang('static.error')',
                text: '{!! $error !!}',
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @endforeach
@endif

<script>
    $('input[data-field-type="phone"]').inputmask("99 999 99 99");  //static mask
</script>

</body>
</html>
