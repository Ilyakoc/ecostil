<?php
if (preg_replace('/^([^?]+)\?(.*)$/', '$1', $_SERVER['REQUEST_URI']) == '/index.php') {
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: /');
    exit;
}
ob_start();

define('DS', DIRECTORY_SEPARATOR);
defined('APP_IS_ADMIN_AREA') or define('APP_IS_ADMIN_AREA', preg_match('/(admin|cp)/i', $_SERVER['REQUEST_URI']));
defined('LAZYLOAD_SRC') or define('LAZYLOAD_SRC', '//cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js');

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING); // ~E_WARNING - Fix PHP 7.0 deprecateds.
$debugMode = true;
if (!isset($debugMode)) {
    error_reporting(0);
}
ini_set('default_charset', 'utf8');
ini_set('display_errors', empty($debugMode) ? 'off' : 'on');
ini_set('short_open_tag', 'on');

date_default_timezone_set('Asia/Novosibirsk');
mb_internal_encoding('utf-8');
header('Content-Type: text/html; charset=utf-8');

require_once(dirname(__FILE__) . '/protected/components/helpers/HCMS.php');
HCMS::robots();

$yii = HCMS::getYiiFile();

if (is_file(dirname(__FILE__) . DS . 'local.index.php')) {
    include('local.index.php');
}

if (empty($yii)) {
    die('Framework not found!');
}

defined('D_MODE_LOCAL') or define('D_MODE_LOCAL', (strpos($_SERVER['SERVER_NAME'], 'local') !== false));

if (!empty($debugMode)) defined('YII_DEBUG') or define('YII_DEBUG', true);

defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

$config = dirname(__FILE__) . '/protected/config/main.php';

require_once($yii);

Yii::createWebApplication($config)->run();

if (APP_IS_ADMIN_AREA || !D::cms('system_lazyload', true, true)) {
    ob_end_flush();
} else {
    // lazy load
    $content = ob_get_clean();
    echo preg_replace_callback('#<img([^>]*?) src="([^\s>]+)"([^>]*?)>#i', function ($m) {
        if (preg_match('#data-lazyload-disable#', $m[0]) || !preg_match('#^/(images|uploads)/.*$#', $m[2])) {
            return $m[0];
        }
        return '<img' . $m[1] . ' src="/images/dot-loader.gif" data-lazyload="1" data-src="' . $m[2] . '"' . $m[3] . '>';
    }, $content);
}
