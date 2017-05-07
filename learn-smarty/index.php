<?php
	require_once('./smarty/Smarty.class.php');
	$smarty=new Smarty();
	$smarty->setTemplateDir('./templates');
	$smarty->setCompileDir('./templates_c');
	$smarty->setCacheDir('./cache');
	$smarty->setConfigDir('./configs');
	$smarty->assign('name','Stephen');
	$smarty->display('index.tpl');
?>