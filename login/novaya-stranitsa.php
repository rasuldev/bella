<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?><?$APPLICATION->IncludeComponent("bitrix:main.register","my_reg_template",Array(
				"AUTH" => "Y",
				"REQUIRED_FIELDS" => array(
						'EMAIL',
						'PASSWORD',
						'CONFIRM_PASSWORD'),
				"SET_TITLE" => "Y",
				"SHOW_FIELDS" => array(
						'EMAIL',
						'PASSWORD',
						'CONFIRM_PASSWORD'),
				"SUCCESS_PAGE" => "",
				"USER_PROPERTY" => array(),
				"USER_PROPERTY_NAME" => "",
				"USE_BACKURL" => "Y"
		)
);?>
	<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>