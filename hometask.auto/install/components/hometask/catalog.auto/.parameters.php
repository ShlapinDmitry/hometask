<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule('iblock')) {
    return;
}

/*
 * Настройки комлексного компонента
 */
$arComponentParameters = array( // кроме групп по умолчанию, добавляем свои группы настроек
    'GROUPS' => array(
        'SECTION_SETTINGS' => array(
            'NAME' => 'Настройки страницы списка',
            'SORT' => 900
        ),
        'ELEMENT_SETTINGS' => array(
            'NAME' => 'Настройки детальной страницы',
            'SORT' => 1000
        ),
    ),
    
    'PARAMETERS' => array(
        'SECTION_ELEMENT_COUNT' => array(
            'PARENT' => 'SECTION_SETTINGS',
            'NAME' => 'Количество элементов на странице',
            'TYPE' => 'STRING',
            'DEFAULT' => '2',
        ),
        
        'VARIABLE_ALIASES' => array( // это для работы в режиме без ЧПУ
            'BREND_ID' => array('NAME' => 'Идентификатор брэнда'),
            'MODEL_ID' => array('NAME' => 'Идентификатор модели брэнда'),
            'AUTO_ID' => array('NAME' => 'Идентификатор автомобилей модели'),
            'COMPL_ID' => array('NAME' => 'Идентификатор комплектаций модели'),
            'ELEMENT_ID' => array('NAME' => 'Идентификатор элемента'),
        ),
        'SEF_MODE' => array( // это для работы в режиме ЧПУ
            'brends' => array(
                'NAME' => 'Список брэндов',
                'DEFAULT' => '',
            ),
            'models' => array(
                'NAME' => 'Список моделей брэнда',
                'DEFAULT' => '#BRAND#/',
            ),
            'autos' => array(
                'NAME' => 'Список автомобилей модели',
                'DEFAULT' => '#BRAND#/#MODEL#/',
            ),
            'complactation' => array(
                'NAME' => 'Список комплектаций модели',
                'DEFAULT' => '#BRAND#/#MODEL#/#COMP#/',
            ),
            'detail' => array(
                'NAME' => 'Детальная страница автомобиля',
                'DEFAULT' => 'detail/#CAR#/',
            ),
        ),
    ),
);

// настройка постраничной навигации
CIBlockParameters::AddPagerSettings(
    $arComponentParameters,
    'Элементы',  // $pager_title
    false,       // $bDescNumbering
    true         // $bShowAllParam
);

// настройки на случай, если раздел или элемент не найдены, 404 Not Found
CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);
