<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);
$theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<?$APPLICATION->ShowHead();?>
	<link href="<?=SITE_TEMPLATE_PATH?>/favicon.ico?ver=2" rel="shortcut icon" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/style.css"/>

</head>

<body id="wrapper">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

<header>

	<div class="h_top clear">
		<div class="clear">

<?$APPLICATION->IncludeComponent("bitrix:search.title", "search", Array(
	"NUM_CATEGORIES" => "1",	// Количество категорий поиска
		"TOP_COUNT" => "5",	// Количество результатов в каждой категории
		"CHECK_DATES" => "N",	// Искать только в активных по дате документах
		"SHOW_OTHERS" => "N",	// Показывать категорию "прочее"
		"PAGE" => SITE_DIR."catalog/",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
		"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),	// Название категории
		"CATEGORY_0" => array(	// Ограничение области поиска
			0 => "iblock_catalog",
		),
		"CATEGORY_0_iblock_catalog" => array(	// Искать в информационных блоках типа "iblock_catalog"
			0 => "all",
		),
		"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
		"SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
		"INPUT_ID" => "title-search-input",	// ID строки ввода поискового запроса
		"CONTAINER_ID" => "search",	// ID контейнера, по ширине которого будут выводиться результаты
		"PRICE_CODE" => array(	// Тип цены
			0 => "BASE",
		),
		"SHOW_PREVIEW" => "Y",	// Показать картинку
		"PREVIEW_WIDTH" => "75",	// Ширина картинки
		"PREVIEW_HEIGHT" => "75",	// Высота картинки
		"CONVERT_CURRENCY" => "Y",	// Показывать цены в одной валюте
	),
	false
);?>


<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "template1", Array(
	"PATH_TO_BASKET" => SITE_DIR."personal/cart/",	// Страница корзины
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",	// Страница персонального раздела
		"SHOW_PERSONAL_LINK" => "N",	// Отображать персональный раздел
		"SHOW_NUM_PRODUCTS" => "Y",	// Показывать количество товаров
		"SHOW_TOTAL_PRICE" => "Y",	// Показывать общую сумму по товарам
		"SHOW_PRODUCTS" => "N",	// Показывать список товаров
		"POSITION_FIXED" => "N",	// Отображать корзину поверх шаблона
		"SHOW_AUTHOR" => "Y",	// Добавить возможность авторизации
		"PATH_TO_REGISTER" => SITE_DIR."login/",	// Страница регистрации
		"PATH_TO_PROFILE" => SITE_DIR."personal/",	// Страница профиля
	),
	false
);?>


			<div class="contact_center">
				<a href="tel:"><i class="ico_tel"></i><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></a>
				<a href="mailto:"><i class="ico_plane"></i>info@bellashop.ru</a>
			</div> <!--contact_center-->

		</div>
	</div> <!--h_top-->
	<div class="h_bot clear">
		<a href="/" class="logo">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo.php"), false);?>
		</a>
		<a class="burger_menu" href="javascript:void(0)"><i class="ico_burg"></i></a>

<?$APPLICATION->IncludeComponent("bitrix:menu", "main_menu", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
			0 => "",
		),
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	),
	false
);?>


			<? /* $APPLICATION->IncludeComponent("bitrix:menu", "catalog_horizontal", array(
					"ROOT_MENU_TYPE" => "left",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_THEME" => "site",
					"CACHE_SELECTED_ITEMS" => "N",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MAX_LEVEL" => "3",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "Y",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N",
				),
				false
			);*/ ?>
	</div><!--h_bot-->

</header> <!-- header -->

<?/*if ($curPage != SITE_DIR."index.php"):?>
<div class="row">
	<div class="col-lg-12" id="navigation">
		<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
				"START_FROM" => "0",
				"PATH" => "",
				"SITE_ID" => "-"
			),
			false,
			Array('HIDE_ICONS' => 'Y')
		);?>
	</div>
</div>
<h1 class="bx-title dbg_title" id="pagetitle"><?=$APPLICATION->ShowTitle(false);?></h1>
<?endif */
?>

			<?$needSidebar = preg_match("~^".SITE_DIR."(catalog|personal/cart|personal/order)/~", $curPage);?>
				<!-- <div class="bx-content <?=($needSidebar ? "col-xs-12" : "col-md-9 col-sm-8")?>"> -->