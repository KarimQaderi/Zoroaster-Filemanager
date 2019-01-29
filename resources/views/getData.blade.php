<script>
        set_Filemanager_current('{{ $current }}');
</script>
<div class="filemanger">
    <div class="filemanger_head">
        <button uk-toggle="target: .filemanger_upload">آپلود</button>
        <button class="filemanger_create_folder">ساخت پوشه</button>
    </div>
    <div class="filemanger_ModalFileManager">
        <div class="filemanger_address">
            <b>خانه</b>
            <span class="path">
                @foreach($paths as $p)
                    @if ($loop->first)
                        <span data-path="{{ $p['path'] }}">{{ $p['name'] }}</span>
                    @else
                        <b data-path="{{ $p['path'] }}">{{ $p['name'] }}</b>
                    @endif
                    <div>/</div>
                @endforeach
            </span>
        </div>
        <div class="filemanger_body">
            @foreach ($files as $file)
                <div class="Filemanager_type" data-name="{{ $file->name }}" data-path="/{{ $file->path }}" data-type="{{ $file->type }}">
                    <div class="Filemanager_action"><span id="edit" uk-icon="edit-2"></span><span id="delete" uk-icon="delete"></span></div>
                    <div class="Filemanager_click" data-path="/{{ $file->path }}">
                        <div class="Filemanager_type_img">
                            @if($file->mime=='image')
                                <img src="{{ $file->thumb }}" alt="">
                            @else
                                <i uk-icon="{{ $file->thumb }}"></i>
                            @endif
                        </div>
                        <div class="Filemanager_type_name">{{ $file->name }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="filemanger_getInfo">

</div>



