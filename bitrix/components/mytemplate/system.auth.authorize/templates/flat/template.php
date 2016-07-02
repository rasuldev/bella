<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

//one css for all system.auth.* forms
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
?>

<div class="bx-authform" xmlns="http://www.w3.org/1999/html">
    <?
    if (!empty($arParams["~AUTH_RESULT"])):
        $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
        ?>
        <div class="alert alert-danger"><?= nl2br(htmlspecialcharsbx($text)) ?></div>
    <? endif ?>

    <?
    if ($arResult['ERROR_MESSAGE'] <> ''):
        $text = str_replace(array("<br>", "<br />"), "\n", $arResult['ERROR_MESSAGE']);
        ?>
        <div class="alert alert-danger"><?= nl2br(htmlspecialcharsbx($text)) ?></div>
    <? endif ?>

    <h3 class="bx-title"><?= GetMessage("AUTH_PLEASE_AUTH") ?></h3>

    <? if ($arResult["AUTH_SERVICES"]): ?>
        <? $APPLICATION->IncludeComponent(
            "ulogin:auth",
            "",
            Array(
                "GROUP_ID" => array("5"),
                "LOGIN_AS_EMAIL" => "N",
                "SEND_EMAIL" => "N",
                "SOCIAL_LINK" => "N",
                "ULOGINID1" => "",
                "ULOGINID2" => ""
            )
        ); ?>

        <hr class="bxe-light">
    <? endif ?>

    <form name="form_auth" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">

        <input type="hidden" name="AUTH_FORM" value="Y"/>
        <input type="hidden" name="TYPE" value="AUTH"/>
        <? if (strlen($arResult["BACKURL"]) > 0): ?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
        <? endif ?>
        <? foreach ($arResult["POST"] as $key => $value): ?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
        <? endforeach ?>

        <div class="bx-authform-formgroup-container">
            <div class="bx-authform-input-container">
                    <p><input type="email" placeholder="Ваш E-mail..." name="USER_LOGIN" maxlength="255" value="<?= $arResult["LAST_LOGIN"] ?>" required/><i class="ico_msg"></i></p>
                    <p><input type="password" placeholder="Введите Пароль..." name="USER_PASSWORD" maxlength="255" autocomplete="off" required/><i class="ico_key"></i></p>
            </div>
        </div>

        <? if ($arResult["CAPTCHA_CODE"]): ?>
            <input type="hidden" name="captcha_sid" value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>

            <div class="bx-authform-formgroup-container dbg_captha">
                <div class="bx-authform-label-container">
                    <? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>
                </div>
                <div class="bx-captcha"><img
                        src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>" width="180"
                        height="40" alt="CAPTCHA"/></div>
                <div class="bx-authform-input-container">
                    <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off"/>
                </div>
            </div>
        <? endif; ?>

        <div class="bx-authform-formgroup-container">

            <input type="submit" class="btn btn-primary" name="Login" value="<?= GetMessage("AUTH_AUTHORIZE") ?>"/>
        </div>
    </form>

    <? if ($arParams["NOT_SHOW_LINKS"] != "Y"): ?>
        <hr class="bxe-light">

        <noindex>
            <div class="bx-authform-link-container">
                <a id="forg_p" href="javascript:void(0)"
                   rel="nofollow"><b><?= GetMessage("AUTH_FORGOT_PASSWORD_2") ?></b></a>
            </div>
        </noindex>
    <? endif ?>

    <? if ($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"): ?>
        <noindex>
            <div class="bx-authform-link-container">
                <a id="registr_form_show" href="javascript:void(0)"
                   rel="nofollow"><b><?= GetMessage("AUTH_REGISTER") ?></b></a>
            </div>
        </noindex>
    <? endif ?>

</div>

<script type="text/javascript">
    <?if (strlen($arResult["LAST_LOGIN"])>0):?>
    try {
        document.form_auth.USER_PASSWORD.focus();
    } catch (e) {
    }
    <?else:?>
    try {
        document.form_auth.USER_LOGIN.focus();
    } catch (e) {
    }
    <?endif?>
</script>

