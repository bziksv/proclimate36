<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
	<table class="title-search-result">
		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			<tr>
				<td class="title-search-separator">&nbsp;</td>
			</tr>
			<?foreach($arCategory["ITEMS"] as $i => $arItem):
                if(!isset($arItem["ITEM_ID"]))
                    continue;
                ?>
			<tr>
                <td class="title-search-item">
                    <a href="<?echo $arItem["URL"]?>">
                        <?echo $arItem["NAME"]?>
                    </a>
                </td>
			</tr>
			<?endforeach;?>
		<?endforeach;?>
		<tr>
			<td class="title-search-separator">&nbsp;</td>
		</tr>
	</table>
    <div class="title-search-fader"></div>
<?endif;
?>
