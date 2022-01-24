<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule('iblock')) {
    return;
}

$arSorts = array("ASC" => "По возрастанию", "DESC" => "По убыванию");
$arSortFields = array(
    "PRICE" => "Сортировка по цене",
    "YEAR" => "Сортировка по году выпуска"
);

/*
 * Настройки компонента
 */
$arComponentParameters = array(
    "GROUPS" => array(),
    'PARAMETERS' => array(

        // идентификатор раздела получать из $_REQUEST["SECTION_ID"]
        'SECTION_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Идентификатор раздела',
            'TYPE' => 'STRING',
            'DEFAULT' => '={$_REQUEST["SECTION_ID"]}',
        ),
        
        'ELEMENT_COUNT' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Количество элементов на странице',
            'TYPE' => 'STRING',
            'DEFAULT' => '3',
        ),

        // шаблон ссылки на страницу раздела
        'SECTION_URL' => array(
            'PARENT' => 'URL_TEMPLATES',
            'NAME' => 'URL, ведущий на страницу с содержимым раздела',
            'TYPE' => 'STRING',
            'DEFAULT' => 'category/id/#SECTION_ID#/'
        ),
        
        // шаблон ссылки на страницу элемента
        'ELEMENT_URL' => array(
            'PARENT' => 'URL_TEMPLATES',
            'NAME' => 'URL, ведущий на страницу с содержимым элемента',
            'TYPE' => 'STRING',
            'DEFAULT' => 'item/id/#ELEMENT_ID#/'
        ),
        
        "SORT" => array(
            "PARENT" => 'DATA_SOURCE',
            "NAME" => 'Поле для сортировки',
            "TYPE" => 'LIST',
            "DEFAULT" => 'ID',
            "VALUES" => $arSortFields,
            "ADDITIONAL_VALUES" => 'Y',
        ),
        "SORT_ORDER" => array(
            "PARENT" => 'DATA_SOURCE',
            "NAME" => 'Направление для сортировки',
            "TYPE" => 'LIST',
            "DEFAULT" => 'DESC',
            "VALUES" => $arSorts,
            "ADDITIONAL_VALUES" => 'Y',
        ),
    ),
);

CIBlockParameters::AddPagerSettings(
    $arComponentParameters,
    "Отзывы",
    true, //$bDescNumbering
    true, //$bShowAllParam
    true, //$bBaseLink
    $arCurrentValues["PAGER_BASE_LINK_ENABLE"]==="Y" //$bBaseLinkEnabled
);

// добавляем еще одну настройку — на случай, если элемент инфоблока не найден
CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);
