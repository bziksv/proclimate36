<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?

// текущая страница: /ru/support/index.php?id=3&s=5
global $APPLICATION;
$dir = $APPLICATION->GetCurDir();
// в $dir будет значение "/ru/support/"
$section_code = explode("/", $dir);

//echo "<pre>"; print_r($arResult); echo "</pre>";


// echo "<pre>"; print_r($arResult["NAV_RESULT"]["arResult"][0]["IBLOCK_SECTION_ID"]); echo "</pre>";


       CModule::IncludeModule("iblock");
       CModule::IncludeModule("catalog");

      // echo $arResult["IBLOCK_SECTION_ID"];

?>
<div class="row catalog-product_content res_section" data-flickity1='{ "wrapAround": true }' style1="margin-left: 10px !important;">
    <? if (!empty($arResult['ITEMS'])): ?>
    <? foreach ($arResult['ITEMS'] as $key => $arItem): ?>

        <?
           //echo $arItem["IBLOCK_SECTION_ID"];

            //break;
                $name = $arItem["NAME"];
                  $arFilterSeo = Array('IBLOCK_ID'=>2, 'ACTIVE'=>'Y', "CODE"=>$section_code[2]);
                $db_listSeo = CIBlockSection::GetList(Array($by=>$order), $arFilterSeo, true, Array('UF_RECPRODUCTS'));
                if($ar_resultSeo = $db_listSeo->GetNext())
                {
                    $name = $arResult["IBLOCK_SECTION_ID"];
                     foreach ($ar_resultSeo["~UF_RECPRODUCTS"] as $value) {
                          //  echo $value; 
                            
                            $id = explode(';', $value);
                      //  print_r($id);
                            $preview_text = "";
                            if (intval($id[0]) == $arItem["ID"]){
                               // if ($id[1] <> "")){
                                    $name = $id[1];
                               // }
                               
                              //  if ($id[2] <> ""){
                                     //echo $id[2];
                                    $preview_text = $id[2];
                                    break;
                                    
                              //  }
                                
                            }
                            //echo $id[0];
                           // $arrID[] = $id[0];
                            //$i++;
                            //echo "<br/>";
                        }
                   /*print_r($ar_resultSeo["~UF_RECPRODUCTS"]);
                   echo "<br/>";
                  print_r($ar_resultSeo["~UF_RECPRODUCTS"][$i]);
                  $arrID = $ar_resultSeo[$i];
                 $i++;*/
                }
                                //echo $name;
                              //      echo $preview_text;
                

        ?>
        <div class1="col-xl-4 col-lg-6 col-md-6 col-sm-6 ">
            <div class="product-item carousel-cell1" style="margin-bottom: 4.6em !important; width: 85% !important; margin-left: 10px !important;">
                <div class="product-item_img">
                    <?
                        if($arItem['PROPERTIES']['MARK']['VALUE_XML_ID'])
                            include('mark/'.$arItem['PROPERTIES']['MARK']['VALUE_XML_ID'].'.php');
                    ?>
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                        <img data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                    </a>
                </div>
                <div class="product-item_desc">
                    <div class="product_item_desc-top">
                        <? if(in_array($arItem['IBLOCK_SECTION_ID'], ['12', '21'])):?>
                            <?if($arItem['PROPERTIES']['VERSOIN']['VALUE']):?>
                                <span class="product-item_category">Серия:<br/><?=$arItem['PROPERTIES']['VERSOIN']['VALUE']?></span>
                            <?else:?>
                                <span class="product-item_category"><?=$arItem['SECTION']['NAME'];?></span>
                            <?endif;?>
                        <?else:?>
                            <span class="product-item_category"><?=$arItem['SECTION']['NAME'];?></span>
                        <?endif;?>
						<?
							//название твара
						?>
                        <div class="product-item_title">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <?=$name?><?//=$arItem['NAME']?>
                            </a>
                        </div>
                        <span class="product-item_price"><?=$arItem['PRICES']['BASE']['PRINT_VALUE']?></span>
                    </div>
                    <div class="product-item_hidden">
                        <ul class="product-item_features">
                            <? /*foreach ($arParams['LIST_PROPERTY_CODE'] as $code):
                                if(!$arItem['PROPERTIES'][$code]['VALUE'])
                                    continue;
                                ?>
                                <li>
                                    <span class="<?=($arItem['PROPERTIES'][$code]['HINT']) ?: 'glipf-swing'?>"></span>
                                    <span class="gray-color"><?=$arItem['PROPERTIES'][$code]['NAME']?></span> -
                                    <? echo (is_array($arItem['PROPERTIES'][$code]['VALUE']) ? implode(' / ', $arItem['PROPERTIES'][$code]['VALUE']) : $arItem['PROPERTIES'][$code]['VALUE']);?>
                                </li>
                            <? endforeach;*/ ?>
							<?
								//текст анонса если указан в шаблоне, то выводим
							
							?>
							<?//if($arItem["PREVIEW_TEXT"]):?>
                                <li>
                                    <?=$preview_text?><?//=$arItem["PREVIEW_TEXT"]?>
                                </li>
                            <?// endif;?>
                        </ul>
                        <a href="" class="product-item_buy-btn main-btn" data-id="<?=$arItem['ID']?>">Купить</a>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach;?>
    <?else:?>
        <p>Нет товаров!</p>
    <? endif;?>
</div>

<? echo $arResult["NAV_STRING"]; ?>
 <?
      CJSCore::Init(array("jquery"));
 ?>


<script>
    
$( document ).ready(function() {

      $('.res_section').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [{
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      }
    }, {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: false,
        arrows: false,
        dots: true,
        autoplaySpeed: 6000,
      }
    }, ]
  });


   
   
});

</script>


<style>
.res_section .slick-prev {
    left: -20px;
}
</style>