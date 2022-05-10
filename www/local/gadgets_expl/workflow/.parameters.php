<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!CModule::IncludeModule("iblock") || !CModule::IncludeModule("workflow"))
	return;

$arTypes = CIBlockParameters::GetIBlockTypes();
//$arComponentParameters["PARAMETERS"]["SITE_ID"] = $_REQUEST["src_site"];
$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$arStatus=Array();
$dbres = CWorkflowStatus::GetList($order, $by, array("ACTIVE"=> 'Y'));
while ($arres = $dbres->Fetch())
{
	$arStatus[$arres["ID"]] = $arres["TITLE"];
}

$arParameters = Array(
		"PARAMETERS"=> Array(
			"IBLOCK_TYPE" => Array(
				"PARENT" => "BASE",
				"NAME" => GetMessage("GD_WORKFLOW_LIST_TYPE"),
				"TYPE" => "LIST",
				"VALUES" => $arTypes,
				"DEFAULT" => "news",
				"REFRESH" => "Y",
			),
			"IBLOCK_ID" => Array(
				"PARENT" => "BASE",
				"NAME" => GetMessage("GD_WORKFLOW_LIST_ID"),
				"TYPE" => "LIST",
				"VALUES" => $arIBlocks,
				"DEFAULT" => '',
				"ADDITIONAL_VALUES" => "Y",
				"REFRESH" => "Y",
			),
			"ELEMENT_COUNT" => array(
				"PARENT" => "BASE",
				"NAME" => GetMessage("GD_WORKFLOW_ELEMENT_COUNT"),
				"TYPE" => "STRING",
				"DEFAULT" => '5',
			),
			"SITE_ID" => array(
				"PARENT" => "BASE",
				"NAME" => "test111",
				"TYPE" => "STRING",
				"DEFAULT" => $_REQUEST["src_site"],
				"HIDDEN" => 'Y',
			),
		),
		"USER_PARAMETERS"=> Array(
			"USER_STATUS_ID" => array(
				"PARENT" => "BASE",
				"NAME" => GetMessage("GD_WORKFLOW_STATUS_ID"),
				"TYPE" => "LIST",
				"VALUES" => $arStatus,
			),
		),
	);
$arParameters["USER_PARAMETERS"]["USER_STATUS_ID"]["DEFAULT"] = 2;
?>
