<?php

/**
 * Description of index
 *
 * @author dmitry
 */

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

Loc::loadMessages(__FILE__);

class hometask_auto extends CModule{
    public $MODULE_ID = "hometask.auto";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_CSS;
    
    function __construct()
    {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

        $this->MODULE_NAME = Loc::getMessage('MODULE_AUTO_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_AUTO_DESCRIPTION');
    }

    function InstallFiles()
    {
        CopyDirFiles(
            $_SERVER["DOCUMENT_ROOT"]."/local/modules/hometask.auto/install/components",
            $_SERVER["DOCUMENT_ROOT"]."/local/components",
            true,
            true
        );
        return true;
    }

    function UnInstallFiles()
    {
        return true;
    }
    
    public function InstallDB()
    {
        global $APPLICATION, $DB, $errors;
        if(!array_key_exists("reloaddata", $arParams) || $arParams["reloaddata"] == "Y")
        {
            $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/local/modules/hometask.auto/install/db/uninstall.sql");
            $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/local/modules/hometask.auto/install/db/install.sql");
        }
        
        return true;
    }
    
    function UnInstallDB($arParams = Array())
    {
        global $APPLICATION, $DB, $errors;
        
        if(!array_key_exists("savedata", $arParams) || $arParams["savedata"] != "Y")
        {
            $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/local/modules/hometask.auto/install/db/uninstall.sql");
        }
        return true;
    }

    function DoInstall()
    {
        global $APPLICATION;
        if (!check_bitrix_sessid()) {
            return false;
        }
        $step = intval($_REQUEST["step"]);
        if($step<2)
                $APPLICATION->IncludeAdminFile("Будет установлен модуль Каталог автомобилей", $_SERVER["DOCUMENT_ROOT"]."/local/modules/hometask.auto/install/step1.php");
        else
        {
            $this->InstallFiles();
            $this->InstallDB(array(
                "reloaddata" => $_REQUEST["reloaddata"],
            ));
            RegisterModule($this->MODULE_ID);
            $APPLICATION->IncludeAdminFile("Установка модуля Каталог автомобилей", $_SERVER["DOCUMENT_ROOT"]."/local/modules/hometask.auto/install/step2.php");
        }
    }

    function DoUninstall()
    {
        global $APPLICATION;
        if (!check_bitrix_sessid()) {
            return false;
        }
        $step = intval($_REQUEST["step"]);
        if($step<2)
                $APPLICATION->IncludeAdminFile("Модуль будет удален из системы", $_SERVER["DOCUMENT_ROOT"]."/local/modules/hometask.auto/install/unstep1.php");
        else
        {
            $this->UnInstallFiles();
            $this->UnInstallDB(array(
                "savedata" => $_REQUEST["savedata"],
            ));
            UnRegisterModule($this->MODULE_ID);
            $APPLICATION->IncludeAdminFile("Деинсталляция модуля cataloauto", $_SERVER["DOCUMENT_ROOT"]."/local/modules/hometask.auto/install/unstep2.php");
        }
    }
}