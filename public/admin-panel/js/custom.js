$(document).ready(function () {

    initDatepicker();
    initSlugify();
    initNestableJs();
    initColorPicker();
    initSelect2();
    initSumNote();
    initMultipleImageUpload();
    initInputMask();

    $('.copy-to-clipboard__btn').on('click', function () {
        let inp = $(this).parent().find('input');
        inp.prop('readonly', true);

        let html = $(this).parent().find('.attached-box').html();

        function listener(e) {
            e.clipboardData.setData("text/html", html);
            e.clipboardData.setData("text/plain", html);
            e.preventDefault();
        }
        document.addEventListener("copy", listener);
        document.execCommand("copy");
        document.removeEventListener("copy", listener);

        inp.prop('readonly', false);
        inp.val('');

    });

    $('.attached-box input').on('keyup', function () {
        let dInput = this.value;
        $(this).attr('value', dInput);
    })

});

function initInputMask() {
    let phoneMaskInput = $('input[data-field-type="phone"]');
    if (phoneMaskInput.length > 0) {
        phoneMaskInput.inputmask("99 999 99 99");  //static mask
    }
}

function initDatepicker() {
    $('.air-datepicker').each(function () {
        let selectedDate = $(this).val().split('.');

        let date_picker = $(this).datepicker({
            dateFormat: 'dd.mm.yyyy',
        });

        if (selectedDate.length === 3) {
            date_picker.data('datepicker').selectDate(new Date(selectedDate[2], selectedDate[1] - 1, selectedDate[0]));
        }
    });
}

function initSlugify() {
    let slugifyInput = $('input[data-slug-origin]');
    if (slugifyInput.length > 0) {
        slugifyInput.each(function (i, el) {
            $(el).slugify();
        });
    }
}

function initNestableJs() {
    let nestableJs = $('.nestable-ui-js'),
        nestableJsData = $('.nestable-data');

    if (nestableJs.length > 0) {
        nestableJs.nestable({
            callback: function () {
                let serialize_json = window.JSON.stringify(nestableJs.nestable('serialize'));
                nestableJsData.val(serialize_json);
            },
        });
    }
}

function initColorPicker() {
    let colorPicker = document.querySelectorAll('.colorPicker');
    if (colorPicker.length > 0) {
        [...colorPicker].map(item => {
            let initColor = $(item).attr('data-init') ? $(item).attr('data-init') : '#43924D';
            let dColor = $(item).next().val();
            if (dColor === '') dColor = initColor;
            new Picker({
                parent: item,
                color: dColor,
                popup: 'left',
                editorFormat: 'rgb',
                onDone: function (color) {
                    $(item).css('background', color.rgbaString);
                    $(item).next().val(color.rgbaString);
                    $(item).find('.colorPickerColor').html(color.rgbaString)
                },
            });
            $(item).next().val(dColor);
            $(item).css('background', dColor);
            $(item).find('.colorPickerColor').html(dColor)
        })
    }
}

function initSelect2() {
    let select2 = $('.select2'),
        select2WithSearch = $('.select2_with_search');

    if (select2.length > 0) {
        select2.select2({
            minimumResultsForSearch: -1,
            placeholder: "Выбрать",
            width: '100%'
        });
    }

    if (select2WithSearch.length > 0) {
        select2WithSearch.select2({
            placeholder: "Выбрать",
            width: '100%'
        });
    }
}


function initSumNote() {
    let sumNote = $('.sum_note'),
        sumNoteWithImg = $('.sum_note_with_img');

    if (sumNote.length > 0) {
        sumNote.summernote({
            tabsize: 2,
            height: 300,
            toolbar: [
                ['cleaner',['cleaner']],
                ['style', ['style']],
                ['font', ['bold']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']],
            ],
            cleaner:{
                action: 'button', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                newline: '<br>', // Summernote's default is to use '<p><br></p>'
                notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
                icon: '<i class="note-icon">Clear Style</i>',
                keepHtml: false, // Remove all Html formats
                keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>'], // If keepHtml is true, remove all tags except these
                keepClasses: false, // Remove Classes
                badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
                badAttributes: ['style', 'start'], // Remove attributes from remaining tags
                limitChars: false, // 0/false|# 0/false disables option
                limitDisplay: 'both', // text|html|both
                limitStop: false // true/false
            },
            styleTags: ['h2', 'h3', 'p', 'blockquote'],
        });
    }

    if (sumNoteWithImg.length > 0) {
        sumNoteWithImg.summernote({
            tabsize: 2,
            height: 300,
            toolbar: [
                ['cleaner',['cleaner']],
                ['style', ['style']],
                ['font', ['bold']],
                ['para', ['ul', 'paragraph']],
                ['insert', ['link','picture']],
                ['view', ['fullscreen', 'codeview']],
            ],
            styleTags: ['h2', 'h3', 'p'],
            cleaner:{
                action: 'button', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                newline: '<br>', // Summernote's default is to use '<p><br></p>'
                notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
                icon: '<i class="note-icon">Clear Style</i>',
                keepHtml: false, // Remove all Html formats
                keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>'], // If keepHtml is true, remove all tags except these
                keepClasses: false, // Remove Classes
                badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
                badAttributes: ['style', 'start'], // Remove attributes from remaining tags
                limitChars: false, // 0/false|# 0/false disables option
                limitDisplay: 'both', // text|html|both
                limitStop: false // true/false
            },
            callbacks: {
                onMediaDelete: function (target) {
                    let img = target[0],
                        src = $(img).attr('data-name');
                    if (src) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/delete/image',
                            method: "delete",
                            data: {path: src},
                            success: function (data) {
                                alert(data);
                            }
                        });
                    }
                }
            }
        });
    }
}

function initMultipleImageUpload() {
    function readURL(input) {
        let _validFileExtensions = ["jpg", "jpeg", "png", "svg", "cdr", "psd", "ia", "pdf"];
        let wrap = $(input).parent().parent(),
            parent = wrap.parent(),
            type = parent.data('type'),
            name = $(input).attr('name');

        if (input.files && input.files[0]) {
            let sFileName = input.value;
            if (sFileName.length > 0) {
                let ext = sFileName.split('.')[1].toString().toLowerCase();

                if (!_validFileExtensions.includes(ext)) {
                    alert("Извините, этот файл недействителен, допустимые расширение:" + _validFileExtensions.join(", "));
                    input.value = '';
                    return false;
                }

                let reader = new FileReader();
                reader.onload = function(e) {
                    if (ext === 'jpg' || ext === 'jpeg' || ext === 'png') {
                        wrap.css({
                            'background-image': 'url('+e.target.result+')'
                        });
                    } else {
                        wrap.css({
                            'background-image': 'url(/frontend/images/files/'+ext+'.svg)'
                        });
                    }
                };
                reader.readAsDataURL(input.files[0]); // convert to base64 string


                if (type === 'multiple' && wrap.index() < 3) {
                    parent.append("<div class=\"file-input\">\n" +
                        "              <label>\n" +
                        "                <input type=\"file\" name="+name+">\n" +
                        "              </label>\n" +
                        "            </div>")
                }
            }
        } else {
            if (type === 'multiple') {
                if (wrap.index() !== 0) {
                    wrap.remove();
                } else {
                    wrap.next().remove();
                    wrap.removeAttr('style');
                }
            } else {
                wrap.removeAttr('style');
            }
        }
    }

    $('body').on('change', ".file-inputs input[type='file']", function () {
        readURL(this);
    });
}
