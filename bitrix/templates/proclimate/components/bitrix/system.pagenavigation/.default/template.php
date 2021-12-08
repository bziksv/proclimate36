<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult["NavShowAlways"] || $arResult["NavPageCount"] > 1):?>

    <ul class="main-pagination main-pagination_mod">

        <?if ($arResult["NAV"]["PAGE_NUMBER"] == 1):?>
            <li class="prev-page"><a href="#"></a></li>
        <?else:?>
            <li class="prev-page"><a href="<?=$arResult["NAV"]["URL"]["FIRST_PAGE"]?>"></a></li>
        <?endif;?>

        <?for ($PAGE_NUMBER=$arResult["NAV"]["START_PAGE"]; $PAGE_NUMBER<=$arResult["NAV"]["END_PAGE"]; $PAGE_NUMBER++):?>
            <?if ($PAGE_NUMBER == $arResult["NAV"]["PAGE_NUMBER"]):?>
                <li class="active"><a href=""><?=$PAGE_NUMBER?></a></li>
            <?else:?>
                <li><a href="<?=$arResult["NAV"]["URL"]["SOME_PAGE"][$PAGE_NUMBER]?>"><?=$PAGE_NUMBER?></a></li>
            <?endif;?>
        <?endfor;?>

        <?if ($arResult["NAV"]["PAGE_NUMBER"] == $arResult["NAV"]["PAGE_COUNT"]):?>
            <li class="next-page"><a href=""></a></li>
        <?else:?>
            <li class="next-page"><a href="<?=$arResult["NAV"]["URL"]["NEXT_PAGE"]?>"></a></li>
        <?endif;?>

    </ul>
<?endif;?>
