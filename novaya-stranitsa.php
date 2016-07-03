<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"",
	Array("SHOW_ERRORS" => "Y")
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>