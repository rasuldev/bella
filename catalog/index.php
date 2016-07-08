<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");
?>


<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "navi", Array(
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "N",    // Показывать количество элементов в разделе
    "IBLOCK_ID" => "2",    // Инфоблок
    "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
),
    false
); ?>

    <div id="main_container">

        <div class="inner_page clear">
            <div class="row">
                <div class="col-lg-12" id="navigation">
                    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => "-"
                    ),
                        false,
                        Array('HIDE_ICONS' => 'Y')
                    ); ?>
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
                            while ($ar_result = $db_list->GetNext()) {

                                // var_dump($ar_result);
                                ?>
                                <li>
                                    <input id="check_<?=$ar_result['ID']?>" type="checkbox"/>
                                    <a class="ico_plus_min" href="javascript:void(0);">
                                    <label for="check_<?=$ar_result['ID']?>">
                                        <?=$ar_result['NAME']?>
                                    </label>
                                    </a>
                                    <ul class="active_tab">
                                        <?php
                                        $db_inner = CIBlockSection::GetList(array('sort' => 'asc'), array(
                                            'DEPTH_LEVEL' => 2,
                                            'IBLOCK_ID' => $ar_result['IBLOCK_ID'],
                                            '>LEFT_MARGIN' => $ar_result['LEFT_MARGIN'], '<RIGHT_MARGIN' => $ar_result['RIGHT_MARGIN']
                                        ));
                                        while ($ar_inner = $db_inner->GetNext()) {
                                            echo '<li><a href="' . $ar_inner['SECTION_PAGE_URL'] . '">' . $ar_inner['NAME'] . '</a></li>';
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            }
                            ?>
                            <li>
                                <input id="check_brand" type="checkbox"/>
                                <a class="ico_plus_min" href="javascript:void(0);"><label for="check_brand">По
                                        бренду</label></a>
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
                                    while ($arData = $rsData->Fetch()) {
                                        ?>
                                        <li>
                                            <a href=<? echo '"?brand=', $arData['UF_XML_ID'], '"'; ?>><? echo $arData['UF_NAME']; ?></a>
                                        </li>
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
                                <input type="text" id="min_price" name="min_price" readonly/>
                                <input type="text" id="max_price" name="max_price" readonly/>
                                <a class="but_price js_submit">Найти</a>
                            </div>
                        </form>
                        <input type="hidden" id="min_price_range" value="0" />
                        <input type="hidden" id="max_price_range" value="3000" />
                        <input type="hidden" id="min_price_start" value="<?= intval($_GET['min_price'] ? $_GET['min_price'] : 0) ?>" />
                        <input type="hidden" id="max_price_start" value="<?= intval($_GET['max_price'] ? $_GET['max_price'] : 3000) ?>" />
                    </aside>

                    <aside class="have_banner">
                        <div class="sidebar_banner">
                            <? $APPLICATION->IncludeComponent(
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
                            ); ?>
                        </div>
                    </aside>

                    <aside>
                        <h3>Популярные товары</h3>
                        <?php
                        $res = CIBlockElement::GetList(
                            array("SORT" => "ASC"),
                            array('IBLOCK_TYPE' => 'catalog'),
                            false,
                            array('nTopCount' => 3)
                        );
                        while ($ob = $res->GetNextElement()) {
                            $arFields = $ob->GetFields();
                            $img = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
                            $price = CPrice::GetBasePrice($arFields['ID']);
                            ?>
                            <div class="new_prod clear">
                                <a href="#"><img src="<?= $img['SRC'] ?>" alt=""/></a>

                                <div>
                                    <? $APPLICATION->IncludeComponent(
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
                                    ); ?>
                                    <!--<p class="stars_prod">
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                    </p>-->
                                    <p class="name_tov"><a
                                            href="<?= $arFields['DETAIL_PAGE_URL'] ?>"><?= $arFields['NAME'] ?></a></p>

                                    <p class="name_price">
                                        <?php /*<span class="old_price">18 000 ₷</span>*/
                                        ?>
                                        <span class="new_price"><?= $price['PRICE'] ?> ₷</span>
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
                            '>=CATALOG_PRICE_1' => $_GET['min_price'] ? $_GET['min_price'] : 0,
                            '<=CATALOG_PRICE_1' => $_GET['max_price'] ? $_GET['max_price'] : 3000,
                            'PROPERTY_BRAND_REF' => $_GET['brand'] ? $_GET['brand'] : ""
                        );
                        ?>

                        <?$APPLICATION->IncludeComponent(
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



                    </div><!--prod_list-->
                </div><!--all_products-->
            </div><!--product_filter-->
        </div>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>