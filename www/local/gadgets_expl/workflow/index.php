<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

echo '<pre>';
print_r($arGadgetParams);
echo '</pre>';

//
//$arGadgetParams["USER_STATUS_ID"] = ($arGadgetParams["USER_STATUS_ID"] ? $arGadgetParams["USER_STATUS_ID"] : 2);
//
//if (intval($arGadgetParams["ELEMENT_COUNT"]) <= 0)
//	$arGadgetParams["ELEMENT_COUNT"] = 5;
//
//$arGadgetParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
//if(strlen($arGadgetParams["IBLOCK_TYPE"])<=0)
// 	$arGadgetParams["IBLOCK_TYPE"] = "news";
//$arGadgetParams["IBLOCK_ID"] = trim($arGadgetParams["IBLOCK_ID"]);
//
//$arNavParams = array(
//		"nPageSize" => $arGadgetParams["ELEMENT_COUNT"],
//	);
//
//$obCache = new CPageCache;
//$life_time = 30*60; //30 �����
//$cache_id = $arGadgetParams["IBLOCK_TYPE"].$arGadgetParams["IBLOCK_ID"].$USER->GetGroups();
//
//
//if($obCache->StartDataCache($life_time, $cache_id, "/")):
//	if(!CModule::IncludeModule("iblock"))
//	{
//		$this->AbortResultCache();
//		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
//		return;
//	}
//	elseif (!CModule::IncludeModule("workflow"))
//	{
//		$this->AbortResultCache();
//		ShowError(GetMessage("WORKFLOW_MODULE_NOT_INSTALLED"));
//		return;
//	}
//	$rsIBlock = CIBlock::GetList(array(), array(
//		"ACTIVE" => "Y",
//		"ID" => $arGadgetParams["IBLOCK_ID"],
//		"SITE_ID" => $arGadgetParams["SITE_ID"],
//	));
//	if($arResult = $rsIBlock->GetNext())
//	{
//		$arSelect = array(
//			"ID",
//			"IBLOCK_ID",
//			"NAME",
//			"DATE_CREATE",
//			"PREVIEW_PICTURE",
//		);
//		$arFilter = array (
//			"IBLOCK_ID" => $arResult["ID"],
//			"IBLOCK_LID" => $arGadgetParams["SITE_ID"],
//			"ACTIVE" => "Y",
//			"CHECK_PERMISSIONS" => "Y",
//			"SHOW_HISTORY" => "Y",
//			"WF_STATUS_ID" => $arGadgetParams["USER_STATUS_ID"],
//		);
//		$arSort = array("SORT"=>"ASC");
//
//		//Execute
//		$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);
//		echo "<table border=0>";
//		while($obElement = $rsElement->GetNext())
//		{?>
<!--			<tr>-->
<!--				<td valign="top" style="padding: 10px 0px 10px 0px;">--><?//=CFile::ShowImage($obElement['PREVIEW_PICTURE'], 60, 40);?><!--</td>-->
<!--				<td style="color:gray; padding:10px 0px 10px 0px;" >--><?//=GetMessage("GD_WORKFLOW_CREATE").": ".$obElement["DATE_CREATE"]?><!--<br><a href="--><?//="/bitrix/admin/iblock_element_edit.php?WF=Y&ID=".$obElement["ID"]."&type=".$arResult["IBLOCK_TYPE_ID"]."&IBLOCK_ID=".$arResult["ID"]?><!--">--><?//=$obElement['NAME']?><!--</a></td>-->
<!--			</tr>-->
<!--		--><?//}
//		echo "</table>";
//	}
//	$obCache->EndDataCache();
//endif;
//
//?>
<!---->
<!---->
