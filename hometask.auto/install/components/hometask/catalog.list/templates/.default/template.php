<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->setFrameMode(false);
?>
<div class="container">
    <? if($arResult["SHOW_SORT"] == "Y"): ?>
    <?
        $sort = $_GET["sort"];
        $order_price = 'asc';
        $order_name = 'asc';

        if ($sort == "PRICE"){
            if ( isset($_GET['order'])) {
                    if ($_GET['order'] == 'asc') {		
                            $order_price = "desc";
                    }
                    if ($_GET['order'] == 'desc') {		
                            $order_price = "asc";
                    }			
            }
        }
        if ($sort == "YEAR"){
            if ( isset($_GET['order'])) {
                if ($_GET['order'] == 'asc') {		
                        $order_name = "desc";
                }
                if ($_GET['order'] == 'desc') {	
                        $order_name = "asc";
                }			
            }	
        }



        $yearParams = 'sort=YEAR&order=' . $order_name;
        $priceParams = 'sort=PRICE&order=' . $order_price;
        ?>

        <div class="row">
            <div class="col-2">Сортировать по:</div>
            <div class="col-4">				    					
                    <a class="sort_price_<?=$order_price;?>" href="<?=$APPLICATION->GetCurPageParam($priceParams,array('sort','order'),false);?>">цене</a>		
                    <a class="sort_name_<?=$order_name;?>" href="<?=$APPLICATION->GetCurPageParam($yearParams,array('sort','order'),false);?>">году выпуска</a>																		
            </div>
        </div>
    <? endif; ?>
    <div class="row">
    <? foreach ($arResult["ITEMS"] as $item): ?>
        <? if(isset($item["ITEM_URL"])): ?>
        <div class="col-3"><a href="<?=$item["ITEM_URL"]?>"><?=$item["NAME"]?></a></div>
        <? else: ?>
        <div class="col-3">
            <a href="<?=$item["AUTO_URL"]?>"><?=$item["NAME"]?></a><br>
            <a href="<?=$item["COMPL_URL"]?>">Комплектация</a>
        </div>
        <? endif; ?>
    <? endforeach; ?>
        </div>
</div>
<div class="container mt-5">
    <a class="btn btn-success" href="<?=$item["BACK_URL"]?>">Назад</a>
</div>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.pagenavigation",
    "",
    array(
       "NAV_OBJECT" => $arResult["NAVIGATION"],
       "SEF_MODE" => "N",
    ),
    false
);?>
