<?
global $MESS;
$strPath2Lang = str_replace("\\", "/", __FILE__);
$strPath2Lang = substr($strPath2Lang, 0, strlen($strPath2Lang)-strlen("/install/index.php"));
include(GetLangFileName($strPath2Lang."/lang/", "/install/index.php"));
Class kit_adsectlist extends CModule
{
var $MODULE_ID = "kit.adsectlist";
var $MODULE_VERSION;
var $MODULE_VERSION_DATE;
var $MODULE_NAME;
var $MODULE_DESCRIPTION;
var $MODULE_CSS;

function kit_adsectlist()
{
	$arModuleVersion = array();

	$path = str_replace("\\", "/", __FILE__);
	$path = substr($path, 0, strlen($path) - strlen("/index.php"));
	include($path."/version.php");

	if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
	{
	$this->MODULE_VERSION = $arModuleVersion["VERSION"];
	$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
	}

	$this->MODULE_NAME = GetMessage("MODULE_NAME");
	$this->MODULE_DESCRIPTION = GetMessage("MODULE_DESCRIPTION");
	$this->PARTNER_NAME = GetMessage("PARTNER_NAME");
	$this->PARTNER_URI = GetMessage("PARTNER_URI");
}

function InstallFiles($arParams = array())
{
	CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/kit.adsectlist/install/js", $_SERVER["DOCUMENT_ROOT"]."/bitrix/js/kit.adsectlist");
	CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/kit.adsectlist/install/themes", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/", true, true);
	CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/kit.adsectlist/install/components", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
	return true;
}

function UnInstallFiles()
{
	DeleteDirFilesEx("/bitrix/components/kit/catalog.section.list");
	DeleteDirFilesEx("/bitrix/themes/.default/kit.adsectlist");
	DeleteDirFilesEx("/bitrix/themes/.default/kit.adsectlist.css");
	DeleteDirFilesEx("/bitrix/components/kit/catalog.section.list");
	DeleteDirFilesEx("/bitrix/js/kit.adsectlist");
	return true;
}

function DoInstall()
{
	global $DOCUMENT_ROOT, $APPLICATION;
	$this->InstallFiles();
	RegisterModule("kit.adsectlist");
	$APPLICATION->IncludeAdminFile(GetMessage("MODULE_INSTALL"), $DOCUMENT_ROOT."/bitrix/modules/kit.adsectlist/install/step.php");
		print_r($DOCUMENT_ROOT);
}

function DoUninstall()
{
	global $DOCUMENT_ROOT, $APPLICATION;
	$this->UnInstallFiles();
	UnRegisterModule("kit.adsectlist");
	$APPLICATION->IncludeAdminFile(GetMessage("MODULE_UNINSTALL"), $DOCUMENT_ROOT."/bitrix/modules/kit.adsectlist/install/unstep.php");
}
}
?>