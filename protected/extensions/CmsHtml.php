<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rick
 * Date: 30.09.11
 * Time: 19:11
 * To change this template use File | Settings | File Templates.
 */

use common\components\helpers\HYii as Y;
 
class CmsHtml
{
	/**
	 * Путь относительно webroot к директории для откомпелированных less файлов
	 * @var string
	 */
	const LESS_COMPILE_DIR = '/assets/css';

    static $_state = array();

    private function jcrop_admin_plugins(){
        Yii::app()->clientScript->registerScriptFile('/js/jquery/jquery.jcrop.min.js');
        Yii::app()->clientScript->registerCssFile('/css/jcrop/jquery.jcrop.css');
    }

    public static function editPricePlugin()
    {
    }

    public static function head()
    {
        /*
        if(Yii::app()->user->getState('role')=='admin'){
            self::jcrop_admin_plugins(); 
        }
        /**/

        if(D::cms('system_slick')) {
            Y::jsCore('slick');
        }

        if(D::cms('system_lazyload', true, true)) {
            self::lazyload();
        }

        self::jquery();
        self::css();
        self::less();
        self::metaTags();
        self::noskype();
        self::fancybox();        
    }

    public static function lazyload()
    {
        // lazy load images
        $lazyloadSrc=defined('LAZYLOAD_SRC') ? LAZYLOAD_SRC : '//cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js';
        
        /*
        Y::js(
    		'core.lazyload', 
    		'window.addEventListener("DOMContentLoaded",function(e){let loaded=false;function loadlazy(){loaded=true;'
    			. 'let jqiid=setInterval(function(){if(typeof(jQuery)!="undefined"){clearInterval(jqiid);'
    			. 'let s=document.createElement("script");s.src="' . $lazyloadSrc . '";s.type="text/javascript";$("body").append(s);'
				. 'let lziid=setInterval(function(){if(typeof(lazyload)!="undefined"){clearInterval(lziid);lazyload(jQuery("[data-lazyload]").toArray());'
				. 'setInterval(function(){lazyload(jQuery("[data-lazyload]").toArray());},1000);}},200);}},200);}'
				. 'setTimeout(function(){if(!loaded){loadlazy()}},200);$(document).on("scroll mousemove",function(){if(!loaded){loadlazy()}});});', 
			\CClientScript::POS_HEAD
		);

		Y::js(
			'core.lazyloadscripts', 
			'window.__jsLazyLoadIntialized=false;window.__jsLazyLoadIntervalId=setInterval(function(){if(typeof $!=\'undefined\'){'
				. 'clearInterval(window.__jsLazyLoadIntervalId);window.__jsLazyLoadIntialized=true;}},100);'
				. 'window.__jsLazyLoad=function(src,delay,attrs,el){let loaded=false,intervalId=setInterval(function(){'
				. 'if(window.__jsLazyLoadIntialized){clearInterval(intervalId);function load(){if(!loaded){loaded=true;let s=document.createElement("script");'
				. 's.type="text/javascript";s.src=src;if(typeof attrs=="undefined"){attrs={}}for(let a in attrs){s.setAttribute(a,attrs[a]);}$(!el?"body":el).append(s);}}'
				. 'if((typeof delay=="undefined")||(delay===null)){$(document).on("scroll mousemove",function(){load();});}else{setTimeout(function(){load();},delay);}}},100);};'
				. 'window.__jsLazyLoadScript=function(func,delay){let loaded=false,intervalId=setInterval(function(){if(window.__jsLazyLoadIntialized){'
				. 'clearInterval(intervalId);function load(){if(!loaded){loaded=true;func();}}'
				. 'if(typeof delay=="undefined"){$(document).on("scroll mousemove",function(){load();});}else{setTimeout(function(){load();},delay);}}},100);};', 
			\CClientScript::POS_HEAD
        );
        */

        // lazy load scripts
		// window.__jsLazyLoad(src,delay=null,attrs={},el="body")
        // window.__jsLazyLoadScript(func,delay=undefined)
        Y::js(
            'core.lazyloadscripts.minify',
            'window.addEventListener("DOMContentLoaded",function(t){let e=!1;function n(){e=!0;let t=setInterval(function(){if("undefined"!=typeof jQuery){clearInterval(t);let e=document.createElement("script");e.src="' . $lazyloadSrc . '",e.type="text/javascript",$("body").append(e);let n=setInterval(function(){"undefined"!=typeof lazyload&&(clearInterval(n),lazyload(jQuery("[data-lazyload]").toArray()),setInterval(function(){lazyload(jQuery("[data-lazyload]").toArray())},1e3))},200)}},200)}setTimeout(function(){e||n()},200),$(document).on("scroll mousemove",function(){e||n()})}),window.__jsLazyLoadIntialized=!1,window.__jsLazyLoadIntervalId=setInterval(function(){"undefined"!=typeof $&&(clearInterval(window.__jsLazyLoadIntervalId),window.__jsLazyLoadIntialized=!0)},100),window.__jsLazyLoad=function(t,e,n,o){let a=!1,i=setInterval(function(){if(window.__jsLazyLoadIntialized){function d(){if(!a){a=!0;let e=document.createElement("script");e.type="text/javascript",e.src=t,void 0===n&&(n={});for(let t in n)e.setAttribute(t,n[t]);$(o||"body").append(e)}}clearInterval(i),null==e?$(document).on("scroll mousemove",function(){d()}):setTimeout(function(){d()},e)}},100)},window.__jsLazyLoadScript=function(t,e){let n=!1,o=setInterval(function(){if(window.__jsLazyLoadIntialized){function a(){n||(n=!0,t())}clearInterval(o),void 0===e?$(document).on("scroll mousemove",function(){a()}):setTimeout(function(){a()},e)}},100)};'
        );
    }

