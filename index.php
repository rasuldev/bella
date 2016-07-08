<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Bellashop");
/*
?>
<?if (IsModuleInstalled("advertising")):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"bootstrap",
	array(
		"COMPONENT_TEMPLATE" => "bootstrap",
		"TYPE" => "MAIN",
		"NOINDEX" => "Y",
		"QUANTITY" => "3",
		"BS_EFFECT" => "fade",
		"BS_CYCLING" => "N",
		"BS_WRAP" => "Y",
		"BS_PAUSE" => "Y",
		"BS_KEYBOARD" => "Y",
		"BS_ARROW_NAV" => "Y",
		"BS_BULLET_NAV" => "Y",
		"BS_HIDE_FOR_TABLETS" => "N",
		"BS_HIDE_FOR_PHONES" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
	),
	false
);?>
<?endif?>

<h2>Тренды сезона</h2>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	".default",
	array(
		"IBLOCK_TYPE_ID" => "catalog",
		"IBLOCK_ID" => "2",
		"BASKET_URL" => "/personal/cart/",
		"COMPONENT_TEMPLATE" => "",
		"IBLOCK_TYPE" => "catalog",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "12",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "COLOR_REF",
			1 => "SIZES_SHOES",
			2 => "SIZES_CLOTHES",
			3 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "desc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "5",
		"TEMPLATE_THEME" => "site",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"LABEL_PROP" => "-",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => array(
			0 => "COLOR_REF",
			1 => "SIZES_SHOES",
			2 => "SIZES_CLOTHES",
		),
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"OFFERS_CART_PROPERTIES" => array(
			0 => "COLOR_REF",
			1 => "SIZES_SHOES",
			2 => "SIZES_CLOTHES",
		),
		"ADD_TO_BASKET_ACTION" => "ADD",
		"PAGER_TEMPLATE" => "round",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);*/?><!--<div id="slider" class="clear">
	<div class="slider">
		<ul class="slides">
			<li class="slide"> <img src="/bitrix/templates/eshop_bootstrap_black/img/slide.jpg" alt="">
			<div>
				<h4>Сервиз "синее барокко"</h4>
				<p>
					 Claritas est etiam processus dynamicus, qui sequitur <br>
					 mutationem consuetudium lectorum.
				</p>
			</div>
 </li>
			<li class="slide"> <img src="/bitrix/templates/eshop_bootstrap_black/img/slide.jpg" alt="">
			<div>
				<h4>Сервиз "синее барокко"</h4>
				<p>
					 Claritas est etiam processus dynamicus, qui sequitur <br>
					 mutationem consuetudium lectorum.
				</p>
			</div>
 </li>
			<li class="slide"> <img src="/bitrix/templates/eshop_bootstrap_black/img/slide.jpg" alt="">
			<div>
				<h4>Сервиз "синее барокко"</h4>
				<p>
					 Claritas est etiam processus dynamicus, qui sequitur <br>
					 mutationem consuetudium lectorum.
				</p>
			</div>
 </li>
			<li class="slide"> <img src="/bitrix/templates/eshop_bootstrap_black/img/slide.jpg" alt="">
			<div>
				<h4>Сервиз "синее барокко"</h4>
				<p>
					 Claritas est etiam processus dynamicus, qui sequitur <br>
					 mutationem consuetudium lectorum.
				</p>
			</div>
 </li>
		</ul>
	</div>
