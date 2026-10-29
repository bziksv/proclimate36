$(function() {
    // SEO: сворачиваемые блоки для UF «Изменить название…» / «Показывать свойство…»
    // Только если такие поля реально есть на форме (раздел каталога).
    // Раньше пустые обёртки лепились на любой #edit1_edit_table (в т.ч. site_checker).
    var $table = $('#edit1_edit_table > tbody');
    if (!$table.length) {
        return;
    }

    var $renameRows = $table.children('tr').filter(function() {
        return $(this).children('td').filter(function() {
            return $(this).text().indexOf('Изменить название поля') !== -1;
        }).length > 0;
    });

    var $showRows = $table.children('tr').filter(function() {
        return $(this).children('td').filter(function() {
            return $(this).text().indexOf('Показывать свойство') !== -1;
        }).length > 0;
    });

    if ($renameRows.length) {
        $('<tr><td colspan="2" width="100%"><div class="change-props-wrapper" style="padding: 20px; margin:20px 0; background: #E5EEF0;"><a class="change-props-toggler" href="#">Опции изменения названия свойств</a><div class="change-props-container" style="padding-top: 20px; display:none;"></div></div></td></tr>').appendTo($table);
        $renameRows.appendTo($table.find('.change-props-container'));
        $table.find('.change-props-toggler').on('click', function(e) {
            e.preventDefault();
            $(this).siblings('.change-props-container').slideToggle();
        });
    }

    if ($showRows.length) {
        $('<tr><td colspan="2" width="100%"><div class="show-props-wrapper" style="padding: 20px;background: #E5EEF0;"><a class="show-props-toggler" href="#">Опции включения показа свойств в каталоге (в списке)</a><div class="show-props-container" style="padding-top: 20px; display:none;"></div></div></td></tr>').appendTo($table);
        $showRows.appendTo($table.find('.show-props-container'));
        $table.find('.show-props-toggler').on('click', function(e) {
            e.preventDefault();
            $(this).siblings('.show-props-container').slideToggle();
        });
    }
});
