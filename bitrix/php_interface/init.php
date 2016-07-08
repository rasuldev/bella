<?
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserUpdateHandler");
function OnBeforeUserUpdateHandler(&$arFields)
{
    $arFields["LOGIN"] = $arFields["EMAIL"];
    return $arFields;
}

if ($_POST["BasketClear"] and CModule::IncludeModule("sale"))
{
    CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
}