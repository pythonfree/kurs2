<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?

#
# INPUT PARAMS
#
$arGadgetParams["IBLOCK_ID"] = intval($arGadgetParams["IBLOCK_ID"]);
if ($arGadgetParams["IBLOCK_ID"] <= 0)
   return false;
   
$arGadgetParams["ELEMENT_COUNT"] = intval($arGadgetParams["ELEMENT_COUNT"]);
if ($arGadgetParams["ELEMENT_COUNT"] <= 0)
	$arGadgetParams["ELEMENT_COUNT"] = 5;

$arGadgetParams["SHOW_UNACTIVE_ELEMENTS"] = $arGadgetParams["SHOW_UNACTIVE_ELEMENTS"]!="N";
   
$arNavParams = array(
	"nPageSize" => $arGadgetParams["ELEMENT_COUNT"],
);

#
# CACHE
#
$obCache = new CPageCache;
$cacheTime = 5*60;
$cacheId = $arGadgetParams["IBLOCK_ID"].$arGadgetParams["ELEMENT_COUNT"].$arGadgetParams["ELEMENT_COUNT"];

if($obCache->StartDataCache($cacheTime, $cacheId, "/")):
	if(!CModule::IncludeModule("iblock"))
	{
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	
	$arSelect = array(
		"ID",
		"ACTIVE",
		"DATE_CREATE",
		"IBLOCK_ID",
		"DETAIL_PAGE_URL",
		"NAME",
		"PREVIEW_PICTURE",
	);
	$arFilter = array (
		"IBLOCK_ID" => $arGadgetParams["IBLOCK_ID"],
		"CHECK_PERMISSIONS" => "Y",
	);
	if(!$arGadgetParams["SHOW_UNACTIVE_ELEMENTS"])
		$arFilter["ACTIVE"] = "Y";
	
	$arSort = array("DATE_CREATE"=>"DESC");
	
	$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);
	while($arElement = $rsElement->GetNext()):
	?>
		<div style="margin-bottom: 10px;">
			<div style="float: left; width: 50px; margin-right: 10px">
			<a href="<?=$arElement['DETAIL_PAGE_URL']?>"><?=CFile::ShowImage($arElement['PREVIEW_PICTURE'],50,50)?></a>
			</div>
			<a href="<?=$arElement['DETAIL_PAGE_URL']?>"><?=$arElement['NAME']?></a><br/>
			<small><?=$arElement['DATE_CREATE']?></small>
			<div style="clear: both;"></div>
		</div>
	<?
	endwhile;
	$obCache->EndDataCache();
endif;

?>