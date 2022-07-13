<?php
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once(dirname(__FILE__).'/components/helpers/HCMS.php');

$yiic=HCMS::getYiicFile();

$config=dirname(__FILE__).'/config/console.php';

require_once($yiic);
