<div id="filemanager-modal">
    <div class="filemanager-modal">
        <div class="filemanager-modal__wrap" id="filemanager-modal__wrap">
            <div class="filemanager-modal__head">
                <div class="fm-title">
                    File Manager
                </div>
                <button onclick="closeFilemanager()"><svg viewBox="64 64 896 896" focusable="false" class="" data-icon="close" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M563.8 512l262.5-312.9c4.4-5.2.7-13.1-6.1-13.1h-79.8c-4.7 0-9.2 2.1-12.3 5.7L511.6 449.8 295.1 191.7c-3-3.6-7.5-5.7-12.3-5.7H203c-6.8 0-10.5 7.9-6.1 13.1L459.4 512 196.9 824.9A7.95 7.95 0 0 0 203 838h79.8c4.7 0 9.2-2.1 12.3-5.7l216.5-258.1 216.5 258.1c3 3.6 7.5 5.7 12.3 5.7h79.8c6.8 0 10.5-7.9 6.1-13.1L563.8 512z"></path></svg></button>
            </div>
            <div class="filemanager-modal__body">
                <div class="filemanager-modal__folders" id="filemanager-modal__folders">

                </div>
                <div class="filemanager-modal__items">
                    <div class="fm-title" id="active_folder_title"></div>
                    <input type="text" onchange="search(this)" placeholder="Поиск" title="" class="mb-20">
                    <div class="filemanager__grid" id="filemanager__grid">

                    </div>
                </div>
                <div class="filemanager-modal__right">
                    <div id="active_item" class="d-none">
                        <div class="filemanager-field mb-20">
                            <div class="filemanager-field__label">Переименовать названия</div>
                            <input type="text" name="fileName" title="" value="" onkeyup="event.keyCode === 13 ? renameFile(this) : ''">
                        </div>

                        <div class="filemanager-field mb-20">
                            <div class="filemanager-field__label">Так же можете удалить картинку.</div>
                            <div class="fm-btn fm-btn--danger" onclick="deleteFile()">Удалить</div>
                        </div>

                        <div class="filemanager-field">
                            <div class="filemanager-field__label">Копировать ссылку.</div>
                            <div class="fm-btn fm-btn--default" onclick="copyFilePath()">Копировать</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="filemanager-modal__footer">
                <div>

                </div>
                <div class="d-flex">
                    <div class="fm-btn fm-btn--default mr-15" onclick="closeFilemanager()">Отмена</div>
                    <div class="fm-btn fm-btn--primary" onclick="submitFilemanager()">Ок</div>
                </div>
            </div>
        </div>
        <div class="filemanager-modal__overlay" onclick="closeFilemanager()"></div>
    </div>
</div>

