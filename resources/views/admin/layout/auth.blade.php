<!DOCTYPE html>
<html lang="en">

<head>
    <title>Панель управление | TOTRANS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon icon -->
    <link rel="icon" href="/admin-panel/favicon.svg" type="image/png">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="/admin-panel/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="/admin-panel/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="/admin-panel/css/style.css">
    <!-- custom css -->
    <link rel="stylesheet" href="/admin-panel/css/custom.css">
    <!-- alert css -->
    <link rel="stylesheet" href="/admin-panel/css/alert.css">

</head>

<body>

<div class="auth-wrapper">
    <div class="auth-content">
        <div class="auth-bg">
            <span class="r"></span>
            <span class="r s"></span>
            <span class="r s"></span>
            <span class="r"></span>
        </div>
        @yield('section')
    </div>
</div>

<!-- Required Js -->
<script src="/admin-panel/js/vendor-all.min.js"></script>
<script src="/admin-panel/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/admin-panel/js/TweenMax.min.js"></script>

@include('admin.parts.modal')
@include('admin.parts.alert')

</body>
</html>
