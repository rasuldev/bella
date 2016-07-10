<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");
?>


<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "navi", Array("ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "N",    // Показывать количество элементов в разделе
    "IBLOCK_ID" => "2",    // Инфоблок
    "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
), false); ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <div id="main_container">

        <div class="inner_page clear">
            <div class="row">
                <div class="col-lg-12" id="navigation">
                    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array("START_FROM" => "0", "PATH" => "", "SITE_ID" => "-"), false, Array('HIDE_ICONS' => 'Y')); ?>
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
                                    <input id="check_<?= $ar_result['ID'] ?>" type="checkbox"/>
                                    <a class="ico_plus_min" href="javascript:void(0);"><label
                                            for="check_<?= $ar_result['ID'] ?>"><?= $ar_result['NAME'] ?></label></a>

                                    <ul class="active_tab">
                                        <?php
                                        $db_inner = CIBlockSection::GetList(array('sort' => 'asc'), array('DEPTH_LEVEL' => 2, 'IBLOCK_ID' => $ar_result['IBLOCK_ID'], '>LEFT_MARGIN' => $ar_result['LEFT_MARGIN'], '<RIGHT_MARGIN' => $ar_result['RIGHT_MARGIN']));
                                        while ($ar_inner = $db_inner->GetNext())
                                        {
                                            echo '<li><a href="' . $ar_inner['SECTION_PAGE_URL'] . '">' . $ar_inner['NAME'] . '</a></li>';
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
                                    $rsData = $entity_data_class::getList(array("select" => array("*"), "order" => array("ID" => "ASC")));
                                    while ($arData = $rsData->Fetch())
                                    {
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
                                <input type="text" id="min_price" name="min_price" readonly/><input type="text"
                                                                                                    id="max_price"
                                                                                                    name="max_price"
                                                                                                    readonly/>
                                <a class="but_price js_submit">Найти</a>
                            </div>
                        </form>
                        <input type="hidden" id="min_price_range" value="0">
                        <input type="hidden" id="max_price_range" value="3000">
                        <input type="hidden" id="min_price_start"
                               value="<?= intval($_GET['min_price'] ? $_GET['min_price'] : 0) ?>">
                        <input type="hidden" id="max_price_start"
                               value="<?= intval($_GET['max_price'] ? $_GET['max_price'] : 3000) ?>">
                    </aside>

                    <aside class="have_banner">
                        <div class="sidebar_banner">
                            <? $APPLICATION->IncludeComponent("bitrix:news.list", "slychainaya_akciya", array("ACTIVE_DATE_FORMAT" => "d.m.Y", "ADD_SECTIONS_CHAIN" => "N", "AJAX_MODE" => "N", "AJAX_OPTION_ADDITIONAL" => "", "AJAX_OPTION_HISTORY" => "N", "AJAX_OPTION_JUMP" => "N", "AJAX_OPTION_STYLE" => "Y", "CACHE_FILTER" => "N", "CACHE_GROUPS" => "N", "CACHE_TIME" => "36000000", "CACHE_TYPE" => "N", "CHECK_DATES" => "Y", "DETAIL_URL" => "#SECTION_CODE#/#CODE#", "DISPLAY_BOTTOM_PAGER" => "Y", "DISPLAY_DATE" => "Y", "DISPLAY_NAME" => "Y", "DISPLAY_PICTURE" => "Y", "DISPLAY_PREVIEW_TEXT" => "Y", "DISPLAY_TOP_PAGER" => "N", "FIELD_CODE" => array(0 => "ID", 1 => "CODE", 2 => "NAME", 3 => "PREVIEW_TEXT", 4 => "PREVIEW_PICTURE", 5 => "DETAIL_TEXT", 6 => "DETAIL_PICTURE", 7 => "",), "FILTER_NAME" => "", "HIDE_LINK_WHEN_NO_DETAIL" => "N", "IBLOCK_ID" => "6", "IBLOCK_TYPE" => "offers", "INCLUDE_IBLOCK_INTO_CHAIN" => "N", "INCLUDE_SUBSECTIONS" => "Y", "MESSAGE_404" => "", "NEWS_COUNT" => "20", "PAGER_BASE_LINK_ENABLE" => "N", "PAGER_DESC_NUMBERING" => "N", "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000", "PAGER_SHOW_ALL" => "N", "PAGER_SHOW_ALWAYS" => "N", "PAGER_TEMPLATE" => ".default", "PAGER_TITLE" => "Новости", "PARENT_SECTION" => "", "PARENT_SECTION_CODE" => "", "PREVIEW_TRUNCATE_LEN" => "", "PROPERTY_CODE" => array(0 => "akcii_skidka", 1 => "akcii_element", 2 => "",), "SET_BROWSER_TITLE" => "Y", "SET_LAST_MODIFIED" => "N", "SET_META_DESCRIPTION" => "Y", "SET_META_KEYWORDS" => "Y", "SET_STATUS_404" => "N", "SET_TITLE" => "Y", "SHOW_404" => "N", "SORT_BY1" => "ACTIVE_FROM", "SORT_BY2" => "SORT", "SORT_ORDER1" => "DESC", "SORT_ORDER2" => "ASC", "COMPONENT_TEMPLATE" => "slychainaya_akciya"), false); ?>
                        </div>
                    </aside>

                    <aside>
                        <h3>Популярные товары</h3>
                        <?php
                        $res = CIBlockElement::GetList(array("SORT" => "ASC"), array('IBLOCK_TYPE' => 'catalog'), false, array('nTopCount' => 3));
                        while ($ob = $res->GetNextElement())
                        {
                            $arFields = $ob->GetFields();
                            $img = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
                            $price = CPrice::GetBasePrice($arFields['ID']);
                            ?>
                            <div class="new_prod clear">
                                <a href="http://<?=$_SERVER['SERVER_NAME'].'/catalog/element/'.$arFields['CODE']?>"><img src="<?= $img['SRC'] ?>" alt=""/></a>

                                <div>
                                    <? $APPLICATION->IncludeComponent("bitrix:iblock.vote", "footer_stars", array("IBLOCK_TYPE" => "catalog", "IBLOCK_ID" => "2", "ELEMENT_ID" => $arFields["ID"], "MAX_VOTE" => "5", "VOTE_NAMES" => array(0 => "1", 1 => "2", 2 => "3", 3 => "4", 4 => "5", 5 => "",), "CACHE_TYPE" => "A", "CACHE_TIME" => $arParams["CACHE_TIME"], "COMPONENT_TEMPLATE" => "footer_stars", "ELEMENT_CODE" => $_REQUEST["CODE"], "SET_STATUS_404" => "N", "MESSAGE_404" => "", "DISPLAY_AS_RATING" => "rating", "SHOW_RATING" => "N"), $component); ?>
                                    <!--<p class="stars_prod">
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                    </p>-->
                                    <p class="name_tov"><a
                                            href="http://<?=$_SERVER['SERVER_NAME'].'/catalog/element/'.$arFields['CODE']?>"><?= $arFields['NAME'] ?></a></p>

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
                        $arrFilter = array('>=CATALOG_PRICE_1' => $_GET['min_price'] ? $_GET['min_price'] : 0, '<=CATALOG_PRICE_1' => $_GET['max_price'] ? $_GET['max_price'] : 3000, 'PROPERTY_BRAND_REF' => $_GET['brand'] ? $_GET['brand'] : "");
                        ?>
                        <? $APPLICATION->IncludeComponent("bitrix:catalog.element", "detail_template1", array("COMPONENT_TEMPLATE" => "detail_template1", "IBLOCK_TYPE" => "catalog", "IBLOCK_ID" => "2", "ELEMENT_ID" => "", "ELEMENT_CODE" => $_REQUEST["code"], "SECTION_ID" => "", "SECTION_CODE" => "", "HIDE_NOT_AVAILABLE" => "N", "PROPERTY_CODE" => array(0 => "", 1 => "",), "OFFERS_FIELD_CODE" => array(0 => "ID", 1 => "CODE", 2 => "NAME", 3 => "PREVIEW_TEXT", 4 => "PREVIEW_PICTURE", 5 => "DETAIL_TEXT", 6 => "DETAIL_PICTURE", 7 => "",), "OFFERS_PROPERTY_CODE" => array(0 => "MORE_PHOTO", 1 => "",), "OFFERS_SORT_FIELD" => "sort", "OFFERS_SORT_ORDER" => "asc", "OFFERS_SORT_FIELD2" => "id", "OFFERS_SORT_ORDER2" => "desc", "OFFERS_LIMIT" => "0", "BACKGROUND_IMAGE" => "-", "TEMPLATE_THEME" => "blue", "ADD_PICT_PROP" => "MORE_PHOTO", "LABEL_PROP" => "NEWPRODUCT", "OFFER_ADD_PICT_PROP" => "MORE_PHOTO", "OFFER_TREE_PROPS" => array(0 => "COLOR_REF",), "DISPLAY_NAME" => "Y", "DETAIL_PICTURE_MODE" => "IMG", "ADD_DETAIL_TO_SLIDER" => "Y", "DISPLAY_PREVIEW_TEXT_MODE" => "E", "PRODUCT_SUBSCRIPTION" => "N", "SHOW_DISCOUNT_PERCENT" => "N", "SHOW_OLD_PRICE" => "Y", "SHOW_MAX_QUANTITY" => "N", "SHOW_CLOSE_POPUP" => "N", "MESS_BTN_BUY" => "Купить", "MESS_BTN_ADD_TO_BASKET" => "В корзину", "MESS_BTN_SUBSCRIBE" => "Подписаться", "MESS_BTN_COMPARE" => "Сравнить", "MESS_NOT_AVAILABLE" => "Нет в наличии", "USE_VOTE_RATING" => "Y", "USE_COMMENTS" => "N", "BRAND_USE" => "N", "SECTION_URL" => "", "DETAIL_URL" => "", "SECTION_ID_VARIABLE" => "SECTION_ID", "CHECK_SECTION_ID_VARIABLE" => "N", "SEF_MODE" => "N", "CACHE_TYPE" => "A", "CACHE_TIME" => "36000000", "CACHE_GROUPS" => "Y", "SET_TITLE" => "Y", "SET_CANONICAL_URL" => "N", "SET_BROWSER_TITLE" => "Y", "BROWSER_TITLE" => "-", "SET_META_KEYWORDS" => "Y", "META_KEYWORDS" => "-", "SET_META_DESCRIPTION" => "Y", "META_DESCRIPTION" => "-", "SET_LAST_MODIFIED" => "N", "USE_MAIN_ELEMENT_SECTION" => "N", "ADD_SECTIONS_CHAIN" => "Y", "ADD_ELEMENT_CHAIN" => "Y", "ACTION_VARIABLE" => "action", "PRODUCT_ID_VARIABLE" => "id", "DISPLAY_COMPARE" => "N", "PRICE_CODE" => array(0 => "BASE",), "USE_PRICE_COUNT" => "N", "SHOW_PRICE_COUNT" => "1", "PRICE_VAT_INCLUDE" => "Y", "PRICE_VAT_SHOW_VALUE" => "N", "CONVERT_CURRENCY" => "N", "BASKET_URL" => "/personal/cart/", "USE_PRODUCT_QUANTITY" => "Y", "PRODUCT_QUANTITY_VARIABLE" => "", "ADD_PROPERTIES_TO_BASKET" => "N", "PRODUCT_PROPS_VARIABLE" => "prop", "PARTIAL_PRODUCT_PROPERTIES" => "N", "PRODUCT_PROPERTIES" => array(), "OFFERS_CART_PROPERTIES" => array(), "ADD_TO_BASKET_ACTION" => array(0 => "ADD",), "LINK_IBLOCK_TYPE" => "", "LINK_IBLOCK_ID" => "", "LINK_PROPERTY_SID" => "", "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#", "USE_GIFTS_DETAIL" => "N", "USE_GIFTS_MAIN_PR_SECTION_LIST" => "N", "SET_STATUS_404" => "N", "SHOW_404" => "N", "MESSAGE_404" => "", "USE_ELEMENT_COUNTER" => "Y", "SHOW_DEACTIVATED" => "N", "DISABLE_INIT_JS_IN_COMPONENT" => "N", "SET_VIEWED_IN_COMPONENT" => "N", "SHOW_BASIS_PRICE" => "N", "VOTE_DISPLAY_AS_RATING" => "rating"), false); ?>
                    </div><!--all_products-->

                </div><!--product_filter-->
            </div><!--product_filter-->
            <? $APPLICATION->IncludeComponent("bitrix:sale.recommended.products", "template1", array("ACTION_VARIABLE" => "action", "ADDITIONAL_PICT_PROP_2" => "MORE_PHOTO", "ADDITIONAL_PICT_PROP_3" => "MORE_PHOTO", "ADD_PROPERTIES_TO_BASKET" => "Y", "BASKET_URL" => "/personal/cart", "CACHE_TIME" => "86400", "CACHE_TYPE" => "N", "CART_PROPERTIES_2" => array(0 => "", 1 => "",), "CART_PROPERTIES_3" => array(0 => "", 1 => "",), "CODE" => $_REQUEST["code"], "CONVERT_CURRENCY" => "N", "DETAIL_URL" => "#CODE#", "HIDE_NOT_AVAILABLE" => "N", "IBLOCK_ID" => "2", "IBLOCK_TYPE" => "catalog", "LABEL_PROP_2" => "-", "LINE_ELEMENT_COUNT" => "3", "MESS_BTN_BUY" => "Купить", "MESS_BTN_DETAIL" => "Подробнее", "MESS_BTN_SUBSCRIBE" => "Подписаться", "MESS_NOT_AVAILABLE" => "Нет в наличии", "MIN_BUYES" => "1", "OFFER_TREE_PROPS_3" => array(), "PAGE_ELEMENT_COUNT" => "30", "PARTIAL_PRODUCT_PROPERTIES" => "N", "PRICE_CODE" => array(0 => "BASE",), "PRICE_VAT_INCLUDE" => "Y", "PRODUCT_ID_VARIABLE" => "id", "PRODUCT_PROPS_VARIABLE" => "prop", "PRODUCT_QUANTITY_VARIABLE" => "quantity", "PRODUCT_SUBSCRIPTION" => "N", "PROPERTY_CODE_2" => array(0 => "", 1 => "",), "PROPERTY_CODE_3" => array(0 => "", 1 => "",), "SHOW_DISCOUNT_PERCENT" => "Y", "SHOW_IMAGE" => "Y", "SHOW_NAME" => "Y", "SHOW_OLD_PRICE" => "Y", "SHOW_PRICE_COUNT" => "1", "TEMPLATE_THEME" => "blue", "USE_PRODUCT_QUANTITY" => "N", "COMPONENT_TEMPLATE" => "template1", "ID" => ""), false); ?>

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


        </div>

    </div>

    <!--  -->

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>