@section('file-manager-js')
    <script>
        class Filemanager {
            isInit;
            isLoading;
            activeFolderId;
            activeFileId;
            activeFileUid;
            search;
            field;

            constructor() {
                this.container = document.getElementById('filemanager-modal');
                this.wrap = document.getElementById('filemanager-modal__wrap');
                this.dom_files = document.getElementById('filemanager__grid');
                this.dom_folders = document.getElementById('filemanager-modal__folders');

                this.activeFolderId = null;
                this.activeFileId = null;
                this.activeFileUid = null;
                this.search = '';
                this.field = null;
            }
            openModal(fieldId) {
                this.container.style.display = 'block';
                this.field = fieldId;

                if (!this.isInit) {
                    this.isInit = true;
                    this.wrap.classList.add('loading');
                    this.getFiles();
                    this.getFolders();
                }
            }
            closeModal() {
                this.container.style.display = 'none';
            }
            createFolder(input) {
                let _this = this,
                    value = input.value;

                this.wrap.classList.add('loading');

                if (value !== '') {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('filemanager.folder.store') }}",
                        method: 'POST',
                        dataType: 'json',
                        data: {name:value},
                        success: function () {
                            _this.getFolders();
                        },
                        error: function () {

                        }
                    });
                }
            }
            deleteFolder(id) {
                let _this = this;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/folders/"+id,
                    method: 'DELETE',
                    dataType: 'json',
                    success: function (data) {
                        _this.getFolders();
                    },
                    error: function () {

                    },
                    complete: function () {
                        _this.wrap.classList.remove('loading');
                    }
                });
            }
            deleteFile() {
                this.wrap.classList.add('loading');
                let _this = this;
                let id = this.activeFileId;
                if (id !== null) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/admin/files/"+id,
                        method: 'DELETE',
                        dataType: 'json',
                        success: function (data) {
                            _this.getFiles();
                            document.getElementById('active_item').classList.add('d-none');
                        },
                        error: function () {

                        },
                        complete: function () {
                            _this.wrap.classList.remove('loading');
                        }
                    });
                }
            }
            getFiles() {
                let _this = this;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('filemanager.files.index') }}",
                    method: 'GET',
                    dataType: 'json',
                    data: {folder_id: _this.activeFolderId, search: _this.search},
                    success: function (data) {
                        _this.dom_files.innerHTML = data.files_html;
                    },
                    error: function () {

                    },
                    complete: function () {
                        _this.wrap.classList.remove('loading');
                    }
                });
            }
            getFolders() {
                let _this = this;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('filemanager.folder.index') }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        _this.dom_folders.innerHTML = data.folders_html;
                    },
                    error: function () {

                    },
                    complete: function () {
                        _this.wrap.classList.remove('loading');
                    }
                });
            }
            copyFilePath() {
                let uid = this.activeFileUid;

                let input = document.createElement('input');
                input.value = 'https://goethe-translate.org/download/file/'+uid;
                document.body.appendChild(input);
                input.select();
                document.execCommand('copy');
                document.body.removeChild(input);

                alert("Успешно скопирован");
            }
            setActiveFolder(id, folder) {
                let txt = folder.innerText;
                folder.classList.add('--active');

                let titleBox = document.getElementById('active_folder_title');
                titleBox.classList.add('mb-15');
                titleBox.innerText = txt;

                this.wrap.classList.add('loading');
                this.activeFolderId = id;
                this.getFiles();
            }
            setActiveItem(id, file) {
                document.getElementById('active_item').classList.remove('d-none');
                let files = document.querySelectorAll('.filemanager-field__image');
                for (let i = 0; i < files.length; i++) {
                    files[i].classList.remove('active')
                }
                file.classList.add('active');
                this.activeFileId = id;
                this.activeFileUid = file.getAttribute('data-uid');

                let input = document.getElementsByName('fileName')[0];
                input.value = file.querySelector('span').innerText;

            }
            searchData(input) {
                let val = input.value;
                this.wrap.classList.add('loading');

                this.search = val;

                this.getFiles();
            }
            renameFile(input) {
                let _this = this;

                let val = input.value,
                    id = this.activeFileId;

                this.wrap.classList.add('loading');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/files/"+id,
                    method: 'POST',
                    dataType: 'json',
                    data: {name: val},
                    success: function (data) {
                        _this.getFiles();
                    },
                    error: function () {

                    },
                    complete: function () {
                        _this.wrap.classList.remove('loading');
                    }
                });
            }
            submit() {
                let _this = this;
                let input = this.field.querySelector('input');
                let name = input.name;
                let label = this.field.querySelector('.filemanager-field__label').innerText;
                let isMultiple = input.multiple;
                let id = this.field.getAttribute('id')

                let array = [];
                if (isMultiple) {
                    let ids = input.value;
                    if (ids !== '') {
                        array = ids.split(",");
                    }
                }
                array.push(this.activeFileId);

                if (array.length > 0 && this.activeFileId) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('filemanager.field') }}",
                        method: 'GET',
                        dataType: 'json',
                        data: {ids: array, name: name, label: label, id: id, isMultiple: isMultiple},
                        success: function (data) {
                            _this.closeModal();
                            _this.field.innerHTML = '';
                            _this.field.innerHTML = data;
                        },
                        error: function () {

                        },
                        complete: function () {

                        }
                    });
                } else {
                    this.closeModal();
                }
            }
            detach(id, file) {
                let field = file.closest('.fm-field');
                let field_id = field.id;

                let input = field.querySelector('input');
                let name = input.name;
                let label = field.querySelector('.filemanager-field__label').innerText;
                let isMultiple = input.multiple;

                let array = [];
                let ids = input.value;
                if (ids !== '') {
                    array = ids.split(",");
                }
                for(let i = 0; i < array.length; i++) {
                    if (Number(array[i]) === id) {
                        array.splice(i, 1);
                    }
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('filemanager.field') }}",
                    method: 'GET',
                    dataType: 'json',
                    data: {ids: array, name: name, label: label, id: field_id, isMultiple: isMultiple},
                    success: function (data) {
                        field.innerHTML = '';
                        field.innerHTML = data;
                    },
                    error: function () {

                    },
                    complete: function () {

                    }
                });
            }

            uploadFile(input) {
                let _this = this;

                if (window.FormData) {
                    let formdata = new FormData();
                    let files = input.files;

                    for(let i = 0; i < files.length; i++) {
                        formdata.append('file[]', files[i]);
                    }
                    formdata.append('folder_id', _this.activeFolderId);

                    this.wrap.classList.add('loading');

                    $.ajax({
                        url: "{{ route('filemanager.upload') }}",
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            _this.getFiles();
                        },
                        error: function (error) {
                            ajaxErrorMessage(error);
                        },
                        complete: function () {
                            _this.wrap.classList.remove('loading');
                        }
                    });

                } else {
                    alert('Ваш браузер не поддерживает загрузку файлов');
                }
            }
        }

        function closest (el, predicate) {
            do if (predicate(el)) return el;
            while (el === el && el.parentNode);
        }

        let fModal = new Filemanager();

        function openFilemanager(fieldId) {
            fModal.openModal(fieldId);
        }
        function closeFilemanager() {
            fModal.closeModal();
        }
        function createFolder(input) {
            fModal.createFolder(input);
        }
        function deleteFolder(id) {
            fModal.deleteFolder(id);
        }
        function setActiveFolder(id, folder) {
            fModal.setActiveFolder(id, folder);
        }
        function setActiveItem(id, file) {
            fModal.setActiveItem(id, file);
        }
        function search(input) {
            fModal.searchData(input);
        }
        function renameFile(input) {
            fModal.renameFile(input);
        }
        function deleteFile() {
            fModal.deleteFile();
        }
        function submitFilemanager() {
            fModal.submit();
        }
        function detachFile(id, file) {
            fModal.detach(id, file);
        }
        function uploadFile(input) {
            fModal.uploadFile(input);
        }
        function copyFilePath() {
            fModal.copyFilePath();
        }
    </script>
@endsection
