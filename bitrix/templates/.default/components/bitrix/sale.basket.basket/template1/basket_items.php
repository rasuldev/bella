<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
use Bitrix\Sale\DiscountCouponsManager;

if (!empty($arResult["ERROR_MESSAGE"]))
    ShowError($arResult["ERROR_MESSAGE"]);

$bDelayColumn = false;
$bDeleteColumn = true;
$bWeightColumn = false;
$bPropsColumn = false;
$bPriceType = false;

if ($normalCount > 0):
    ?>
    <?
    foreach ($arResult["ITEMS"]["AnDelCanBuy"] as $item)
    {
        $product = CIBlockElement::GetByID($item["PRODUCT_ID"]);
        if ($arProduct = $product->Fetch()) {
            $section = CIBlockSection::GetByID($arProduct["IBLOCK_SECTION_ID"]);
            if ($arSection = $section->Fetch()) {
                $productsCategories[$item["PRODUCT_ID"]]["NAME"] = $arSection["NAME"];
                $productsCategories[$item["PRODUCT_ID"]]["URL"] = 'http://'.$_SERVER["SERVER_NAME"].'/catalog/'.$arSection["CODE"];
            }
        }
    }
    ?>


    <div class="added_products">
        <div class="added_products_list">
            <table class="added_products_list" id="basket_items" style="width: 100%;">
                <thead>
                <tr>
                    <td class="margin"></td>
                    <?
                    foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
                        $arHeader["name"] = (isset($arHeader["name"]) ? (string)$arHeader["name"] : '');
                        if ($arHeader["name"] == '')
                            $arHeader["name"] = GetMessage("SALE_" . $arHeader["id"]);
                        $arHeaders[] = $arHeader["id"];

                        // remember which values should be shown not in the separate columns, but inside other columns
                        if (in_array($arHeader["id"], array("TYPE"))) {
                            $bPriceType = true;
                            continue;
                        } elseif ($arHeader["id"] == "PROPS") {
                            $bPropsColumn = true;
                            continue;
                        } elseif ($arHeader["id"] == "DELAY") {
                            $bDelayColumn = true;
                            continue;
                        } elseif ($arHeader["id"] == "DELETE") {
                            $bDeleteColumn = true;
                            continue;
                        } elseif ($arHeader["id"] == "WEIGHT") {
                            $bWeightColumn = true;
                        }

                        if ($arHeader["id"] == "NAME"):
                            ?>
                            <th id="col_<?= $arHeader["id"]; ?>">
                            <?
                        elseif ($arHeader["id"] == "PRICE"):
                            ?>
                            <th id="col_<?= $arHeader["id"]; ?>">
                            <?
                        elseif ($arHeader["id"] == "DISCOUNT"):
                            ?>
                            <?$arHeader["name"] = "";?>
                            <?
                        else:
                            ?>
                            <th id="col_<?= $arHeader["id"]; ?>">
                            <?
                        endif;
                        ?>
                        <?= $arHeader["name"]; ?>
                        </th>
                        <?
                    endforeach;

                    if ($bDeleteColumn || $bDelayColumn):
                        ?>
                        <td></td>
                        <?
                    endif;
                    ?>
                    <td></td>
                </tr>
                </thead>

                <tbody>
                <?
                foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

                    if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"):
                        ?>
                        <tr id="<?= $arItem["ID"] ?>">

                            <td>
                                <a class="del_prod" href="<?= str_replace("#ID#", $arItem["ID"], $arUrls["delete"]) ?>"><i
                                        class="ico_kv"></i><i class="ico_tre"></i><i class="ico_close"></i></a>
                            </td>
                            <?
                            foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):

                                if (in_array($arHeader["id"], array("PROPS", "DELAY", "DELETE", "TYPE"))) // some values are not shown in the columns in this template
                                    continue;

                                if ($arHeader["name"] == '')
                                    $arHeader["name"] = GetMessage("SALE_" . $arHeader["id"]);

                                if ($arHeader["id"] == "NAME"):
                                    ?>
                                    <td>

                                        <?
                                        if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
                                            $url = $arItem["PREVIEW_PICTURE_SRC"];
                                        elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
                                            $url = $arItem["DETAIL_PICTURE_SRC"];
                                        else:
                                            $url = $templateFolder . "/images/no_photo.png";
                                        endif;
                                        ?>

                                        <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0): ?>
                                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?endif;
                                            ?>
                                            <a class="img_prod" href="#"><img src="<?= $url ?>" alt=""></a>
                                            <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0): ?></a><?endif;
                                    ?>
                                        <?
                                        if (!empty($arItem["BRAND"])):
                                            ?>
                                            <div class="bx_ordercart_brand">
                                                <img alt="" src="<?= $arItem["BRAND"] ?>"/>
                                            </div>
                                            <?
                                        endif;
                                        ?>

                                        <p>
                                            <span class="cat_prod"><a href="<?=$productsCategories[$arItem["PRODUCT_ID"]]["URL"]?>"><?=$productsCategories[$arItem["PRODUCT_ID"]]["NAME"]?></a></span><br/>
                                            <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0): ?><a
                                                href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?endif;
                                                ?>
                                                <?= $arItem["NAME"] ?>
                                                <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0): ?></a><?endif;
                                        ?>
                                        </p>

                                        <div class="bx_ordercart_itemart">
                                            <?
                                            if ($bPropsColumn):
                                                foreach ($arItem["PROPS"] as $val):

                                                    if (is_array($arItem["SKU_DATA"])) {
                                                        $bSkip = false;
                                                        foreach ($arItem["SKU_DATA"] as $propId => $arProp) {
                                                            if ($arProp["CODE"] == $val["CODE"]) {
                                                                $bSkip = true;
                                                                break;
                                                            }
                                                        }
                                                        if ($bSkip)
                                                            continue;
                                                    }

                                                    echo $val["NAME"] . ":&nbsp;<span>" . $val["VALUE"] . "<span><br/>";
                                                endforeach;
                                            endif;
                                            ?>
                                        </div>
                                        <?
                                        if (is_array($arItem["SKU_DATA"]) && !empty($arItem["SKU_DATA"])):
                                            foreach ($arItem["SKU_DATA"] as $propId => $arProp):

                                                // if property contains images or values
                                                $isImgProperty = false;
                                                if (!empty($arProp["VALUES"]) && is_array($arProp["VALUES"])) {
                                                    foreach ($arProp["VALUES"] as $id => $arVal) {
                                                        if (!empty($arVal["PICT"]) && is_array($arVal["PICT"])
                                                            && !empty($arVal["PICT"]['SRC'])
                                                        ) {
                                                            $isImgProperty = true;
                                                            break;
                                                        }
                                                    }
                                                }
                                                $countValues = count($arProp["VALUES"]);
                                                $full = ($countValues > 5) ? "full" : "";

                                                if ($isImgProperty): // iblock element relation property
                                                    ?>
                                                    <div class="bx_item_detail_scu_small_noadaptive <?= $full ?>">

													<span class="bx_item_section_name_gray">
														<?= $arProp["NAME"] ?>:
													</span>

                                                        <div class="bx_scu_scroller_container">

                                                            <div class="bx_scu">
                                                                <ul id="prop_<?= $arProp["CODE"] ?>_<?= $arItem["ID"] ?>"
                                                                    style="width: 200%; margin-left:0;"
                                                                    class="sku_prop_list"
                                                                >
                                                                    <?
                                                                    foreach ($arProp["VALUES"] as $valueId => $arSkuValue):

                                                                        $selected = "";
                                                                        foreach ($arItem["PROPS"] as $arItemProp):
                                                                            if ($arItemProp["CODE"] == $arItem["SKU_DATA"][$propId]["CODE"]) {
                                                                                if ($arItemProp["VALUE"] == $arSkuValue["NAME"] || $arItemProp["VALUE"] == $arSkuValue["XML_ID"])
                                                                                    $selected = " bx_active";
                                                                            }
                                                                        endforeach;
                                                                        ?>
                                                                        <li style="width:10%;"
                                                                            class="sku_prop<?= $selected ?>"
                                                                            data-value-id="<?= $arSkuValue["XML_ID"] ?>"
                                                                            data-element="<?= $arItem["ID"] ?>"
                                                                            data-property="<?= $arProp["CODE"] ?>"
                                                                        >
                                                                            <a href="javascript:void(0)"
                                                                               class="cnt"><span class="cnt_item"
                                                                                                 style="background-image:url(<?= $arSkuValue["PICT"]["SRC"]; ?>)"></span></a>
                                                                        </li>
                                                                        <?
                                                                    endforeach;
                                                                    ?>
                                                                </ul>
                                                            </div>

                                                            <div class="bx_slide_left"
                                                                 onclick="leftScroll('<?= $arProp["CODE"] ?>', <?= $arItem["ID"] ?>, <?= $countValues ?>);"></div>
                                                            <div class="bx_slide_right"
                                                                 onclick="rightScroll('<?= $arProp["CODE"] ?>', <?= $arItem["ID"] ?>, <?= $countValues ?>);"></div>
                                                        </div>

                                                    </div>
                                                    <?
                                                else:
                                                    ?>
                                                    <div class="bx_item_detail_size_small_noadaptive <?= $full ?>">

													<span class="bx_item_section_name_gray">
														<?= $arProp["NAME"] ?>:
													</span>

                                                        <div class="bx_size_scroller_container">
                                                            <div class="bx_size">
                                                                <ul id="prop_<?= $arProp["CODE"] ?>_<?= $arItem["ID"] ?>"
                                                                    style="width: 200%; margin-left:0;"
                                                                    class="sku_prop_list"
                                                                >
                                                                    <?
                                                                    foreach ($arProp["VALUES"] as $valueId => $arSkuValue):

                                                                        $selected = "";
                                                                        foreach ($arItem["PROPS"] as $arItemProp):
                                                                            if ($arItemProp["CODE"] == $arItem["SKU_DATA"][$propId]["CODE"]) {
                                                                                if ($arItemProp["VALUE"] == $arSkuValue["NAME"])
                                                                                    $selected = " bx_active";
                                                                            }
                                                                        endforeach;
                                                                        ?>
                                                                        <li style="width:10%;"
                                                                            class="sku_prop<?= $selected ?>"
                                                                            data-value-id="<?= ($arProp['TYPE'] == 'S' && $arProp['USER_TYPE'] == 'directory' ? $arSkuValue['XML_ID'] : $arSkuValue['NAME']); ?>"
                                                                            data-element="<?= $arItem["ID"] ?>"
                                                                            data-property="<?= $arProp["CODE"] ?>"
                                                                        >
                                                                            <a href="javascript:void(0)"
                                                                               class="cnt"><?= $arSkuValue["NAME"] ?></a>
                                                                        </li>
                                                                        <?
                                                                    endforeach;
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                            <div class="bx_slide_left"
                                                                 onclick="leftScroll('<?= $arProp["CODE"] ?>', <?= $arItem["ID"] ?>, <?= $countValues ?>);"></div>
                                                            <div class="bx_slide_right"
                                                                 onclick="rightScroll('<?= $arProp["CODE"] ?>', <?= $arItem["ID"] ?>, <?= $countValues ?>);"></div>
                                                        </div>
                                                    </div>
                                                    <?
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                    </td>
                                    <?
                                elseif ($arHeader["id"] == "QUANTITY"):
                                    ?>
                                    <td>

                                        <?
                                        $ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
                                        $max = isset($arItem["AVAILABLE_QUANTITY"]) ? "max=\"" . $arItem["AVAILABLE_QUANTITY"] . "\"" : "";
                                        $useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
                                        $useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");
                                        ?>



                                        <?
                                        if (!isset($arItem["MEASURE_RATIO"])) {
                                            $arItem["MEASURE_RATIO"] = 1;
                                        }

                                        if (
                                            floatval($arItem["MEASURE_RATIO"]) != 0
                                        ):

                                        endif;
                                        if (isset($arItem["MEASURE_TEXT"])) {
                                            ?>
                                            <!--<td style="text-align: left">--><?//= $arItem["MEASURE_TEXT"] ?><!--</td>-->
                                            <?
                                        }
                                        ?>
                                        <ul class="price_plus_minus clear">
                                            <li><a class="btn_minus" href="javascript:void(0)"
                                                   onclick="setQuantity(<?= $arItem["ID"] ?>, <?= $arItem["MEASURE_RATIO"] ?>, 'down', <?= $useFloatQuantityJS ?>);">-</a>
                                            </li>
                                            <li>
                                                <input
                                                    id="QUANTITY_INPUT_<?= $arItem["ID"] ?>"
                                                    name="QUANTITY_INPUT_<?= $arItem["ID"] ?>"
                                                    min="0"
                                                    step="<?= $ratio ?>"
                                                    class="count_prod"
                                                    value="<?= $arItem["QUANTITY"] ?>"
                                                    type="text"
                                                    onchange="updateQuantity('QUANTITY_INPUT_<?= $arItem["ID"] ?>', '<?= $arItem["ID"] ?>', <?= $ratio ?>, <?= $useFloatQuantityJS ?>)"
                                                />
                                            </li>
                                            <li><a class="btn_plus" href="javascript:void(0)"
                                                   onclick="setQuantity(<?= $arItem["ID"] ?>, <?= $arItem["MEASURE_RATIO"] ?>, 'up', <?= $useFloatQuantityJS ?>);">+</a>
                                            </li>
                                        </ul>
                                        <input type="hidden" id="QUANTITY_<?= $arItem['ID'] ?>"
                                               name="QUANTITY_<?= $arItem['ID'] ?>" value="<?= $arItem["QUANTITY"] ?>"/>
                                    </td>
                                    <?
                                elseif ($arHeader["id"] == "PRICE"):
                                    ?>
                                    <td class="price">
                                        <div class="current_price" id="current_price_<?= $arItem["ID"] ?>">
                                            <?= $arItem["PRICE_FORMATED"] ?>
                                        </div>
