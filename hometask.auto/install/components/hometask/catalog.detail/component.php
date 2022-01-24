<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

\Bitrix\Main\Loader::includeModule("hometask.auto");

$arParams['ELEMENT_ID'] = empty($arParams['ELEMENT_ID']) ? 0 : intval($arParams['ELEMENT_ID']);
if (empty($arParams['ELEMENT_ID'])) {
   \Bitrix\Iblock\Component\Tools::process404(
        trim($arParams['MESSAGE_404']) ?: 'Элемент инфоблока не найден',
        true,
        $arParams['SET_STATUS_404'] === 'Y',
        $arParams['SHOW_404'] === 'Y',
        $arParams['FILE_404']
    );
    return;
}

$arParams['ELEMENT_URL'] = trim($arParams['ELEMENT_URL']);

if ($this->StartResultCache(false, ($arParams['CACHE_GROUPS']==='N' ? false: $USER->GetGroups()))) {

    $ELEMENT_ID = $arParams['ELEMENT_ID'];

    if ($ELEMENT_ID) {
        
        $query = new \Bitrix\Main\Entity\Query(HomeTask\Auto\CatalogAutoTable::getEntity());
        $query
            ->registerRuntimeField("BREND", array(
                "data_type" => "HomeTask\Auto\CatalogBrendTable",
                'reference' => array('=this.ID_MODEL' => 'ref.ID'),
                )
            )
            ->setSelect(array("ID", "NAME", "YEAR", "PRICE", "MODEL", "COMPLECTATION", "BREND", "OPTIONS"))
            ->setFilter(array("ID" => $ELEMENT_ID));
        
        $rsElement = $query->exec();
        
        if($elem = $rsElement->fetch())
        {
           $arResult = $elem;
        }
        
        $query = new \Bitrix\Main\Entity\Query(HomeTask\Auto\CatalogComplactetionTable::getEntity());
        
        $query
            ->setSelect(array("OPTIONS"))
            ->setFilter(array("ID" => $arResult["HOMETASK_AUTO_CATALOG_AUTO_COMPLECTATION_ID"]));
        
        $rsOptions = $query->exec();
        while($option = $rsOptions->fetch())
        {
           $arResult["OPTIONS"][] = $option;
        }

    }

    if (isset($arResult['ID'])) {
        $this->SetResultCacheKeys(
            array(
                'ID',
                'NAME'
            )
        );
        $this->IncludeComponentTemplate();
    } else {
        $this->AbortResultCache();
        \Bitrix\Iblock\Component\Tools::process404(
            trim($arParams['MESSAGE_404']) ?: 'Элемент инфоблока не найден',
            true,
            $arParams['SET_STATUS_404'] === 'Y',
            $arParams['SHOW_404'] === 'Y',
            $arParams['FILE_404']
        );
    }

}
