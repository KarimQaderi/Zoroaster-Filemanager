var Filemanager_current = '/';
var filemanager_model_select = false;
var filemanager_model_select_input_name = '';
var var_filemanger_model, var_filemanger_getInfo;

function set_filemanager_model_select_input_name(current) {
    filemanager_model_select_input_name = current;
}

function set_filemanager_model_select(current) {
    filemanager_model_select = current;
}

function set_Filemanager_current(current) {
    Filemanager_current = current;
}

function get_Filemanager_current() {
    return Filemanager_current;
}

function filemanger($folder) {
    $.ajax({
        url: route('Zoroaster-filemanager.getData'),
        type: 'GET',
        data: {
            folder: $folder
        },
        success: function (data) {
            $('.Zoroaster-Filemanager').html(data);
        }
    });
}

function filemanger_getInfo($this) {

    var filemanager_model_select_class = '';
    if (filemanager_model_select === true)
        filemanager_model_select_class = 'filemanager_select';


    $.ajax({
        url: route('Zoroaster-filemanager.getInfo'),
        type: 'GET',
        data: {
            file: $($this).attr('data-path')
        },
        success: function (data) {

            var_filemanger_getInfo = $.confirm({
                title: '',
                columnClass: 'filemanager_model ' + filemanager_model_select_class,
                content:
                    '<form class="formName">' + data + '</form>',
                buttons: {
                    cancel: {
                        text: '<button type="button" uk-close></button>',
                        action: function () {
                            //close
                        },
                    }
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });


        }
    });


}

function filemanger_model($folder) {

    $.ajax({
        url: route('Zoroaster-filemanager.getFilemanager'),
        type: 'GET',
        data: {
            folder: $folder,
            filemanager_model_main: true
        },
        success: function (data) {

            var_filemanger_model = $.confirm({
                title: '',
                columnClass: 'filemanager_model filemanager_model_main',
                content:
                    '<form class="formName">' + data + '</form>',
                buttons: {
                    cancel: {
                        text: '<button type="button" uk-close></button>',
                        action: function () {
                            //close
                        },
                    }
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });

            filemanger($folder);

        }
    });


}

change('#filemanger_upload_js_upload input', function () {
    var fd = new FormData();
    var files = $('#filemanger_upload_js_upload input')[0].files[0];
    fd.append('file', files);
    fd.append('_token', $('[name="_token"]').attr('content'));
    fd.append('current', get_Filemanager_current());

    $.ajax({
        url: route('Zoroaster-filemanager.updateFile'),
        type: 'POST',
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
            notification('فایل اپلود شد', 'success');
            filemanger(Filemanager_current);
        }
    });
});

click('.filemanger_create_folder', function (e) {
    $prompt = function (input) {
        $.ajax({
            url: route('Zoroaster-filemanager.createFolder'),
            type: 'GET',
            data: {
                folder: input,
                current: Filemanager_current,
            },
            success: function (data) {
                if (isset(data.error)) {
                    notification(data.error, 'danger');

                    Prompt('ساخت پوشه جدید', $prompt, {submit: 'ساخت پوشه'}, '', data.error);
                } else {
                    notification('پوشه ساخته شد', 'success');
                    filemanger(Filemanager_current);
                }


            }
        });
    };
    Prompt('ساخت پوشه جدید', $prompt, {submit: 'ساخت پوشه'});
});

click('.Filemanager_action #edit', function ($this) {

    var name = $($this).closest('.Filemanager_type').attr('data-name');
    var path = $($this).closest('.Filemanager_type').attr('data-path');
    var type = $($this).closest('.Filemanager_type').attr('data-type');

    $prompt = function (input, $this) {
        $.ajax({
            url: route('Zoroaster-filemanager.rename'),
            type: 'GET',
            data: {
                file: path,
                type: type,
                rename_file: input,
                current: Filemanager_current,
            },
            success: function (data) {

                if (isset(data.error)) {
                    Prompt('ویرایش نام', $prompt, {submit: 'ویرایش'}, data.rename, data.error);
                } else {
                    notification('با موفقیت نام ویرایش شد', 'success');
                    filemanger(Filemanager_current);
                }

            }
        });
    };
    Prompt('ویرایش نام', $prompt, {submit: 'ویرایش'}, name);
});

click('.Filemanager_action #delete', function ($this) {
    var name = $($this).closest('.Filemanager_type').attr('data-name');
    var path = $($this).closest('.Filemanager_type').attr('data-path');
    var type = $($this).closest('.Filemanager_type').attr('data-type');

    $prompt = function () {
        $.ajax({
            url: route('Zoroaster-filemanager.removeFile'),
            type: 'GET',
            data: {
                file: path,
                type: type,
            },
            success: function (data) {
                filemanger(Filemanager_current);
                notification('با موفقیت حذف شد ' + name, 'success');
            }
        });
    };
    Confirm_delete('حذف ' + name, $prompt);
});

click('[data-type="dir"].Filemanager_type .Filemanager_click,.filemanger_address b', function ($this) {
    filemanger($($this).attr('data-path'));
});

click('[data-type="file"].Filemanager_type .Filemanager_click', function ($this) {
    filemanger_getInfo($this);
});

click('.Filemanager_field_btn', function ($this) {
    filemanager_model_select_input_name = $($this).attr('data-id');
    filemanger_model('/');
});


click('.filemanager_model_select', function ($this) {
    $('#'+filemanager_model_select_input_name).val($($this).attr('data-url'));
    var_filemanger_getInfo.close();
    var_filemanger_model.close();
});