<!--                                        <div class="old_price" id="old_price_--><?//= $arItem["ID"] ?><!--">-->
<!--                                            --><?// if (floatval($arItem["DISCOUNT_PRICE_PERCENT"]) > 0): ?>
<!--                                                --><?//= $arItem["FULL_PRICE_FORMATED"] ?>
<!--                                            --><?// endif; ?>
<!--                                        </div>-->

                                        <? if ($bPriceType && strlen($arItem["NOTES"]) > 0): ?>
                                            <div class="type_price"><?= GetMessage("SALE_TYPE") ?></div>
                                            <div class="type_price_value"><?= $arItem["NOTES"] ?></div>
                                        <? endif; ?>
                                    </td>
                                    <?
                                elseif ($arHeader["id"] == "DISCOUNT"):
                                    ?>
                                    <? $v=4; // nothing ?>
<!--                                    <td class="custom">-->
<!--                                        <span>--><?//= $arHeader["name"]; ?><!--:</span>-->
<!---->
<!--                                        <div-->
<!--                                            id="discount_value_--><?//= $arItem["ID"] ?><!--">--><?//= $arItem["DISCOUNT_PRICE_PERCENT_FORMATED"] ?><!--</div>-->
<!--                                    </td>-->
                                    <?
                                elseif ($arHeader["id"] == "WEIGHT"):
                                    ?>
                                    <td class="custom">
                                        <span><?= $arHeader["name"]; ?>:</span>
                                        <?= $arItem["WEIGHT_FORMATED"] ?>
                                    </td>
                                    <?
                                else:
                                    ?>
                                    <td class="custom">
                                        <?
                                        if ($arHeader["id"] == "SUM"):
                                        ?>
                                        <div id="sum_<?= $arItem["ID"] ?>">
                                            <?
                                            endif;

                                            echo $arItem[$arHeader["id"]];

                                            if ($arHeader["id"] == "SUM"):
                                            ?>
                                        </div>
                                    <?
                                    endif;
                                    ?>
                                    </td>
                                    <?
                                endif;
                            endforeach; ?>

                            <td class="margin"></td>
                        </tr>
                        <?
                    endif;
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
        <input type="hidden" id="column_headers" value="<?= CUtil::JSEscape(implode($arHeaders, ",")) ?>"/>
        <input type="hidden" id="offers_props" value="<?= CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ",")) ?>"/>
        <input type="hidden" id="action_var" value="<?= CUtil::JSEscape($arParams["ACTION_VARIABLE"]) ?>"/>
        <input type="hidden" id="quantity_float" value="<?= $arParams["QUANTITY_FLOAT"] ?>"/>
        <input type="hidden" id="count_discount_4_all_quantity"
               value="<?= ($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N" ?>"/>
        <input type="hidden" id="price_vat_show_value"
               value="<?= ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N" ?>"/>
        <input type="hidden" id="hide_coupon" value="<?= ($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N" ?>"/>
        <input type="hidden" id="use_prepayment" value="<?= ($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N" ?>"/>
        <input type="hidden" id="auto_calculation" value="<?= ($arParams["AUTO_CALCULATION"] == "N") ? "N" : "Y" ?>"/>

        <div class="clear block_zakaz">
            <div id="coupons_block">
                <?
                if ($arParams["HIDE_COUPON"] != "Y") {
                    ?>
                    <div class="bx_ordercart_coupon">
                    <input class="class1 class2" type="text" id="coupon" name="COUPON" value="" placeholder="Введите промокод..." onchange="enterCoupon();">
                    <input class="class1" style="float: none;" value="<?= GetMessage('SALE_COUPON_APPLY'); ?>" type="button" onclick="enterCoupon();" title="<?= GetMessage('SALE_COUPON_APPLY_TITLE'); ?>">
<!--                    <a class="bx_bt_button bx_big" href="javascript:void(0)" onclick="enterCoupon();" title="--><?//= GetMessage('SALE_COUPON_APPLY_TITLE'); ?><!--">--><?//= GetMessage('SALE_COUPON_APPLY'); ?><!--</a>-->
                    </div><?
                    if (!empty($arResult['COUPON_LIST'])) {
                        foreach ($arResult['COUPON_LIST'] as $oneCoupon) {
                            $couponClass = 'disabled';
                            switch ($oneCoupon['STATUS']) {
                                case DiscountCouponsManager::STATUS_NOT_FOUND:
                                case DiscountCouponsManager::STATUS_FREEZE:
                                    $couponClass = 'bad';
                                    break;
                                case DiscountCouponsManager::STATUS_APPLYED:
                                    $couponClass = 'good';
                                    break;
                            }
                            ?>
                            <div class="bx_ordercart_coupon"><input disabled readonly type="text" name="OLD_COUPON[]"
                                                                    value="<?= htmlspecialcharsbx($oneCoupon['COUPON']); ?>"
                                                                    class="<? echo $couponClass; ?>"><span
                                class="<? echo $couponClass; ?>"
                                data-coupon="<? echo htmlspecialcharsbx($oneCoupon['COUPON']); ?>"></span>

                            <div class="bx_ordercart_coupon_notes"><?
                                if (isset($oneCoupon['CHECK_CODE_TEXT'])) {
                                    echo(is_array($oneCoupon['CHECK_CODE_TEXT']) ? implode('<br>', $oneCoupon['CHECK_CODE_TEXT']) : $oneCoupon['CHECK_CODE_TEXT']);
                                }
                                ?></div></div><?
                        }
                        unset($couponClass, $oneCoupon);
                    }
                } else {
                    ?>&nbsp;<?
                }
                ?>
            </div>
            <div class="bx_ordercart_order_pay_right">

                <? if ($arParams["USE_PREPAYMENT"] == "Y" && strlen($arResult["PREPAY_BUTTON"]) > 0): ?>
                    <?= $arResult["PREPAY_BUTTON"] ?>
                    <span><?= GetMessage("SALE_OR") ?></span>
                <? endif; ?>
                <?
                if ($arParams["AUTO_CALCULATION"] != "Y") {
                    ?>
                    <a href="javascript:void(0)" onclick="updateBasket();"
                       class="checkout refresh"><?= GetMessage("SALE_REFRESH") ?></a>
                    <?
                }
                ?>
                <input style="background: #363636;" value="<?= GetMessage("BASKET_CLEAR") ?>" type="submit" name="BasketClear">
                <input style="background: #8DC63F;" value="<?= GetMessage("SALE_ORDER") ?>" type="submit" class="checkout" onclick="checkOut();">

            </div>
            <div style="clear:both;"></div>


        </div>
    </div>
    <div class="dostavka clear">
        <div>
            <h4></h4>
        </div>
        <div>
            <h4>Итого в корзине</h4>
            <ul>
                <? if ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y"): ?>
                    <li>
                        <span>Сумма</span>
                        <span id="PRICE_WITHOUT_DISCOUNT"><?= $arResult["PRICE_WITHOUT_DISCOUNT"] ?></span>
                    </li>

                    <?
                    if (floatval($arResult['allVATSum']) > 0):
                        ?>
                        <li><span>Итого</span>
                            <span id="allSum_FORMATED"></span>
                        </li>
                        <?
                    endif;
                    ?>
                    <li>
                        <span>Скидка</span>
                        <span>
                            <?
                            $sum = preg_replace('/[^0-9]/', '', $arResult["PRICE_WITHOUT_DISCOUNT"]);
                            $total_sum = preg_replace('/[^0-9]/', '', $arResult["allSum_FORMATED"]);
                            echo 100*(1 - ($total_sum/$sum)).' %';
                            ?>
                        </span>
                    </li>
                <? endif; ?>
                <li>
                    <span><?= GetMessage("SALE_TOTAL") ?></span>
                <span class="fwb" id="allSum_FORMATED"><?= str_replace(" ", "&nbsp;", $arResult["allSum_FORMATED"]) ?></span>
                </li>
            </ul>
        </div>
    </div>
    <?
else:
    ?>
    <div id="basket_items_list">
        <table>
            <tbody>
            <tr>
                <td style="text-align:center">
                    <div class=""><?= GetMessage("SALE_NO_ITEMS"); ?></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <?
endif;
?>