</div>--> <!--slider-->&nbsp;<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"main_slider",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "main_slider",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "services",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"TITLE",1=>"TEXT",2=>"",),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?><br>
<div id="main_container">
	<div class="banner_block clear">
 <aside class="wow zoomIn"> <a href="#"> <img src="/bitrix/templates/eshop_bootstrap_black/img/banner1.jpg" alt="">
		<p>
			 столовый сервиз <br>
			 болеро
		</p>
 </a> </aside> <aside class="wow zoomIn"> <a href="#"> <img src="/bitrix/templates/eshop_bootstrap_black/img/baner2.jpg" alt="">
		<p>
			 столовый сервиз <br>
			 фрукты зеленные
		</p>
 </a> </aside>
	</div>
	 <!--banner_block-->
	<div class="popular_tovar clear">
		<h2>популярные товары</h2>
		<ul class="bxslider clear">
			<li> <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_1"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> </li>
			<li> <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_1"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> </li>
			<li> <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_1"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> </li>
			<li> <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_1"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> </li>
			<li> <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_1"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> </li>
		</ul>
	</div>
	 <!--popular_tovar-->
	<div class="banner_akcii">
		<div>
			<h2 class="wow zoomIn"><a href="#">Столовый сервиз «тереза» всего за 20 000 ₷</a></h2>
		</div>
	</div>
	 <!--banner_akcii-->
	<div class="recomend_tovar clear">
		<h2>рекомендуемые товары</h2>
		<div class="product_block clear">
 <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_1"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_3"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_2"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a class="in_cart" href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_1"></i> <i class="sprite_2"></i> <i class="sprite_3"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="old_price">1 927 ₽</span> <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a class="in_cart" href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_1"></i> <i class="sprite_2"></i> <i class="sprite_3"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="old_price">1 927 ₽</span> <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a class="in_cart" href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_1"></i> <i class="sprite_2"></i> <i class="sprite_3"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="old_price">1 927 ₽</span> <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> <aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a class="in_cart" href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_1"></i> <i class="sprite_2"></i> <i class="sprite_3"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="old_price">1 927 ₽</span> <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--><aside class="prod"> <figure> <a class="img_prod" href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/product.jpg" alt=""></a>
			<p class="hover_prod">
 <a class="in_cart" href="#"><i class="ico_cart"></i></a>
			</p>
			 <!--hover_prod-->
			<p class="skidki_prod">
 <i class="sprite_1"></i> <i class="sprite_2"></i> <i class="sprite_3"></i>
			</p>
			 <!--skidki_prod-->
			<p class="stars_prod">
 <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i> <i class="ico_star"></i>
			</p>
			 <!--stars_prod--> </figure>
			<p class="cat_prod">
 <a href="#">Категория</a>
			</p>
			<p class="name_prod">
 <a href="#">набор «Медовая Золотая»</a>
			</p>
			<p class="price_prod">
 <span class="old_price">1 927 ₽</span> <span class="now_price">1 927 ₽</span>
			</p>
 </aside> <!--PRODUCT--> <!--<aside class="prod">
				<figure>
					<a class="img_prod" href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/product.jpg" alt=""/></a>
					<p class="hover_prod">
						<a class="in_cart" href="#"><i class="ico_cart"></i></a>
					</p>&lt;!&ndash;hover_prod&ndash;&gt;
					<p class="skidki_prod">
						<i class="sprite_1"></i>
						<i class="sprite_2"></i>
						<i class="sprite_3"></i>
					</p>&lt;!&ndash;skidki_prod&ndash;&gt;
					<p class="stars_prod">
						<i class="ico_star"></i>
						<i class="ico_star"></i>
						<i class="ico_star"></i>
						<i class="ico_star"></i>
						<i class="ico_star"></i>
					</p>&lt;!&ndash;stars_prod&ndash;&gt;
				</figure>
				<p class="cat_prod"><a href="#">Категория</a></p>
				<p class="name_prod"><a href="#">набор «Медовая Золотая»</a></p>
				<p class="price_prod">
					<span class="old_price">1 927 ₽</span>
					<span class="now_price">1 927 ₽</span>
				</p>
				<p class="but_prod">
					<a href="#" class="in_cart">в корзину</a>
				</p>
			</aside>-->
		</div>
		 <!--product_block-->
		<p class="show_all_prod">
 <a href="#">посмотреть больше товаров</a>
		</p>
	</div>
	 <!--recomend_tovar-->
	<div class="podpiska">
		<div>
			<h2 class="wow zoomIn">подпишитесь на нашу <br>
			 рассылку</h2>
			<!--<form action="#">
				<p class="clear wow zoomIn">
 <input type="text" placeholder="Введите ваш Е-Mail"> <input type="submit" value="подписаться">
				</p>
			</form>-->
			<?$APPLICATION->IncludeComponent(
				"bitrix:sender.subscribe",
				"index_subscribe",
				Array(
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_TIME" => "3600",
					"CACHE_TYPE" => "A",
					"CONFIRMATION" => "Y",
					"SET_TITLE" => "Y",
					"SHOW_HIDDEN" => "N",
					"USE_PERSONALIZATION" => "Y"
				)
			);?>
		</div>
	</div>
	 <!--podpiska--> <!--<div class="our_brends">
		<h2>наши бренды</h2>
		<div class="slider1">
			<div class="slide">
 <a href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/01.png" alt=""></a>
			</div>
			<div class="slide">
 <a href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/02.png" alt=""></a>
			</div>
			<div class="slide">
 <a href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/03.png" alt=""></a>
			</div>
			<div class="slide">
 <a href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/04.png" alt=""></a>
			</div>
			<div class="slide">
 <a href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/05.png" alt=""></a>
			</div>
			<div class="slide">
 <a href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/01.png" alt=""></a>
			</div>
			<div class="slide">
 <a href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/02.png" alt=""></a>
			</div>
			<div class="slide">
 <a href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/03.png" alt=""></a>
			</div>
			<div class="slide">
 <a href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/04.png" alt=""></a>
			</div>
			<div class="slide">
 <a href="#"><img src="/bitrix/templates/eshop_bootstrap_black/img/05.png" alt=""></a>
			</div>
		</div>
	</div>--> <!--our_brends--> <?$APPLICATION->IncludeComponent(
	"bitrix:highloadblock.list",
	"brand_list",
	Array(
		"BLOCK_ID" => "2",
		"COMPONENT_TEMPLATE" => "brand_list",
		"DETAIL_URL" => ""
	)
);?>
</div>
 <!--#content_main--><br><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>