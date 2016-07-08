<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");
?>



<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "navi", Array(
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"IBLOCK_ID" => "2",	// Инфоблок
		"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
	),
	false
);?>

    <div id="main_container">

        <div class="inner_page clear">
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

        <div class="product_filter clear">
            <div class="sidebar">

                <!-- <p class="clear show_f"> <a class="burger_menu" href="javascript:void(0)"><i class="ico_burg"></i></a> Показать фильтр </p> -->
                <aside class="filtr_prod">
                <br>
                    <h3>Категории</h3>
                    <ul>
                        <?php
                            $db_list = CIBlockSection::GetList(array('sort' => 'asc'), array('DEPTH_LEVEL' => 1));
                            while ($ar_result = $db_list->GetNext())
                            {

                                // var_dump($ar_result);
                               ?>
                               <li>
                                   <input id="check_<?=$ar_result['ID']?>" type="checkbox"/>
                                   <a class="ico_plus_min" href="javascript:void(0);"><label for="check_<?=$ar_result['ID']?>"><?=$ar_result['NAME']?></label></a>

                                   <ul class="active_tab">
                                   <?php
                                $db_inner = CIBlockSection::GetList(array('sort' => 'asc'), array(
                                    'DEPTH_LEVEL' => 2,
                                    'IBLOCK_ID' => $ar_result['IBLOCK_ID'],
                                    '>LEFT_MARGIN' => $ar_result['LEFT_MARGIN'],'<RIGHT_MARGIN' => $ar_result['RIGHT_MARGIN']
                                ));
                                while ($ar_inner = $db_inner->GetNext()) {
                                    echo '<li><a href="'.$ar_inner['SECTION_PAGE_URL'].'">'.$ar_inner['NAME'].'</a></li>';
                                }
                                   ?>
                                   </ul>
                               </li>
                               <?php
                            }
                        ?>
                        <!--
                        <li>
                            <input id="check_4" type="checkbox"/>
                            <a class="ico_plus_min" href="javascript:void(0);"><label for="check_4">Предметы Интерьера</label></a>
                        </li>
                        <li>
                            <input id="check_5" type="checkbox"/>
                            <a class="ico_plus_min" href="javascript:void(0);"><label for="check_5">По стране</label></a>
                        </li>
                        <li>
                            <input id="check_6" type="checkbox"/>
                            <a class="ico_plus_min" href="javascript:void(0);"><label for="check_6">По цвету</label></a>
                        </li>-->
                        <li>
                            <input id="check_brand" type="checkbox"/>
                            <a class="ico_plus_min" href="javascript:void(0);"><label for="check_brand">По бренду</label></a>
							<ul class="active_tab">
								<?
								CModule::IncludeModule("highloadblock"); // подключить инфоблоки
								use Bitrix\Highloadblock as HL;
								use Bitrix\Main\Entity;
								$hlblock_id = 2;// id инфоблока
								$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();

								$entity = HL\HighloadBlockTable::compileEntity($hlblock);
								$entity_data_class = $entity->getDataClass();
								$rsData = $entity_data_class::getList(array(
									"select" => array("*"),
									"order" => array("ID" => "ASC")
								));
								while($arData = $rsData->Fetch())
								{
									?>
									<li><a href=<?echo '"?brand=', $arData['UF_XML_ID'], '"';?>><?echo $arData['UF_NAME'];?></a></li>
									<?
								}
								?>
							</ul>
                        </li>
                    </ul>

                </aside>

                <aside class="price_filter">
                    <form action="">
                    <h3>Фильтр по цене</h3>
                    <div id="slider-range"></div>
                    <div class="slider_price">
                        <input type="text" id="min_price" name="min_price" readonly/><input type="text" id="max_price" name="max_price" readonly/>
                        <a class="but_price js_submit">Найти</a>
                    </div>
                    </form>
                    <input type="hidden" id="min_price_range" value="0">
                    <input type="hidden" id="max_price_range" value="3000">
                    <input type="hidden" id="min_price_start" value="<?=intval($_GET['min_price']?$_GET['min_price']:0)?>">
                    <input type="hidden" id="max_price_start" value="<?=intval($_GET['max_price']?$_GET['max_price']:3000)?>">
                </aside>

                <aside class="have_banner">
                    <div class="sidebar_banner">
						<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"slychainaya_akciya",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "#SECTION_CODE#/#CODE#",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "NAME",
			3 => "PREVIEW_TEXT",
			4 => "PREVIEW_PICTURE",
			5 => "DETAIL_TEXT",
			6 => "DETAIL_PICTURE",
			7 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "offers",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
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
		"PROPERTY_CODE" => array(
			0 => "akcii_skidka",
			1 => "akcii_element",
			2 => "",
		),
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
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "slychainaya_akciya"
	),
	false
);?>
                    </div>
                </aside>

                <aside>
                    <h3>Популярные товары</h3>
                    <?php
                        $res = CIBlockElement::GetList(
                            array("SORT"=>"ASC"),
                            array('IBLOCK_TYPE' => 'catalog'),
                            false,
                            array('nTopCount' => 3)
                        );
                        while($ob = $res->GetNextElement())
                        {
                            $arFields = $ob->GetFields();
                            $img = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
                            $price = CPrice::GetBasePrice($arFields['ID']);
                            ?>
                            <div class="new_prod clear">
                                <a href="#"><img src="<?=$img['SRC']?>" alt=""/></a>
                                <div>
									<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote",
	"footer_stars",
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "2",
		"ELEMENT_ID" => $arFields["ID"],
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array(
			0 => "1",
			1 => "2",
			2 => "3",
			3 => "4",
			4 => "5",
			5 => "",
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"COMPONENT_TEMPLATE" => "footer_stars",
		"ELEMENT_CODE" => $_REQUEST["CODE"],
		"SET_STATUS_404" => "N",
		"MESSAGE_404" => "",
		"DISPLAY_AS_RATING" => "rating",
		"SHOW_RATING" => "N"
	),
	$component
);?>
                                    <!--<p class="stars_prod">
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                    </p>-->
                                    <p class="name_tov"><a href="<?=$arFields['DETAIL_PAGE_URL']?>"><?=$arFields['NAME']?></a></p>
                                    <p class="name_price">
                                        <?php /*<span class="old_price">18 000 ₷</span>*/?>
                                        <span class="new_price"><?=$price['PRICE']?> ₷</span>
                                    </p>
                                </div>
                            </div><!--new_prod-->
                            <?php
                        }
                    ?>
                </aside>
            </div><!--sidebar-->

            <div class="all_products">

                <div class="about_product clear">
        <?php
        $arrFilter = array(
			'>=CATALOG_PRICE_1' => $_GET['min_price']?$_GET['min_price']:0,
			'<=CATALOG_PRICE_1' => $_GET['max_price']?$_GET['max_price']:3000,
			'PROPERTY_BRAND_REF' => $_GET['brand']?$_GET['brand']:""
		);
        ?>
					        <? $APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						"catalog",
						array(
							"IBLOCK_TYPE_ID" => "catalog",
							"IBLOCK_ID" => "2",
							"BASKET_URL" => "/personal/cart/",
							"COMPONENT_TEMPLATE" => "catalog",
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
							"OFFERS_LIMIT" => "9",
							"TEMPLATE_THEME" => "site",
							"PRODUCT_DISPLAY_MODE" => "Y",
							"ADD_PICT_PROP" => "MORE_PHOTO",
							"LABEL_PROP" => "-",
							"OFFER_ADD_PICT_PROP" => "-",
							"OFFER_TREE_PROPS" => array(
								0 => "COLOR_REF",
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
							"SEF_MODE" => "Y",
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
							"PRICE_VAT_INCLUDE" => "N",
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
							"MESSAGE_404" => "",
							"BACKGROUND_IMAGE" => "-",
							"SEF_RULE" => "",
							"SECTION_CODE_PATH" => "",
							"DISABLE_INIT_JS_IN_COMPONENT" => "N"
						),
						false
					);?>

					<? $APPLICATION->IncludeComponent(
	"bitrix:catalog",
	"template1",
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "2",
		"TEMPLATE_THEME" => "site",
		"HIDE_NOT_AVAILABLE" => "N",
		"BASKET_URL" => "/personal/cart/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/catalog/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"ADD_SECTION_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"SET_STATUS_404" => "Y",
		"DETAIL_DISPLAY_NAME" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "",
		"FILTER_VIEW_MODE" => "VERTICAL",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PRICE_CODE" => array(
			0 => "BASE",
		),
		"FILTER_OFFERS_FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"USE_REVIEW" => "N",
		"MESSAGES_PER_PAGE" => "10",
		"USE_CAPTCHA" => "Y",
		"REVIEW_AJAX_POST" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"FORUM_ID" => "1",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "Y",
		"USE_COMPARE" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"USE_PRODUCT_QUANTITY" => "Y",
		"CONVERT_CURRENCY" => "N",
		"QUANTITY_FLOAT" => "N",
		"OFFERS_CART_PROPERTIES" => array(
			0 => "COLOR_REF",
		),
		"SHOW_TOP_ELEMENTS" => "N",
		"SECTION_COUNT_ELEMENTS" => "N",
		"SECTION_TOP_DEPTH" => "1",
		"SECTIONS_VIEW_MODE" => "TILE",
		"SECTIONS_SHOW_PARENT_NAME" => "N",
		"PAGE_ELEMENT_COUNT" => "15",
		"LINE_ELEMENT_COUNT" => "3",
		"ELEMENT_SORT_FIELD" => "desc",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"LIST_PROPERTY_CODE" => array(
			0 => "NEWPRODUCT",
			1 => "SALELEADER",
			2 => "SPECIALOFFER",
			3 => "",
		),
		"INCLUDE_SUBSECTIONS" => "Y",
		"LIST_META_KEYWORDS" => "UF_KEYWORDS",
		"LIST_META_DESCRIPTION" => "UF_META_DESCRIPTION",
		"LIST_BROWSER_TITLE" => "UF_BROWSER_TITLE",
		"LIST_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"LIST_OFFERS_PROPERTY_CODE" => array(
			0 => "ARTNUMBER",
			1 => "COLOR_REF",
			2 => "MORE_PHOTO",
			3 => "SIZES_SHOES",
			4 => "SIZES_CLOTHES",
			5 => "",
		),
		"LIST_OFFERS_LIMIT" => "0",
		"SECTION_BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "NEWPRODUCT",
			1 => "MANUFACTURER",
			2 => "MATERIAL",
			3 => "NAME",
			4 => "DETAIL_TEXT",
			5 => "ID",
			6 => "DETAIL_PICTURE",
			7 => "SECTION_ID",
			8 => "SECTION_CODE",
			9 => "SECTION_NAME",
			10 => "PREVIEW_TEXT",
			11 => "",
		),
		"DETAIL_META_KEYWORDS" => "KEYWORDS",
		"DETAIL_META_DESCRIPTION" => "META_DESCRIPTION",
		"DETAIL_BROWSER_TITLE" => "TITLE",
		"DETAIL_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"DETAIL_OFFERS_PROPERTY_CODE" => array(
			0 => "ARTNUMBER",
			1 => "COLOR_REF",
			2 => "MORE_PHOTO",
			3 => "SIZES_SHOES",
			4 => "SIZES_CLOTHES",
			5 => "",
		),
		"DETAIL_BACKGROUND_IMAGE" => "BACKGROUND_IMAGE",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"USE_ALSO_BUY" => "Y",
		"ALSO_BUY_ELEMENT_COUNT" => "4",
		"ALSO_BUY_MIN_BUYES" => "1",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "desc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGER_TEMPLATE" => "round",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
		"PAGER_SHOW_ALL" => "N",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"LABEL_PROP" => "NEWPRODUCT",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_TREE_PROPS" => array(
			0 => "COLOR_REF",
		),
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"DETAIL_USE_VOTE_RATING" => "Y",
		"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
		"DETAIL_USE_COMMENTS" => "N",
		"DETAIL_BLOG_USE" => "Y",
		"DETAIL_VK_USE" => "N",
		"DETAIL_FB_USE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"USE_STORE" => "Y",
		"FIELDS" => array(
			0 => "SCHEDULE",
			1 => "STORE",
			2 => "",
		),
		"USE_MIN_AMOUNT" => "N",
		"STORE_PATH" => "/store/#store_id#",
		"MAIN_TITLE" => "Наличие на складах",
		"MIN_AMOUNT" => "10",
		"DETAIL_BRAND_USE" => "Y",
		"DETAIL_BRAND_PROP_CODE" => array(
			0 => "BRAND_REF",
			1 => "",
		),
		"SIDEBAR_SECTION_SHOW" => "Y",
		"SIDEBAR_DETAIL_SHOW" => "Y",
		"SIDEBAR_PATH" => "/catalog/sidebar.php",
		"COMPONENT_TEMPLATE" => "template1",
		"COMMON_SHOW_CLOSE_POPUP" => "N",
		"DETAIL_SHOW_MAX_QUANTITY" => "N",
		"DETAIL_BLOG_URL" => "catalog_comments",
		"DETAIL_BLOG_EMAIL_NOTIFY" => "N",
		"DETAIL_FB_APP_ID" => "",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"USE_SALE_BESTSELLERS" => "Y",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
		"COMMON_ADD_TO_BASKET_ACTION" => "",
		"TOP_ADD_TO_BASKET_ACTION" => "ADD",
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"DETAIL_ADD_TO_BASKET_ACTION" => array(
			0 => "ADD",
		),
		"DETAIL_SHOW_BASIS_PRICE" => "Y",
		"SECTIONS_HIDE_SECTION_NAME" => "N",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"SHOW_DEACTIVATED" => "N",
		"DETAIL_DETAIL_PICTURE_MODE" => "IMG",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_SECTION" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"STORES" => array(
		),
		"USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GENERAL_STORE_INFORMATION" => "N",
		"USE_BIG_DATA" => "N",
		"BIG_DATA_RCM_TYPE" => "bestsell",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE#/",
			"element" => "#SECTION_CODE#/#ELEMENT_CODE#",
			"compare" => "compare/",
			"smart_filter" => "#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
		)
	),
	false
); ?>

                </div><!--prod_list-->
                <!--
                <div class="pagi_on clear">
                    <a href="" class="prev_page"><i class="ico_left"></i></a>
                    <a href="" class="next_page"><i class="ico_right"></i></a>
                    <ul class="clear">
                        <li><a href="">1</a></li>
                        <li><a class="active" href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href="">5</a></li>
                    </ul>
                </div><!--pagi_on-->

            </div><!--all_products-->

        </div><!--product_filter-->

        </div>

    </div>

<!--  -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>