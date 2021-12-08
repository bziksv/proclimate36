<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if( !empty( $_GET["id"] ))
    $id = (int)$_GET["id"];

if( !empty( $_GET["quantity"] ) )
    $quantity = (int)$_GET["quantity"];
else
    $quantity = 1;

if( !$id )
    return false;

CModule::IncludeModule( 'catalog' );
CModule::IncludeModule( 'sale' );

if(Add2BasketByProductID( $id, $quantity ))
    return print 'Добавлено';
else{
    if ($ex = $APPLICATION->GetException())
        echo $ex->GetString();
}
?>
