<div class="brands-section">
    <div class="section-title">Бренды</div>
    <div class="brands-slider">
        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="brand-item">
            <a href="<?=$arItem['PROPERTY_BREND_LINK_VALUE']?>">
				<div class="brends-item_title"><?=$arItem['NAME']?></div>
               <img data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
            </a>
        </div>
        <?endforeach;?>
    </div>
</div>