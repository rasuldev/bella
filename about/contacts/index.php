<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<div id="main_container">

	<div class="inner_page clear">

		<div class="cont_block clear">

			<aside>
				<?$APPLICATION->IncludeComponent(
	"altasib:feedback.form", 
	"contacts", 
	array(
		"ACTIVE_ELEMENT" => "Y",
		"ADD_LEAD" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALX_CHECK_NAME_LINK" => "N",
		"BACKCOLOR_ERROR" => "#ffffff",
		"BBC_MAIL" => "",
		"BORDER_RADIUS" => "3px",
		"CAPTCHA_TYPE" => "recaptcha",
		"CATEGORY_SELECT_NAME" => "Выберите категорию",
		"CHECK_ERROR" => "Y",
		"COLOR_ERROR" => "#8E8E8E",
		"COLOR_ERROR_TITLE" => "#A90000",
		"COLOR_HINT" => "#000000",
		"COLOR_INPUT" => "#727272",
		"COLOR_MESS_OK" => "#963258",
		"COLOR_NAME" => "#000000",
		"EVENT_TYPE" => "ALX_FEEDBACK_FORM",
		"FB_TEXT_NAME" => "",
		"FB_TEXT_SOURCE" => "PREVIEW_TEXT",
		"FORM_ID" => "1",
		"HIDE_FORM" => "Y",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "altasib_feedback",
		"IMG_ERROR" => "/upload/altasib.feedback.gif",
		"IMG_OK" => "/upload/altasib.feedback.ok.gif",
		"JQUERY_EN" => "jquery",
		"LOCAL_REDIRECT_ENABLE" => "N",
		"MASKED_INPUT_PHONE" => array(
		),
		"MESSAGE_OK" => "Сообщение отправлено!",
		"NAME_ELEMENT" => "ALX_DATE",
		"PROPERTY_FIELDS" => array(
			0 => "PHONE",
			1 => "FIO",
			2 => "EMAIL",
			3 => "FEEDBACK_TEXT",
		),
		"PROPERTY_FIELDS_REQUIRED" => array(
			0 => "PHONE",
			1 => "FIO",
			2 => "EMAIL",
			3 => "FEEDBACK_TEXT",
		),
		"PROPS_AUTOCOMPLETE_EMAIL" => array(
		),
		"PROPS_AUTOCOMPLETE_NAME" => array(
		),
		"PROPS_AUTOCOMPLETE_PERSONAL_PHONE" => array(
		),
		"PROPS_AUTOCOMPLETE_VETO" => "N",
		"REWIND_FORM" => "N",
		"SECTION_MAIL_ALL" => "chrono@smtp.ru",
		"SEND_MAIL" => "N",
		"SHOW_MESSAGE_LINK" => "Y",
		"SIZE_HINT" => "10px",
		"SIZE_INPUT" => "12px",
		"SIZE_NAME" => "12px",
		"USERMAIL_FROM" => "Y",
		"USE_CAPTCHA" => "Y",
		"WIDTH_FORM" => "100%",
		"COMPONENT_TEMPLATE" => "contacts",
		"RECAPTCHA_THEME" => "light",
		"RECAPTCHA_TYPE" => "image"
	),
	false
);?>
			</aside>
			<aside>

<ul>
	<li><i class="ico_map"></i>Москва Куркино Соловьиная роща 9</li>
	<li><i class="ico_tel"></i><a href="tel:">495 540 52 52</a></li>
	<li><i class="ico_plane"></i><a href="mailto:">info@bellashop.ru</a></li>
	<li>
		<p class="soc">
			<a href=""><i class="ico_fb"></i></a>
			<a href=""><i class="ico_vk"></i></a>
			<a href=""><i class="ico_ok"></i></a>
		</p>
	</li>
</ul>

			</aside>

			<div class="map">

				<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=efsHZjno20NsiyhdX2bcJLq4GxvFCyJF&width=100%&height=460&lang=ru_RU&sourceType=constructor"></script>

			</div><!--map-->

		</div><!--cont_block-->

	</div><!--inner_page-->


</div> <!--#content_main-->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>