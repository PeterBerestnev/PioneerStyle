<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use CIBlockElement;

if ($this->startResultCache()) {
    $products = array();

    if (Loader::includeModule("iblock")) {
        $filter = array(
            "IBLOCK_SECTION_ID" => $this->arParams["IBLOCK_SECTION_ID"], // ID раздела
            "ACTIVE" => "Y"
        );
    
        $select = array(
            "ID",
            "NAME"
        );
    
        $productResult = CIBlockElement::GetList(array(), $filter, false, false,$select);
    
        while ($product = $productResult->GetNext()) {
            $products[] = $product;
        }
    }
    
         
    $this->arResult["PRODUCTS"] = $products;
    $this->includeComponentTemplate();
}

   