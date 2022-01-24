<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->setFrameMode(false);
?>
<div class="container">
    <h1><?=$arResult["NAME"]?></h1>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <span class="font-weight-bold">Цена:</span> <?=number_format($arResult["PRICE"], 0, '', ' ')?> руб.
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <div class="row">
                <h2>Описание</h2>
                <div class="col-12">
                    <span class="font-weight-bold">Бренд:</span> <?=$arResult["HOMETASK_AUTO_CATALOG_AUTO_BREND_NAME"]?>
                </div>
                <div class="col-12">
                    <span class="font-weight-bold">Модель:</span> <?=$arResult["HOMETASK_AUTO_CATALOG_AUTO_MODEL_NAME"]?>
                </div>
                <div class="col-12">
                    <span class="font-weight-bold">Комплектация:</span> <?=$arResult["HOMETASK_AUTO_CATALOG_AUTO_COMPLECTATION_NAME"]?>
                </div>
                <div class="col-12">
                    <span class="font-weight-bold">Год выпуска:</span> <?=$arResult["YEAR"]?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <h2>Опции</h2>
                <ul class="list-group">
                    <? foreach ($arResult["OPTIONS"] as $option): ?>
                    <li class="list-group-item"><?=$option["HOMETASK_AUTO_CATALOG_COMPLACTETION_OPTIONS_NAME"];?></li>
                    <? endforeach; ?>
                    <li class="list-group-item"><?=$arResult["HOMETASK_AUTO_CATALOG_AUTO_OPTIONS_NAME"]?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
