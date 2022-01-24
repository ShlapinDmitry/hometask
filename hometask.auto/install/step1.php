<form action="<?=$APPLICATION->GetCurPage()?>" onsubmit="this['inst'].disabled=true; return true;">
<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?=LANG?>">
	<input type="hidden" name="id" value="hometask.auto">
	<input type="hidden" name="install" value="Y">
	<input type="hidden" name="step" value="2">
	<div class="adm-info-message-wrap adm-info-message-red">
		<div class="adm-info-message">
			<div class="adm-info-message-title">Внимание!<br>
				Удалить существующие таблицы и создать их заново</div>
			<div class="adm-info-message-icon"></div>
		</div>
	</div>
	<p>Вы можете сохранить данные в таблицах базы данных:</p>
	<p><input type="checkbox" name="reloaddata" id="reloaddata" value="Y" checked><label for="reloaddata">Пересоздать таблицы</label></p>
	<input type="submit" name="inst" value="Пересоздать таблицы" />
</form>