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
                        </li>
                        <li>
                            <input id="check_7" type="checkbox"/>
                            <a class="ico_plus_min" href="javascript:void(0);"><label for="check_7">По бренду</label></a>
                        </li>
                        -->
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
										"CACHE_TYPE" => "N",
										"CHECK_DATES" => "Y",
										"DETAIL_URL" => "#SECTION_CODE#/#CODE#",
										"DISPLAY_BOTTOM_PAGER" => "Y",
										"DISPLAY_DATE" => "Y",
										"DISPLAY_NAME" => "Y",
										"DISPLAY_PICTURE" => "Y",
										"DISPLAY_PREVIEW_TEXT" => "Y",
										"DISPLAY_TOP_PAGER" => "N",
										"FIELD_CODE" => array("ID","CODE","NAME","PREVIEW_TEXT","PREVIEW_PICTURE","DETAIL_TEXT","DETAIL_PICTURE",""),
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
										"PROPERTY_CODE" => array("akcii_skidka","akcii_element",""),
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
                                    <p class="stars_prod">
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                        <i class="ico_star"></i>
                                    </p>
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

                <div class="prod_list clear">
        <?php
        $arrFilter = array(
            '>=CATALOG_PRICE_1' => $_GET['min_price']?$_GET['min_price']:0,
            '<=CATALOG_PRICE_1' => $_GET['max_price']?$_GET['max_price']:3000
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

<?$APPLICATION->IncludeComponent("bitrix:catalog", "product", Array(
	"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"IBLOCK_ID" => "2",	// Инфоблок
		"TEMPLATE_THEME" => "site",	// Цветовая тема
		"HIDE_NOT_AVAILABLE" => "N",	// Товары, которых нет на складах
		"BASKET_URL" => "/personal/cart/",	// URL, ведущий на страницу с корзиной покупателя
		"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
		"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
		"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
		"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"SEF_FOLDER" => "/catalog/",	// Каталог ЧПУ (относительно корня сайта)
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"ADD_SECTION_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",	// Включать название элемента в цепочку навигации
		"SET_STATUS_404" => "Y",	// Устанавливать статус 404
		"DETAIL_DISPLAY_NAME" => "N",	// Выводить название элемента
		"USE_ELEMENT_COUNTER" => "Y",	// Использовать счетчик просмотров
		"USE_FILTER" => "Y",	// Показывать фильтр
		"FILTER_NAME" => "",	// Фильтр
		"FILTER_VIEW_MODE" => "VERTICAL",	// Вид отображения умного фильтра
		"FILTER_FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "",
		),
		"FILTER_PRICE_CODE" => array(	// Тип цены
			0 => "BASE",
		),
		"FILTER_OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "PREVIEW_PICTURE",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "",
			1 => "",
		),
		"USE_REVIEW" => "Y",	// Разрешить отзывы
		"MESSAGES_PER_PAGE" => "10",	// Количество сообщений на одной странице
		"USE_CAPTCHA" => "Y",	// Использовать CAPTCHA
		"REVIEW_AJAX_POST" => "Y",	// Использовать AJAX в диалогах
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",	// Путь относительно корня сайта к папке со смайлами
		"FORUM_ID" => "11",	// ID форума для отзывов
		"URL_TEMPLATES_READ" => "",	// Страница чтения темы (пусто - получить из настроек форума)
		"SHOW_LINK_TO_FORUM" => "Y",	// Показать ссылку на форум
		"USE_COMPARE" => "N",	// Разрешить сравнение товаров
		"PRICE_CODE" => array(	// Тип цены
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
		"PRODUCT_PROPERTIES" => "",	// Характеристики товара, добавляемые в корзину
		"USE_PRODUCT_QUANTITY" => "Y",	// Разрешить указание количества товара
		"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
		"QUANTITY_FLOAT" => "N",
		"OFFERS_CART_PROPERTIES" => array(	// Свойства предложений, добавляемые в корзину
			0 => "SIZES_SHOES",
			1 => "SIZES_CLOTHES",
			2 => "COLOR_REF",
		),
		"SHOW_TOP_ELEMENTS" => "N",	// Выводить топ элементов
		"SECTION_COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"SECTION_TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
		"SECTIONS_VIEW_MODE" => "TILE",	// Вид списка подразделов
		"SECTIONS_SHOW_PARENT_NAME" => "N",	// Показывать название раздела
		"PAGE_ELEMENT_COUNT" => "15",	// Количество элементов на странице
		"LINE_ELEMENT_COUNT" => "3",	// Количество элементов, выводимых в одной строке таблицы
		"ELEMENT_SORT_FIELD" => "desc",	// По какому полю сортируем товары в разделе
		"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки товаров в разделе
		"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки товаров в разделе
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки товаров в разделе
		"LIST_PROPERTY_CODE" => array(	// Свойства
			0 => "NEWPRODUCT",
			1 => "SALELEADER",
			2 => "SPECIALOFFER",
			3 => "",
		),
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"LIST_META_KEYWORDS" => "UF_KEYWORDS",	// Установить ключевые слова страницы из свойства раздела
		"LIST_META_DESCRIPTION" => "UF_META_DESCRIPTION",	// Установить описание страницы из свойства раздела
		"LIST_BROWSER_TITLE" => "UF_BROWSER_TITLE",	// Установить заголовок окна браузера из свойства раздела
		"LIST_OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"LIST_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "SIZES_SHOES",
			1 => "SIZES_CLOTHES",
			2 => "COLOR_REF",
			3 => "MORE_PHOTO",
			4 => "ARTNUMBER",
			5 => "",
		),
		"LIST_OFFERS_LIMIT" => "0",	// Максимальное количество предложений для показа (0 - все)
		"SECTION_BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",	// Установить фоновую картинку для шаблона из свойства
		"DETAIL_PROPERTY_CODE" => array(	// Свойства
			0 => "NEWPRODUCT",
			1 => "MANUFACTURER",
			2 => "MATERIAL",
		),
		"DETAIL_META_KEYWORDS" => "KEYWORDS",	// Установить ключевые слова страницы из свойства
		"DETAIL_META_DESCRIPTION" => "META_DESCRIPTION",	// Установить описание страницы из свойства
		"DETAIL_BROWSER_TITLE" => "TITLE",	// Установить заголовок окна браузера из свойства
		"DETAIL_OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "NAME",
			1 => "",
		),
		"DETAIL_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "ARTNUMBER",
			1 => "SIZES_SHOES",
			2 => "SIZES_CLOTHES",
			3 => "COLOR_REF",
			4 => "MORE_PHOTO",
			5 => "",
		),
		"DETAIL_BACKGROUND_IMAGE" => "BACKGROUND_IMAGE",	// Установить фоновую картинку для шаблона из свойства
		"LINK_IBLOCK_TYPE" => "",	// Тип инфоблока, элементы которого связаны с текущим элементом
		"LINK_IBLOCK_ID" => "",	// ID инфоблока, элементы которого связаны с текущим элементом
		"LINK_PROPERTY_SID" => "",	// Свойство, в котором хранится связь
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",	// URL на страницу, где будет показан список связанных элементов
		"USE_ALSO_BUY" => "Y",	// Показывать блок "С этим товаром покупают"
		"ALSO_BUY_ELEMENT_COUNT" => "4",	// Количество элементов для отображения
		"ALSO_BUY_MIN_BUYES" => "1",	// Минимальное количество покупок товара
		"OFFERS_SORT_FIELD" => "sort",	// По какому полю сортируем предложения товара
		"OFFERS_SORT_ORDER" => "desc",	// Порядок сортировки предложений товара
		"OFFERS_SORT_FIELD2" => "id",	// Поле для второй сортировки предложений товара
		"OFFERS_SORT_ORDER2" => "desc",	// Порядок второй сортировки предложений товара
		"PAGER_TEMPLATE" => "round",	// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"PAGER_TITLE" => "Товары",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"ADD_PICT_PROP" => "MORE_PHOTO",	// Дополнительная картинка основного товара
		"LABEL_PROP" => "NEWPRODUCT",	// Свойство меток товара
		"PRODUCT_DISPLAY_MODE" => "Y",	// Схема отображения
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",	// Дополнительные картинки предложения
		"OFFER_TREE_PROPS" => array(	// Свойства для отбора предложений
			0 => "SIZES_SHOES",
			1 => "SIZES_CLOTHES",
			2 => "COLOR_REF",
			3 => "",
		),
		"SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
		"SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
		"MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
		"MESS_BTN_COMPARE" => "Сравнение",	// Текст кнопки "Сравнение"
		"MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
		"MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
		"DETAIL_USE_VOTE_RATING" => "Y",	// Включить рейтинг товара
		"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",	// В качестве рейтинга показывать
		"DETAIL_USE_COMMENTS" => "Y",	// Включить отзывы о товаре
		"DETAIL_BLOG_USE" => "Y",	// Использовать комментарии
		"DETAIL_VK_USE" => "N",	// Использовать Вконтакте
		"DETAIL_FB_USE" => "Y",	// Использовать Facebook
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"USE_STORE" => "Y",	// Показывать блок "Количество товара на складе"
		"FIELDS" => array(	// Поля
			0 => "STORE",
			1 => "SCHEDULE",
		),
		"USE_MIN_AMOUNT" => "N",	// Показывать вместо точного количества информацию о достаточности
		"STORE_PATH" => "/store/#store_id#",	// Шаблон пути к каталогу STORE (относительно корня)
		"MAIN_TITLE" => "Наличие на складах",	// Заголовок блока
		"MIN_AMOUNT" => "10",
		"DETAIL_BRAND_USE" => "Y",	// Использовать компонент "Бренды"
		"DETAIL_BRAND_PROP_CODE" => "BRAND_REF",	// Таблица с брендами
		"SIDEBAR_SECTION_SHOW" => "Y",	// Показывать правый блок в списке товаров
		"SIDEBAR_DETAIL_SHOW" => "Y",	// Показывать правый блок на детальной странице
		"SIDEBAR_PATH" => "/catalog/sidebar.php",	// Путь к включаемой области для вывода информации в правом блоке
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE#/",
			"element" => "#SECTION_CODE#/#ELEMENT_ID#/",
			"compare" => "compare/",
		)
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>