<?php
if (defined('ADMIN_SECTION') && ADMIN_SECTION === true) {
    $asset = \Bitrix\Main\Page\Asset::getInstance();
    $asset->addJs('https://code.jquery.com/jquery-2.2.4.min.js');
    $asset->addJs('/local/js/admin/custom.js');
}