    public static function css($files = array())
    {
        if (!$files)
//            $files = array('editor.css', 'form.css', 'question.css', 'review.css', 'template.css', 'style.css');
            $files = array('jquery.mmenu.all.css');

        $cs = Yii::app()->clientScript;

        if(is_string($files)) $files = array($files);

        foreach($files as $file) {
            if ($path = self::getCssPath($file)) {
                $cs->registerCssFile($path.'/'.$file);
            }
        }
    }

    public static function less($files=array()) 
    {
    	if (!$files)
            if (\Yii::app()->params['isAdaptive']):
                $files = array('client.less', 'client-media-query.less', 'template.less', 'template-media-query.less');
            else:
                $files = array('client.less', 'template.less');
            endif;
		
		if(!is_dir(\Yii::getPathOfAlias('webroot') . self::LESS_COMPILE_DIR)) 
			mkdir(\Yii::getPathOfAlias('webroot') . self::LESS_COMPILE_DIR);
        
        $cs = Yii::app()->clientScript;

		foreach($files as $file) {
        	if ($path = self::getCssPath($file)) {
		 		$cssFile = \Yii::app()->assetManager->lessCompile(\Yii::getPathOfAlias('webroot') . $path . '/' . $file);
				$destCssFile = preg_replace('/^(.*)([^\/\\\\]+)(.less)$/U', '\\1\\2.css', $file);
				copy($cssFile, \Yii::getPathOfAlias('webroot') . $path . '/' . $destCssFile);
 				$cs->registerCssFile($path . '/' . $destCssFile);
			}
		}
	}

    private static function getCssPath($file_name)
    {
        if (is_file(Yii::getPathOfAlias('webroot.css').DS.$file_name)) {
            return '/css';
        }

        $theme = Yii::app()->theme;
        if (is_file(Yii::getPathOfAlias('webroot.themes.'.$theme->name.'.css') .DS. $file_name)) {
            return $theme->baseUrl.'/css';
        }

        return false;
    }

    /**
     * Find all allowed css files
     *
     * @static
     * @return array
     */
    private static function findAllCss()
    {
        $paths = array(
            'css',
            'themes.'.Yii::app()->theme->name.'.css'
        );

        $exclude = array('.', '..');

        $result = array();

        foreach($paths as $path) {
            $files = scandir(Yii::getPathOfAlias('webroot.'.$path));
            foreach($files as $file) {
                if (in_array($file, $exclude))
                    continue;
                $result[] = $file;
            }
        }
        return $result;
    }

    public static function jquery()
    {
        Yii::app()->clientscript->registerCoreScript('jquery');
    }

    public static function js($src = '', $jquery = true)
    {
        if (empty($src))
            throw new CException('Не указан js-файл');

        if (is_array($src)) {
            foreach($src as $link)
                Yii::app()->clientScript->registerScriptFile($link);
        } else
            Yii::app()->clientScript->registerScriptFile($src);

    }

    public static function noskype()
    {
        Yii::app()->clientScript->registerMetaTag('SKYPE_TOOLBAR_PARSER_COMPATIBLE', 'SKYPE_TOOLBAR');
    }

    public static function fancybox()
    {
        if (isset(self::$_state['fancybox']))
            return;

        $cs = Yii::app()->clientScript;

        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile('/js/fancybox/jquery.fancybox.min.js');
        $cs->registerCssFile('/js/fancybox/jquery.fancybox.min.css');
        $cs->registerScript('fancybox-settings', '$.fancybox.defaults.hash = false;');

        self::$_state['fancybox'] = true;
    }

    public static function metaTags()
    {
        echo "<title>". CHtml::encode(Yii::app()->controller->pageTitle)."</title>\n";

        $cs = Yii::app()->clientScript;

        $cs->registerMetaTag(null, null, null, array('charset'=>'utf-8'));
        $cs->registerMetaTag('index, follow', 'robots');

        self::addFavicon();
        self::seoTags();
    }

    public static function seoTags($metadata = array())
    {
        $meta_key  = Yii::app()->controller->meta_key;
        $meta_desc = Yii::app()->controller->meta_desc;

        $cs = Yii::app()->clientScript;

        if (!empty($meta_key))
            $cs->registerMetaTag($meta_key, 'keywords');

        if (!empty($meta_desc))
            $cs->registerMetaTag($meta_desc, 'description');
    }

    private static function getFaviconType($icon) {
        if (strpos($icon, '.png') !== false) {
            return 'image/png';    
        }
        return 'image/x-icon';
    }

    private static function addFavicon()
    {
        /** @var EClientScript $cs */
        $cs   = Yii::app()->clientScript;
        $icon =  \Yii::app()->settings->getCurrentFavicon();
        $cs->registerLinkTag('shortcut icon', static::getFaviconType($icon) , $icon);

    }
    
}
