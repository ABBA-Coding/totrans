<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta
        name="viewport"
        content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=6.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <title>TOTRANS</title>

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

@include('frontend.components.sign-up-modal')

<div class="page-wrapper">
    @include('frontend.layout.header')
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

@if (session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '@lang('static.success')',
            text: "{{ session()->get('success') }}",
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
    setTimeout(function () {
        $('.preloader').fadeOut(500);
    }, 1000)
</script>

<script>
    let body = $('body');
    let tabAjax = $('#tabAjax');
    let formData = $('#formData');
    let toTab = $('#toTab');
    let calculatorForm = $('form[name="calculatorTab"]');

    let disabled = false;


    calculatorForm.submit(function (e) {
        e.preventDefault();
        let method = $(this).attr('method');
        let action = $(this).attr('action');
        let form = $(this);
        let form_data = form.serializeArray();

        tabAjax.addClass('loading');

        if (!disabled) {
            disabled = true;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action,
                method: method,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.application) {
                        form.trigger("reset");

                        Swal.fire({
                            icon: 'success',
                            title: '@lang('static.success')',
                            text: '@lang('static.success_text')',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        $('#application-modal').removeClass('show').delay(500).addClass('d-none');
                    }
                    if (data.success) {
                        tabAjax.empty();
                        tabAjax.html(data.view);
                        let selects = document.querySelectorAll(".select2_cus");
                        selects.forEach((select) => {
                            $(select).select2({
                                dropdownParent: select.parentNode,
                                width: "100%",
                            });
                        });

                        tabLinks.removeClass('active');
                        tabList.find("a[data-tab='"+toTab.val()+"']").addClass('active');
                    }
                },
                error: function(request) {
                    if (request.status === 422) {
                        for (const [key, value] of Object.entries(request.responseJSON.errors)) {
                            $('[name="'+key+'"]').addClass('validation-error').attr('data-error', value)
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '@lang('static.error')',
                            text: 'Заполните все поля',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                },
                complete: function () {
                    disabled = false;
                    setTimeout(function () {
                        tabAjax.removeClass('loading');
                    }, 500)
                }
            })
        }
    });

    // sendApplicationBtn
    body.on('click', '#sendApplicationBtn', function (e) {
        e.preventDefault();

        $('#application-modal').removeClass('d-none').addClass('show');
    })

    // calculator tab
    let tabList = $('.tab-top__list');
    let tabLinks = $('.tab-top__link');

    // calculator tab
    body.on('click', '.change-tab', function (e) {
        e.preventDefault();
        let activeTabName = $(this).data('tab');

        toTab.val(activeTabName);
        calculatorForm.submit();
    });

    // delivery tab
    body.on('change', '.tab-form__radio', function (e) {
        $('.tab-form__info').hide();
        $('.tab-form__info[data-tab="' + $(this).val() + '"]').fadeIn(200);
    });

    // select
    body.on('change', '.select2_cus', function (e) {
        let id = $(this).val(),
            name = $(this).attr('name'),
            childSelect = $('.select2_cus[data-parent="' + name + '"]');

        if (childSelect) {
            childSelect.val(null).trigger('change');

            if (id) {
                childSelect.prop('disabled', false);
                childSelect.find("option").prop('disabled', true);
                childSelect.find("option[data-parent-id='" + id + "']").prop('disabled', false)
            } else {
                childSelect.prop('disabled', true);
            }
        }
    });

    // application card
    // $('.application-card').on('click', function (e) {
    //     e.preventDefault();
    //     let isOpened = $(this).hasClass('detail');
    //
    //     $('.application-card').removeClass('detail');
    //     if (!isOpened) {
    //         $(this).addClass('detail');
    //     }
    // });

    // signup success modal
    $('.modal-close').on('click', function () {
        $('.modal').removeClass('show');
        window.history.pushState({}, document.title, '{{ route('profile.home') }}');
    });

    $('input[data-field-type="phone"]').inputmask("99 999 99 99");  //static mask
    $('input[data-field-type="birthday"]').inputmask("99.99.9999");  //static mask

</script>

</body>
</html>
