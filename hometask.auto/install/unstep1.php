<form action="<?=$APPLICATION->GetCurPage()?>" onsubmit="this['inst'].disabled=true; return true;">
<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?=LANG?>">
	<input type="hidden" name="id" value="hometask.auto">
	<input type="hidden" name="uninstall" value="Y">
	<input type="hidden" name="step" value="2">
	<div class="adm-info-message-wrap adm-info-message-red">
		<div class="adm-info-message">
			<div class="adm-info-message-title">Внимание!<br>
				Модуль будет удален из системы</div>
			<div class="adm-info-message-icon"></div>
		</div>
	</div>
	<p>Вы можете сохранить данные в таблицах базы данных:</p>
	<p><input type="checkbox" name="savedata" id="savedata" value="Y" checked><label for="savedata">Сохранить таблицы</label></p>
	<input type="submit" name="inst" value="Удалить модуль" />
</form>