$("#add_post").click(function () {


    var file_data = $('#file').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    alert(form_data);
    $.ajax({
        url: '/app/ajax/Ajax.php',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response){
            console.log(php_script_response);
        }
    });
    /*
    var title = $('#title').val();
    var description = $('#description').val();
    var textarea = $('#textarea').val();
    var files;
    $('input[type=file]').on('change', function(){
        files = this.files;
        console.log(files);

    });

    $.post("/app/ajax/Ajax.php?test=213", {
        title: title,
    }).done(function (result) {
console.log(result);
    });*/
});