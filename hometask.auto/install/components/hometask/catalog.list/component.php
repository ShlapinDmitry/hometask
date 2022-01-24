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

$arParams['SECTION_URL'] = trim($arParams['SECTION_URL']);


$arParams['ELEMENT_COUNT'] = intval($arParams['ELEMENT_COUNT']);
if ($arParams['ELEMENT_COUNT'] <= 0) {
    $arParams['ELEMENT_COUNT'] = 2;
}

$arParams['DISPLAY_TOP_PAGER'] = $arParams['DISPLAY_TOP_PAGER']=='Y';

$arParams['DISPLAY_BOTTOM_PAGER'] = $arParams['DISPLAY_BOTTOM_PAGER']=='Y';

$arParams['PAGER_TITLE'] = trim($arParams['PAGER_TITLE']);

$arParams['PAGER_SHOW_ALWAYS'] = $arParams['PAGER_SHOW_ALWAYS']=='Y';

$arParams['PAGER_TEMPLATE'] = trim($arParams['PAGER_TEMPLATE']);

$arParams['PAGER_SHOW_ALL'] = $arParams['PAGER_SHOW_ALL'] === 'Y';

$ELEMENT_ID = $arParams['SECTION_ID'];

$requestURL = Bitrix\Main\Context::getCurrent()->getRequest()->getRequestedPageDirectory();

if ($ELEMENT_ID) {

    $nav = new \Bitrix\Main\UI\PageNavigation("pager");
    $nav->allowAllRecords(true)
       ->setPageSize($arParams['ELEMENT_COUNT'])
       ->initFromUri();
    
    if(is_int($ELEMENT_ID)){
        $rsElements = \Hometask\Auto\CatalogBrendTable::getList(array(
            'select' => array('ID', 'NAME'),
            'count_total' => true,
            'offset' => $nav->getOffset(),
            'limit' => $nav->getLimit(),
        ));
    }else{
        $parseID = explode('_', $ELEMENT_ID);
        $table = $parseID[0];
        $idWhere = $parseID[1];
        switch ($table){
            case 'models':
                $rsElements = \Hometask\Auto\CatalogModelTable::getList(array(
                    'select' => array('ID', 'NAME'),
                    'filter' => array('=ID_BREND' => $idWhere),
                    'count_total' => true,
                    'offset' => $nav->getOffset(),
                    'limit' => $nav->getLimit(),
                ));
                break;
            case 'autos':
                $sort = Bitrix\Main\Context::getCurrent()->getRequest()->getQuery('sort');
                $order = Bitrix\Main\Context::getCurrent()->getRequest()->getQuery('order');
                
                $sort = (empty($sort)) ? 'ID' : $sort;
                $order = (empty($order))? 'ASC' : $order;
                $rsElements = \Hometask\Auto\CatalogAutoTable::getList(array(
                    'select' => array('ID', 'NAME'),
                    'filter' => array('=ID_MODEL' => $idWhere),
                    'order' => array($sort => $order),
                    'count_total' => true,
                    'offset' => $nav->getOffset(),
                    'limit' => $nav->getLimit(),
                ));
                break;
            case 'complactation':
                $rsElements = \Hometask\Auto\CatalogComplactetionTable::getList(array(
                    'select' => array('ID', 'NAME'),
                    'filter' => array('=ID_MODEL' => $idWhere),
                    'count_total' => true,
                    'offset' => $nav->getOffset(),
                    'limit' => $nav->getLimit(),
                ));
                break;
        }
    }
        
    $nav->setRecordCount($rsElements->getCount());

    while($elem = $rsElements->fetch())
    {
        if(isset($table) && $table == 'autos'){
            $sefFolder = explode('/', $requestURL)[1];
            $elem["AUTO_URL"] = '/' . $sefFolder . '/detail/' . $elem["ID"] . '/';
            $elem["COMPL_URL"] = $requestURL . '/' . $elem["ID"] . '/';
            $elem["BACK_URL"] = substr($requestURL, 0, strrpos($requestURL, '/')) . '/';
        }else{
            $elem["ITEM_URL"] = $requestURL . '/' . $elem["ID"] . '/';
            $elem["BACK_URL"] = substr($requestURL, 0, strrpos($requestURL, '/')) . '/';
        }
        $arResult["ITEMS"][] = $elem;
    }
    
    if(isset($table) && $table == 'autos'){
        $arResult["SHOW_SORT"] = "Y";
    }

    $arResult["NAVIGATION"] = $nav;

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
