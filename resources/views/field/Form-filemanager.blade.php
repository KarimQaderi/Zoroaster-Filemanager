@php($id = $field->name.str_slug(microtime(true)))
<label class="Zoroaster_Filemanager_field">
    <span class="label">{{ $field->label }}</span>
    <span class="uk-text-warning uk-text-small-2">{{ Zoroaster::getMeta($field,'helpText') }}</span>
    <input class="uk-input" name="{{ $field->name }}" type="text" value="{{ old($field->name,(is_array($value))? json_encode($value) : $value) }}">
    <div class="Filemanager_field_btn">انتخاب فایل</div>
</label>