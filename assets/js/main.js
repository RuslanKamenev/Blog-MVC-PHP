$(document).ready( function () {

    //Скрытие комментариев, превышающих указанную высоту
    $('.comment-text').each(function () {
        if ($(this).children().height() > 54) {
            $(this).attr('class','comment-hide-more');
            $(this).after('<div class="show-full-comment">Показать комментарий полностью</div>');
        }
    });

    //показать комментарий полностью
    $('.show-full-comment').click(function () {
        let prevElement = $(this).prev();
        prevElement.css('max-height', 'none');
        $(this).hide();
    });

    //Редактор комментариев
    let options = {
        placeholder: 'Текст...',
        theme: 'snow'
    };
    let editor = new Quill('#editor', options);
    $('#add-comment').hide();
    $('#editor').css('height', '44px');
    $('#editor').click(function () {
        $(this).css('height', '140px');
        $('#add-comment').show();
    });

    $('#add-comment-form').submit(function (event) {
        let commentText = $('.ql-editor').children().html();
        $("input[type=hidden]").val(commentText);
    });

    //Показ результатов поиска, если в поле введено более 3-х символов
    $('.search-results').hide();
    $('.search-bar-field').on('input', function () {
        let textLength = $('.search-bar-field').val().length;
        if (textLength >= 2)
            $('.search-results').show();
        else if (textLength < 1)
            $('.search-results').hide();
    });

    //Создание AJAX запроса для строки поиска
    $('.search-bar-field').keyup( function () {
        let searchingInformation = $('.search-bar-field').val();
        $.ajax({
                type: "POST",
                url: "/public/controller/header.php",
                data: {search: searchingInformation},
                dataType: "text",
                success: function (data) {
                    $('.search-results').html(data);
                    console.log(data);
                }
            }
        )
    });
    $('.search-results').hover(function () {
        $('.search-results').show();
    }, function () {
        $('.search-results').hide();
    });

});