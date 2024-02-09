@php
    $files = is_object($files) ? $files : [];
@endphp
<div>
    <input type="hidden" name="{{ $name }}" value="{{ $value }}" {{ $isMultiple ? 'multiple="true"' : '' }}">
    <div class="filemanager-field mb-15">
        <div class="filemanager-field__label">{{ $label }}</div>
        <div class="filemanager__grid">
            @if(count($files) > 0)
                @foreach($files as $file)
                    <div class="filemanager-field__image">
                        <div class="filemanager-field__delete" onclick="detachFile({{ $file->id }}, this)"></div>
                        <span>{{ $file->name }}</span>
                        @if(in_array($file->ext, $file->getIsImage()))
                            <img src="{{ $file->thumbnails['small']['src'] }}" alt="">
                        @else
                            <img src="{{ '/admin-panel/images/files/'.$file->ext.'.svg' }}" alt="">
                        @endif
                    </div>
                @endforeach
            @endif
            @if($isMultiple || count($files) === 0)
                <div class="filemanager-field__upload" onclick="openFilemanager({{ $id }})">
                    <span>Загрузите</span>
                </div>
            @endif
        </div>
    </div>
</div>
