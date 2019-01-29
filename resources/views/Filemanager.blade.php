<div class="filemanger_upload" hidden>
    <div id="filemanger_upload_js_upload" class="uk-placeholder uk-text-center">
        <span uk-icon="icon: cloud-upload"></span>
        <form>
            <div uk-form-custom>
                <input type="file" multiple>
                <span class="uk-link">فایل مورد نظر خورد را انتخاب کنید</span>
            </div>
        </form>
    </div>
</div>
<div class="Zoroaster-Filemanager"></div>

@if(request()->filemanager_model_main==true)
    <script>
        set_filemanager_model_select(true);
    </script>
@endif