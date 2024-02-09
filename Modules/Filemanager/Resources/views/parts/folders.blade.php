<div>
    <div class="filemanager-modal__folder">
        <span onclick="setActiveFolder(null, this)">все</span>
    </div>
    @if(count($folders) > 0)
        @foreach($folders as $folder)
            <div class="filemanager-modal__folder">
                <span onclick="setActiveFolder({{ $folder->id }}, this)">{{ $folder->name }}</span>
                <div>
                    <?/*<button></button>*/?>
                    <span></span>
                    <button onclick="deleteFolder({{ $folder->id }})"></button>
                </div>
            </div>
        @endforeach
    @endif
</div>
<input type="text" placeholder="Создать новый папка" title="" onkeyup="event.keyCode === 13 ? createFolder(this) : ''">
