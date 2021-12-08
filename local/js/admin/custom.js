$(function() {
    // $('#edit1_edit_table tbody > tr').map(function() {
    //     var id = $(this).attr('id');
    //     if(id != undefined) {
    //         id = Number(id.replace(/tr_PROPERTY_/gi, ''));

    //         if(id > 303) {
    //             $(this).css('display','none');
    //             var selectedText = $(this).find('option:selected').text();
    //             if(selectedText == '(не установлено)') {
    //                 $(this).find('option:contains("Да")').attr('selected', true);
    //             }
    //             var name = $(this).find('td').first().text();
    //             name = name.substr(0, name.length - 2);
    //             name = name.replace(/Показывать свойство "/gi, '');
    //             $(this).find('td:nth-child(1), td:nth-child(2)').insertAfter($('#edit1_edit_table tbody > tr > td:contains("'+ name +':")').eq(1).next());
    //         }
            
    //     }
    // });

    //$('body').find('#edit1_edit_table tbody > tr td:contains("Показывать свойство")').text('Показывать');


    $('<tr><td colspan="2" width="100%"><div class="change-props-wrapper" style="padding: 20px; margin:20px 0; background: #E5EEF0;"><a class="change-props-toggler" href="#">Опции изменения названия свойств</a><div class="change-props-container" style="padding-top: 20px; display:none;"></div></div></td></tr>').appendTo('#edit1_edit_table > tbody');

    $('#edit1_edit_table tbody > tr td:contains("Изменить название поля")').parent().map(function() {
        $(this).appendTo($('body').find('.change-props-container'));
    });

    $('body').find('.change-props-toggler').on('click', function(e) {
        e.preventDefault();
        $('body').find('.change-props-container').slideToggle();
    });

    



    $('<tr><td colspan="2" width="100%"><div class="show-props-wrapper" style="padding: 20px;background: #E5EEF0;"><a class="show-props-toggler" href="#">Опции включения показа свойств в каталоге (в списке)</a><div class="show-props-container" style="padding-top: 20px; display:none;"></div></div></td></tr>').appendTo('#edit1_edit_table > tbody');

    $('#edit1_edit_table tbody > tr td:contains("Показывать свойство")').parent().map(function() {
        // var id = $(this).attr('id');
        // if(id != undefined) {
        //     if($(this).find('td:contains("Показывать свойство")')) {
        //         var selectedText = $(this).find('option:selected').text();
        //         if(selectedText == '(не установлено)') {
        //             $(this).find('option:contains("Да")').attr('selected', true);
        //         }
        //     }
        // }
        $(this).appendTo($('body').find('.show-props-container'));
    });

    $('body').find('.show-props-toggler').on('click', function(e) {
        e.preventDefault();
        $('body').find('.show-props-container').slideToggle();
    });









    

});