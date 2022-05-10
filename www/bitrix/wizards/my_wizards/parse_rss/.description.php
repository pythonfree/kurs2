<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//version
include(dirname(__FILE__) . '/version.php');

$arWizardDescription = array(
	"NAME" => GetMessage("MASTER_NAME"),
	"DESCRIPTION" => GetMessage("MASTER_DESCRIPTION"),
	"VERSION" => $arWizardVersion['VERSION'],
	"STEPS" => array("MainFields", "AdditionalFields", "Summary")
);
?>