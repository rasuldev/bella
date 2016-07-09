<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
    'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME']
);

$arSkuTemplate = array();
if (isset($arResult['SKU_PROPS']) && is_array($arResult['SKU_PROPS'])) {
    foreach ($arResult['SKU_PROPS'] as $iblockId => $skuProps) {
        $arSkuTemplate[$iblockId] = array();
        foreach ($skuProps as &$arProp) {
            ob_start();
            if ('TEXT' == $arProp['SHOW_MODE']) {
                if (5 < $arProp['VALUES_COUNT']) {
                    $strClass = 'bx_item_detail_size full';
                    $strWidth = ($arProp['VALUES_COUNT'] * 20) . '%';
                    $strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
                    $strSlideStyle = '';
                } else {
                    $strClass = 'bx_item_detail_size';
                    $strWidth = '100%';
                    $strOneWidth = '20%';
                    $strSlideStyle = 'display: none;';
                }
                ?>
            <div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
                <span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>

                <div class="bx_size_scroller_container">
                    <div class="bx_size">
                        <ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
                            foreach ($arProp['VALUES'] as $arOneValue) {
                                ?>
                            <li
                                data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID']; ?>"
                                data-onevalue="<? echo $arOneValue['ID']; ?>"
                                style="width: <? echo $strOneWidth; ?>;"
                            ><i></i><span class="cnt"><? echo htmlspecialcharsex($arOneValue['NAME']); ?></span>
                                </li><?
                            }
                            ?></ul>
                    </div>
                    <div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left"
                         data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                    <div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right"
                         data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                </div>
                </div><?
            } elseif ('PICT' == $arProp['SHOW_MODE']) {
                if (5 < $arProp['VALUES_COUNT']) {
                    $strClass = 'bx_item_detail_scu full';
                    $strWidth = ($arProp['VALUES_COUNT'] * 20) . '%';
                    $strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
                    $strSlideStyle = '';
                } else {
                    $strClass = 'bx_item_detail_scu';
                    $strWidth = '100%';
                    $strOneWidth = '20%';
                    $strSlideStyle = 'display: none;';
                }
                ?>
            <div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
                <span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>

                <div class="bx_scu_scroller_container">
                    <div class="bx_scu">
                        <ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
                            foreach ($arProp['VALUES'] as $arOneValue) {
                                ?>
                            <li
                                data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID'] ?>"
                                data-onevalue="<? echo $arOneValue['ID']; ?>"
                                style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;"
                            ><i title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"></i>
						<span class="cnt"><span class="cnt_item"
                                                style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"
                                                title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"
                            ></span></span></li><?
                            }
                            ?></ul>
                    </div>
                    <div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left"
                         data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                    <div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right"
                         data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                </div>
                </div><?
            }
            $arSkuTemplate[$iblockId][$arProp['CODE']] = ob_get_contents();
            ob_end_clean();
            unset($arProp);
        }
    }
}
?>
<? if (isset($arResult['ITEMS']) && !empty($arResult['ITEMS'])): ?>
    <div
        class="with_this_buy col<? echo $arParams['LINE_ELEMENT_COUNT']; ?> <? echo $templateData['TEMPLATE_CLASS']; ?>">
        <h2><? echo GetMessage('SRP_HREF_TITLE') ?>:</h2>

        <div class="this_by_list clear">
            <?
            foreach ($arResult['ITEMS'] as $key => $arItem) {
                $strMainID = $this->GetEditAreaId($arItem['ID'] . $key);

                $arItemIDs = array(
                    'ID' => $strMainID,
                    'PICT' => $strMainID . '_pict',
                    'SECOND_PICT' => $strMainID . '_secondpict',
                    'MAIN_PROPS' => $strMainID . '_main_props',

                    'QUANTITY' => $strMainID . '_quantity',
                    'QUANTITY_DOWN' => $strMainID . '_quant_down',
                    'QUANTITY_UP' => $strMainID . '_quant_up',
                    'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                    'BUY_LINK' => $strMainID . '_buy_link',
                    'SUBSCRIBE_LINK' => $strMainID . '_subscribe',

                    'PRICE' => $strMainID . '_price',
                    'DSC_PERC' => $strMainID . '_dsc_perc',
                    'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',

                    'PROP_DIV' => $strMainID . '_sku_tree',
                    'PROP' => $strMainID . '_prop_',
                    'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                    'BASKET_PROP_DIV' => $strMainID . '_basket_prop'
                );

                $strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

                $strTitle = (
                isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
                    ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
                    : $arItem['NAME']
                );
                $showImgClass = $arParams['SHOW_IMAGE'] != "Y" ? "no-imgs" : "";

                ?>
            <aside class="prod"
                   id="<? echo $strMainID; ?>">
                <figure>
                    <a id="<? echo $arItemIDs['PICT']; ?>"
                       href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"
                       class="img_prod">
                        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                    </a>
                    <p class="skidki_prod">
                        <?
                        if ('YYY' == $arItem["PROPERTIES"]["SALELEADER"]["VALUE_XML_ID"])
                            echo '<i class="sprite_1"></i>'; // Хит продаж

                        if ('Y' == $arItem["PROPERTIES"]["NEWPRODUCT"]["VALUE_XML_ID"])
                            echo '<i class="sprite_2"></i>'; // Новинка

                        if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
                            echo '<i class="sprite_3"></i>'; // Скидка
                        ?>
                    </p>
                </figure>

                <p class="cat_prod">
                    <?
                    $section = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
                    if ($arSection = $section->Fetch())
                    {
                        $productsCategories["NAME"] = $arSection["NAME"];
                        $productsCategories["URL"] = 'http://' . $_SERVER["SERVER_NAME"] . '/catalog/' . $arSection["CODE"];
                    }
                    ?>
                    <a href="<?= $productsCategories["URL"] ?>"><?= $productsCategories["NAME"] ?></a>
                </p>
                <? if ($arItem['SECOND_PICT'])
                {
                    ?><a id="<? echo $arItemIDs['SECOND_PICT']; ?>"
                         href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"
                         class="bx_catalog_item_images_double">
                    <?
                    if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
                    {
                        ?>
                        <?
                    }
                    if ($arItem['LABEL'])
                    {
                        ?>

                        <?
                    }
                    ?>
                    </a><?
                } ?>
                <? if ($arParams['SHOW_NAME'] == "Y")
                {
                    ?>
                    <p class="name_prod">
                        <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" title="<? echo $arItem['NAME']; ?>">
                            <? echo $arItem['NAME']; ?>
                        </a>
                    </p>
                    <?
                } ?>

                <p class="price_prod">
                <?
                if (!empty($arItem['MIN_PRICE']))
                {
                    if ('Y' == $arParams['SHOW_OLD_PRICE'] && $arItem['MIN_PRICE']['DISCOUNT_VALUE'] < $arItem['MIN_PRICE']['VALUE'])
                    {
                        ?>
                        <span class="old_price"><? echo $arItem['MIN_PRICE']['PRINT_VALUE']; ?></span>
                        <?
                    }
                }
                ?>
                <span id="<? echo $arItemIDs['PRICE']; ?>" class="now_price">
                <?
                if (isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
                {
                    echo GetMessage('SRP_TPL_MESS_PRICE_SIMPLE_MODE', array('#PRICE#' => $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'], '#MEASURE#' => GetMessage('SRP_TPL_MESS_MEASURE_SIMPLE_MODE', array('#VALUE#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_RATIO'], '#UNIT#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_NAME']))));
                } else
                {
                    echo $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];
                }
                ?>
                </span>
                </p>

                <?

                if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS'])) // Simple Product
                {
                    ?>
                    <div class="bx_catalog_item_controls"><?
                        if ($arItem['CAN_BUY'])
                        {
                            if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
                            {
                                ?>
                                <div class="bx_catalog_item_controls_blockone">
                                    <div style="display: inline-block;position: relative;">
                                        <a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>"
                                           href="javascript:void(0)"
                                           class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
                                        <input type="text" class="bx_col_input"
                                               id="<? echo $arItemIDs['QUANTITY']; ?>"
                                               name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>"
                                               value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>">
                                        <a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)"
                                           class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
							<span
                                id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"
                                class="bx_cnt_desc"><? echo $arItem['CATALOG_MEASURE_NAME']; ?></span>
                                    </div>
                                </div>
                                <?
                            }
                            ?>
                            <div class="bx_catalog_item_controls_blocktwo">
                                <p class="but_prod">
                                    <a id="<? echo $arItemIDs['BUY_LINK']; ?>"
                                       href="javascript:void(0)" rel="nofollow"><?echo('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('SRP_TPL_MESS_BTN_BUY'));?></a>
                                </p>
                            </div>
                            <?
                        } else
                        {
                            ?>
                            <div class="bx_catalog_item_controls_blockone">
                            <a class="bx_medium bx_bt_button_type_2"
                               href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" rel="nofollow">
                                <? echo('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('SRP_TPL_MESS_BTN_DETAIL')); ?>
                            </a>
                            </div><?
                            if ('Y' == $arParams['PRODUCT_SUBSCRIPTION'] && 'Y' == $arItem['CATALOG_SUBSCRIPTION'])
                            {
                                ?>
                                <div class="bx_catalog_item_controls_blocktwo">
                                <a
                                    id="<? echo $arItemIDs['SUBSCRIBE_LINK']; ?>"
                                    class="bx_bt_button_type_2 bx_medium"
                                    href="javascript:void(0)"><?
                                    echo('' != $arParams['MESS_BTN_SUBSCRIBE'] ? $arParams['MESS_BTN_SUBSCRIBE'] : GetMessage('SRP_TPL_MESS_BTN_SUBSCRIBE'));
                                    ?>
                                </a>
                                </div><?
                            }
                        }
                        ?>
                        <div style="clear: both;"></div><?

                        ?></div><?
                if (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']))
                {
                ?>
                    <div class="bx_catalog_item_articul">
                        <?
                        foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp)
                        {
                            ?><br><? echo $arOneProp['NAME']; ?> <strong><?
                            echo(is_array($arOneProp['DISPLAY_VALUE']) ? implode('/', $arOneProp['DISPLAY_VALUE']) : $arOneProp['DISPLAY_VALUE']); ?></strong><?
                        }
                        ?>
                    </div>
                <?
                }


                $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
                if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
                {
                ?>
                    <div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
                        <?
                        if (!empty($arItem['PRODUCT_PROPERTIES_FILL']))
                        {
                            foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
                            {
                                ?>
                                <input
                                    type="hidden"
                                    name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                                    value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>"
                                >
                                <?
                                if (isset($arItem['PRODUCT_PROPERTIES'][$propID])) unset($arItem['PRODUCT_PROPERTIES'][$propID]);
                            }
                        }
                        $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);

                        if (!$emptyProductProperties)
                        {

                            ?>
                            <table>
                                <?
                                foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo)
                                {
                                    ?>
                                    <tr>
                                        <td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
                                        <td>
                                            <?
                                            if ('L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE'] && 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE'])
                                            {
                                                foreach ($propInfo['VALUES'] as $valueID => $value)
                                                {
                                                    ?><label><input
                                                    type="radio"
                                                    name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                                                    value="<? echo $valueID; ?>"
                                                    <? echo($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>
                                                    ><? echo $value; ?></label><br><?
                                                }
                                            } else
                                            {
                                                ?><select
                                                name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                                foreach ($propInfo['VALUES'] as $valueID => $value)
                                                {
                                                    ?>
                                                    <option
                                                    value="<? echo $valueID; ?>"
                                                    <? echo($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>
                                                    ><? echo $value; ?></option><?
                                                }
                                                ?></select><?
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?
                                }
                                ?>
                            </table>
                            <?
                        }
                        ?>
                    </div>
                <?
                }
                $arJSParams = array('PRODUCT_TYPE' => $arItem['CATALOG_TYPE'], 'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'], 'SHOW_ADD_BASKET_BTN' => false, 'SHOW_BUY_BTN' => true, 'SHOW_ABSENT' => true, 'PRODUCT' => array('ID' => $arItem['ID'], 'NAME' => $arItem['~NAME'], 'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']), 'CAN_BUY' => $arItem["CAN_BUY"], 'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']), 'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'], 'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'], 'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'], 'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']), 'ADD_URL' => $arItem['~ADD_URL'], 'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL']), 'BASKET' => array('ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']), 'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'], 'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'], 'EMPTY_PROPS' => $emptyProductProperties), 'VISUAL' => array('ID' => $arItemIDs['ID'], 'PICT_ID' => ('Y' == $arItem['SECOND_PICT'] ? $arItemIDs['SECOND_PICT'] : $arItemIDs['PICT']), 'QUANTITY_ID' => $arItemIDs['QUANTITY'], 'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'], 'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'], 'PRICE_ID' => $arItemIDs['PRICE'], 'BUY_ID' => $arItemIDs['BUY_LINK'], 'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV']), 'LAST_ELEMENT' => $arItem['LAST_ELEMENT']);
                ?>
                    <script type="text/javascript">
                        var <? echo $strObName; ?> =
                        new JCCatalogSectionSRec(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
                    </script><?
                }
                else // Wth Sku
                {
                ?>
                    <div class="bx_catalog_item_controls no_touch">
                        <?
                        if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
                        {
                            ?>
                            <div class="bx_catalog_item_controls_blockone">
                                <a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)"
                                   class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
                                <input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>"
                                       name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>"
                                       value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>">
                                <a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)"
                                   class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
                                <span id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"></span>
                            </div>
                            <?
                        }
                        ?>
                        <div class="bx_catalog_item_controls_blocktwo">
                            <a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium"
                               href="javascript:void(0)" rel="nofollow"><?
                                echo('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('SRP_TPL_MESS_BTN_BUY'));
                                ?></a>
                        </div>
                        <div style="clear: both;"></div>
                    </div>

                    <div class="bx_catalog_item_controls touch">
                        <a class="bx_bt_button_type_2 bx_medium"
                           href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><?
                            echo('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('SRP_TPL_MESS_BTN_DETAIL'));
                            ?></a>
                    </div>
                <?
                $boolShowOfferProps = !!$arItem['OFFERS_PROPS_DISPLAY'];
                $boolShowProductProps = (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']));
                if ($boolShowProductProps || $boolShowOfferProps)
                {
                ?>
                    <div class="bx_catalog_item_articul">
                        <?
                        if ($boolShowProductProps)
                        {
                            foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp)
                            {
                                ?><br><? echo $arOneProp['NAME']; ?><strong> <?
                                echo(is_array($arOneProp['DISPLAY_VALUE']) ? implode(' / ', $arOneProp['DISPLAY_VALUE']) : $arOneProp['DISPLAY_VALUE']); ?></strong><?
                            }
                        }

                        ?>
                        <span id="<? echo $arItemIDs['DISPLAY_PROP_DIV']; ?>" style="display: none;"></span>
                        <?

                        ?>
                    </div>
                <?
                }

                if (!empty($arItem['OFFERS']) && isset($arSkuTemplate[$arItem['IBLOCK_ID']]))
                {
                $arSkuProps = array();
                ?>
                    <div class="bx_catalog_item_scu" id="<? echo $arItemIDs['PROP_DIV']; ?>"><?
                        foreach ($arSkuTemplate[$arItem['IBLOCK_ID']] as $code => $strTemplate)
                        {
                            if (!isset($arItem['OFFERS_PROP'][$code])) continue;
                            echo '<div>', str_replace('#ITEM#_prop_', $arItemIDs['PROP'], $strTemplate), '</div>';
                        }

                        if (isset($arResult['SKU_PROPS'][$arItem['IBLOCK_ID']]))
                        {
                            foreach ($arResult['SKU_PROPS'][$arItem['IBLOCK_ID']] as $arOneProp)
                            {
                                if (!isset($arItem['OFFERS_PROP'][$arOneProp['CODE']])) continue;
                                $arSkuProps[] = array('ID' => $arOneProp['ID'], 'SHOW_MODE' => $arOneProp['SHOW_MODE'], 'VALUES_COUNT' => $arOneProp['VALUES_COUNT']);
                            }
                        }
                        foreach ($arItem['JS_OFFERS'] as &$arOneJs)
                        {
                            if (0 < $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT']) $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] = '-' . $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] . '%';
                        }

                        ?></div><?
                if ($arItem['OFFERS_PROPS_DISPLAY'])
                {
                    foreach ($arItem['JS_OFFERS'] as $keyOffer => $arJSOffer)
                    {
                        $strProps = '';
                        if (!empty($arJSOffer['DISPLAY_PROPERTIES']))
                        {
                            foreach ($arJSOffer['DISPLAY_PROPERTIES'] as $arOneProp)
                            {
                                $strProps .= '<br>' . $arOneProp['NAME'] . ' <strong>' . (is_array($arOneProp['VALUE']) ? implode(' / ', $arOneProp['VALUE']) : $arOneProp['VALUE']) . '</strong>';
                            }
                        }
                        $arItem['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
                    }
                }
                $arJSParams = array('PRODUCT_TYPE' => $arItem['CATALOG_TYPE'], 'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'], 'SHOW_ADD_BASKET_BTN' => false, 'SHOW_BUY_BTN' => true, 'SHOW_ABSENT' => true, 'SHOW_SKU_PROPS' => $arItem['OFFERS_PROPS_DISPLAY'], 'SECOND_PICT' => ($arParams['SHOW_IMAGE'] == "Y" ? $arItem['SECOND_PICT'] : false), 'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']), 'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']), 'DEFAULT_PICTURE' => array('PICTURE' => $arItem['PRODUCT_PREVIEW'], 'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']), 'VISUAL' => array('ID' => $arItemIDs['ID'], 'PICT_ID' => $arItemIDs['PICT'], 'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'], 'QUANTITY_ID' => $arItemIDs['QUANTITY'], 'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'], 'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'], 'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'], 'PRICE_ID' => $arItemIDs['PRICE'], 'TREE_ID' => $arItemIDs['PROP_DIV'], 'TREE_ITEM_ID' => $arItemIDs['PROP'], 'BUY_ID' => $arItemIDs['BUY_LINK'], 'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'], 'DSC_PERC' => $arItemIDs['DSC_PERC'], 'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'], 'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],), 'BASKET' => array('QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'], 'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE']), 'PRODUCT' => array('ID' => $arItem['ID'], 'NAME' => $arItem['~NAME']), 'OFFERS' => $arItem['JS_OFFERS'], 'OFFER_SELECTED' => $arItem['OFFERS_SELECTED'], 'TREE_PROPS' => $arSkuProps, 'LAST_ELEMENT' => $arItem['LAST_ELEMENT']);
                ?>
                    <script type="text/javascript">
                        var <? echo $strObName; ?> =
                        new JCCatalogSectionSRec(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
                    </script>
                    <?
                }
                }
                ?>


                </aside><?
            }
            ?>
            <div style="clear: both;"></div>


        </div>
    </div>

    <script type="text/javascript">
        BX.message({
            MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('SRP_TPL_MESS_BTN_BUY')); ?>',
            MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('SRP_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',

            MESS_BTN_DETAIL: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('SRP_TPL_MESS_BTN_DETAIL')); ?>',

            MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('SRP_TPL_MESS_BTN_DETAIL')); ?>',
            BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('SRP_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
            BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
            ADD_TO_BASKET_OK: '<? echo GetMessageJS('SRP_ADD_TO_BASKET_OK'); ?>',
            TITLE_ERROR: '<? echo GetMessageJS('SRP_CATALOG_TITLE_ERROR') ?>',
            TITLE_BASKET_PROPS: '<? echo GetMessageJS('SRP_CATALOG_TITLE_BASKET_PROPS') ?>',
            TITLE_SUCCESSFUL: '<? echo GetMessageJS('SRP_ADD_TO_BASKET_OK'); ?>',
            BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('SRP_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('SRP_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
            BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('SRP_CATALOG_BTN_MESSAGE_CLOSE') ?>'
        });
    </script>

<? endif ?>
