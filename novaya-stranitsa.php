<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?><?$APPLICATION->IncludeComponent(
	"ulogin:auth",
	"",
	Array(
		"GROUP_ID" => array("5"),
		"LOGIN_AS_EMAIL" => "Y",
		"SEND_EMAIL" => "N",
		"SOCIAL_LINK" => "N",
		"ULOGINID1" => "",
		"ULOGINID2" => ""
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>