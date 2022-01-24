<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule('iblock')) {
    return;
}

/*
 * Настройки компонента
 */
$arComponentParameters = array(
    "GROUPS" => array(),
    'PARAMETERS' => array(

        // идентификатор элемента получать из $_REQUEST["ELEMENT_ID"]
        'ELEMENT_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Идентификатор элемента',
            'TYPE' => 'STRING',
            'DEFAULT' => '={$_REQUEST["ELEMENT_ID"]}',
        ),

        // шаблон ссылки на страницу элемента
        'ELEMENT_URL' => array(
            'PARENT' => 'URL_TEMPLATES',
            'NAME' => 'URL, ведущий на страницу с содержимым элемента',
            'TYPE' => 'STRING',
            'DEFAULT' => 'detail/#ELEMENT_ID#/'
        ),
    ),
);

// добавляем еще одну настройку — на случай, если элемент инфоблока не найден
CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);
