<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>
<div class="bx-auth-reg">

<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
<?
/*
if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0)
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?endif
*/
?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>

<p><input name="REGISTER[NAME]" min="3" type="text" placeholder="Ваше Имя..."/><i class="ico_user"></i></p>
<p><input name="REGISTER[EMAIL]" type="text" placeholder="Ваш E-mail..."/><i class="ico_msg"></i></p>
<p><input name="REGISTER[PASSWORD]" type="password" placeholder="Введите Пароль..."/><i class="ico_key"></i></p>
<p><input name="REGISTER[CONFIRM_PASSWORD]" type="password" placeholder="Повторите Пароль..."/><i class="ico_key"></i></p>
<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
	<p>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
		<input type="text" name="captcha_word" maxlength="50" value="" placeholder="<?=GetMessage("REGISTER_CAPTCHA_PROMT")?>">
	</p>
	<?
}
/* !CAPTCHA */
?>
	<div>
		<input type="submit" name="register_submit_button" value="Зарегистрироваться"/><br />
		<a id="auth_form_show" href="javascript:void(0)">Вход</a>
	</div>

</form>
<?endif?>
</div>