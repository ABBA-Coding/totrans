<label class="filemanager-field__upload">
    <input type="file" name="files" class="d-none" multiple onchange="uploadFile(this)">
    <span>+ <br> Загрузите</span>
</label>
@if(count($files) > 0)
    @foreach($files as $file)
        <div class="filemanager-field__image" data-uid="{{ $file->uid }}"
             onclick="setActiveItem({{ $file->id }}, this)">
            <span>{{ $file->name }}</span>

            @if(in_array($file->ext, $file->getIsImage()))
                <img src="{{ $file->thumbnails['small']['src'] }}" alt="">
            @else
                <img src="{{ '/admin-panel/images/files/'.$file->ext.'.svg' }}" alt="">
            @endif
        </div>
    @endforeach
@endif
