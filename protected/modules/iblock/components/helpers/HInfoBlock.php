<?php
namespace iblock\components\helpers;

use common\components\helpers\HArray as A;
use common\components\helpers\HFile;
use iblock\components\InfoBlockHelper;
use iblock\models\InfoBlock;

class HInfoBlock
{
    /**
     * Кэш конфигураций инфоблоков
     *
     * @var []
     */
    private static $configs=[];

    /**
     * Получить конфигурацию инфоблока
     *
     * @param string $code символьный код инфоблока
     * @return []|null
     */
    public static function config($code)
    {
        if(!A::existsKey(static::$configs, $code)) {
            static::$configs[$code]=HFile::includeByAlias('application.config.infoblocks.' . $code);
        }

        return static::$configs[$code];
    }

    /**
     * Получить значения параметра конфигурации для инфоблока
     *
     * @param string $code символьный код инфоблока
     * @param string $name имя параметра
     * @param mixed $default значение по умолчанию.
     * @return mixed
     */
    public static function param($code, $name, $default=null)
    {
        if($config=static::config($code)) {
            if(strpos($name, '.') !== false) {
                return A::rget($config, $name, $default, '.');
            }
            else {
                return A::get($config, $name, $default);
            }
        }

        return $default;
    }

    /**
     * Получить элементы инфоблока по символьному коду инфоблока
     *
     * @param string $code
     * @return []|null
     */
    public static function getElementsByCode($code)
    {
        if($iblock=InfoBlock::model()->findByAttributes(['code'=>$code])) {
            return InfoBlockHelper::getElements($iblock->id);
        }

        return null;
    }
}