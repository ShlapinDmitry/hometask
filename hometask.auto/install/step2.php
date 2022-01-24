<?if(!check_bitrix_sessid()) return;?>
<?
echo CAdminMessage::ShowNote("Модуль каталог автомобилей установлен");
?>
<form action="<?= $APPLICATION->getCurPage(); ?>"> <!-- Кнопка возврата к списку модулей -->
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID; ?>" />
    <input type="submit" value="Вернуться в список модулей">
</form>