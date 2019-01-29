<div class="filemanger_view_model">
    <div class="filemanger_view_model_title" uk-grid>
        <div class="uk-width-auto">
            <div class="filemanager_model_select" data-url="{{ $url }}">انتخاب فایل</div>
        </div>
        <div class="uk-width-expand">{{ $name }}</div>
    </div>

    <div class="filemanger_view">
        <div class="col-1">
            <div class="{{ (isset($source) ?'source' : '' )  }}">
                @if(isset($type) && $type=='image')
                    <img src="{{ $image }}" alt="">
                @elseif(isset($type) && $type=='zip')
                    {{ $source }}
                @elseif(isset($source))
                    <pre>{{ $source }}</pre>
                @endif
            </div>
        </div>
        <div class="col-2">
            <ul>
                <li><span>نام</span><span>{{ $name }}</span></li>
                <li><span>نوع فایل</span><span>{{ $mime }}</span></li>
                <li><span>اخرین تغیرات</span><span>{{ $date }}</span></li>
                <li><span>حجم</span><span>{{ $size }}</span></li>
            </ul>
            <b>ادرس</b>
            <div class="filemanger_view_url">{{ $url }}</div>

        </div>


    </div>
</div>


