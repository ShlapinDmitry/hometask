<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

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
<?$APPLICATION->IncludeComponent(
    "hometask:catalog.list",
    "",
    Array(
        "DISPLAY_BOTTOM_PAGER" => $arParams['DISPLAY_BOTTOM_PAGER'],
        "DISPLAY_TOP_PAGER" => $arParams['DISPLAY_TOP_PAGER'],
        "ELEMENT_COUNT" => $arParams['ELEMENT_COUNT'],
        "ELEMENT_URL" => $arResult['ELEMENT_URL'],
        "PAGER_BASE_LINK_ENABLE" => $arParams['PAGER_BASE_LINK_ENABLE'],
        "PAGER_DESC_NUMBERING" => $arParams['PAGER_DESC_NUMBERING'],
        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
        "PAGER_SHOW_ALL" => $arParams['PAGER_SHOW_ALL'],
        "PAGER_SHOW_ALWAYS" => $arParams['PAGER_SHOW_ALWAYS'],
        "PAGER_TEMPLATE" => $arParams['PAGER_TEMPLATE'],
        "PAGER_TITLE" => $arParams['PAGER_TITLE'],
        "SECTION_ID" => $arResult['VARIABLES']['SECTION_ID'],
        "SECTION_URL" => $arResult['SECTION_URL'],
    ),
    $component
);
?>