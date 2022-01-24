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

if ($arParams['SEF_MODE'] == 'Y') {
    /*
     * Если включен режим поддержки ЧПУ
     */

    $arVariables = array();

    $requestURL = Bitrix\Main\Context::getCurrent()->getRequest()->getRequestedPage();
    if(stripos($requestURL, 'detail')){
        $componentPage = 'detail';
        $partsURI = explode('/', $requestURL);
        $arVariables['ELEMENT_ID'] = $partsURI[3];
    }else{
        $componentPage = CComponentEngine::ParseComponentPath(
            $arParams['SEF_FOLDER'],
            $arParams['SEF_URL_TEMPLATES'], 
            $arVariables // переменная передается по ссылке
        );
    }

    if ($componentPage === false && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $arParams['SEF_FOLDER']) {
        $componentPage = 'brends';
    }

    if (empty($componentPage)) {
        \Bitrix\Iblock\Component\Tools::process404(
            trim($arParams['MESSAGE_404']) ?: 'Элемент или раздел инфоблока не найден',
            true,
            $arParams['SET_STATUS_404'] === 'Y',
            $arParams['SHOW_404'] === 'Y',
            $arParams['FILE_404']
        );
        return;
    }

    $notFound = false;
    // недопустимое значение идентификатора элемента
    if ($componentPage == 'detail') {
        if ( ! (isset($arVariables['ELEMENT_ID']) && ctype_digit($arVariables['ELEMENT_ID']))) {
            $notFound = true;
        }
    }
    
    if ($componentPage == 'models') {
        if (!(isset($arVariables['BRAND']) && ctype_digit($arVariables['BRAND']))) {
            $notFound = true;
        }
    }
    
    if ($componentPage == 'autos') {
        if (!(isset($arVariables['MODEL']) && ctype_digit($arVariables['MODEL']))) {
            $notFound = true;
        }
    }
    
    if ($componentPage == 'complactation') {
        if (!(isset($arVariables['COMP']) && ctype_digit($arVariables['COMP']))) {
            $notFound = true;
        }
    }
    
    // показываем страницу 404 Not Found
    if ($notFound) {
        \Bitrix\Iblock\Component\Tools::process404(
            trim($arParams['MESSAGE_404']) ?: 'Элемент или раздел инфоблока не найден',
            true,
            $arParams['SET_STATUS_404'] === 'Y',
            $arParams['SHOW_404'] === 'Y',
            $arParams['FILE_404']
        );
        return;
    }

    CComponentEngine::InitComponentVariables(
        $componentPage,
        null,
        array(),
        $arVariables
    );
    
    $arResult['VARIABLES'] = $arVariables;
    $arResult['FOLDER'] = $arParams['SEF_FOLDER'];
    
    if(empty($arResult['VARIABLES'])){
        $arResult['VARIABLES']['SECTION_ID'] = 1;
    }else{
        if(count($arVariables) > 1){
            $currentSection = array_pop($arVariables);
        }else{
            $currentSection = array_shift($arVariables);
        }
        $arResult['VARIABLES']['SECTION_ID'] = $componentPage . '_' . $currentSection;
    }

} else {
    /*
     * Если не включен режим поддержки ЧПУ
     */

    $arVariables = array();

    // Восстановим переменные, которые пришли в параметрах запроса и запишем их в $arVariables
    CComponentEngine::InitComponentVariables(
        false,
        null,
        $arParams['VARIABLE_ALIASES'],
        $arVariables
    );

    $componentPage = '';
    if (isset($arVariables['ELEMENT_ID']) && intval($arVariables['ELEMENT_ID']) > 0)
        $componentPage = 'detail';
    elseif (isset($arVariables['BRAND']) && intval($arVariables['BRAND']) > 0)
        $componentPage = 'models';
    elseif (isset($arVariables['MODEL']) && intval($arVariables['MODEL']) > 0)
        $componentPage = 'autos';
    elseif (isset($arVariables['COMP']) && intval($arVariables['COMP']) > 0)
        $componentPage = 'complactation';
    else
        $componentPage = 'brends';

    /*
     * Обрабытываем ситуацию, когда переданы некорректные параметры и показываем 404 Not Found
     */
    $notFound = false;
    if ($componentPage == 'detail') {
        if ( ! (isset($arVariables['ELEMENT_ID']) && ctype_digit($arVariables['ELEMENT_ID']))) {
            $notFound = true;
        }
    }
    
    if ($componentPage == 'models') {
        if (!(isset($arVariables['BRAND']) && ctype_digit($arVariables['BRAND']))) {
            $notFound = true;
        }
    }
    
    if ($componentPage == 'autos') {
        if (!(isset($arVariables['MODEL']) && ctype_digit($arVariables['MODEL']))) {
            $notFound = true;
        }
    }
    
    if ($componentPage == 'complactation') {
        if (!(isset($arVariables['COMP']) && ctype_digit($arVariables['COMP']))) {
            $notFound = true;
        }
    }
    // показываем страницу 404 Not Found
    if ($notFound) {
        \Bitrix\Iblock\Component\Tools::process404(
            trim($arParams['MESSAGE_404']) ?: 'Элемент или раздел инфоблока не найден',
            true,
            $arParams['SET_STATUS_404'] === 'Y',
            $arParams['SHOW_404'] === 'Y',
            $arParams['FILE_404']
        );
        return;
    }

    $arResult['VARIABLES'] = $arVariables;
    $arResult['FOLDER'] = $arParams['SEF_FOLDER'];
    
    if(empty($arResult['VARIABLES'])){
        $arResult['VARIABLES']['SECTION_ID'] = 1;
    }else{
        if(count($arVariables) > 1){
            $currentSection = array_pop($arVariables);
        }else{
            $currentSection = array_shift($arVariables);
        }
        $arResult['VARIABLES']['SECTION_ID'] = $componentPage . '_' . $currentSection;
    }

}

$this->IncludeComponentTemplate($componentPage);