<?php
/**
 * Класс помощник для создания миниатюр изображений
 * 
 */
class ResizeHelper
{
    const RESIZED_PATH='webroot.uploads.resized';
    const DEFAULT_WATERMARK='/images/watermark.png';

    /**
     * Resize image
     * @static
     * @param $sourceFileName
     * @param $width
     * @param $height
     * @param $top
     * @param $resize
     * @return mixed
     */
    public static function resize($sourceFileName, $width=0, $height=0, $top=false, $resize=false)
    {
        if($sourceFileName) {
            $sourceFileName=static::normalizeFileName($sourceFileName);
            $tmbFileName=static::getTmbFileName($sourceFileName, $width, $height);
            if(!file_exists($tmbFileName)) {
                $ih=new CImageHandler();
                $ih->load($sourceFileName);
                if(!$width || !$height || $resize) {
                    $ih->resize($width, $height);
                } else {
                    $ih->adaptiveThumb($width, $height, $top);
                }
                try {
                    static::createPath(dirname($tmbFileName));
                    $ih->save($tmbFileName, false, 95);
                }
                catch(\Exception $e) {
                    return static::getRelativeFileName($sourceFileName);
                }
            }

            return static::getRelativeFileName($tmbFileName);
        }

        return null;
    }

    /**
     * Resize image
     * @static
     * @param $sourceFileName
     * @param $zoom
     * @param $force
     * @param $watermark
     * @return mixed
     */
    public static function watermark($sourceFileName, $zoom=false, $force=false, $watermark=null)
    {
        if($sourceFileName) {
            $sourceFileName=static::normalizeFileName($sourceFileName);
            $waterFileName=static::getTmbFileName($sourceFileName, 0, 0, 'water_');
            if(!file_exists($waterFileName) || $force) {
                $ih=new CImageHandler();
                $ih->load($sourceFileName);

                $watermark=static::normalizeFileName($watermark ?: self::DEFAULT_WATERMARK);
                $ih->watermark($watermark, 0, 0, CImageHandler::CORNER_CENTER, $zoom);

                static::createPath(dirname($waterFileName));
                $ih->save($waterFileName, false, 95);
            }

            return static::getRelativeFileName($waterFileName);
        }

        return null;
    }

	/**
     * Resize with watermark
     */
    public static function wresize($sourceFileName, $width=null, $height=null, $zoom=0.75, $force=true)
    {
        return static::watermark(static::resize($sourceFileName, $width, $height), $zoom, $force);
    }

    public static function watermarkModifier($sourceFileName, $force=false, $watermark=null)
    {
        $originalPath=static::getRelativeFileName($sourceFileName);
        if($sourceFileName) {
            $sourceFileName=static::normalizeFileName($sourceFileName);
            $waterFileName=static::getTmbFileName($sourceFileName, 0, 0, 'w2_');
            $watermark=static::normalizeFileName($watermark ?: self::DEFAULT_WATERMARK);
            if(!file_exists($waterFileName) || $force) {
                if (!is_file($watermark) || !is_file($sourceFileName)) {
                    return $originalPath;
                }

                if(!\Yii::app()->hasComponent('imagemod')) {
                    \Yii::app()->setComponent('imagemod', [
                        'class'=>'application.extensions.imagemodifier.CImageModifier'
                    ]);
                }

                if(copy($sourceFileName, $waterFileName)) {
                    $image=\Yii::app()->imagemod->load($waterFileName);
                    $image->image_watermark = $watermark;
                    $image->image_watermark_position = 'CC';
                    $image->jpeg_quality = 100;
                    $image->file_new_name_body = $image->file_src_name_body;
                    $image->file_overwrite = true;
                    $image->image_watermark_no_zoom_in=false;
                    $image->image_watermark_no_zoom_out=false;
        
                    static::createPath(dirname($waterFileName));
                    $image->process(dirname($waterFileName));
                }
                else {
                    return $originalPath;
                }
            }

            return static::getRelativeFileName($waterFileName);
        }
    }

    public static function normalizeFileName($filename)
    {
        if (strpos($filename, "?")) {
            $filename=substr($filename, 0, strpos($filename, "?"));
        }

        if(strpos($filename, static::getWebRoot()) !== 0) {
	        $filename=rtrim(static::getWebRoot(), '/\\\\') . '/' . $filename;
        }

        return static::normalizePath($filename);
    }

    protected static function getRelativePath($filename)
    {
        $path=dirname($filename);
        if(strpos($path, static::getWebRoot()) === 0) {
	        $relativePath='/' . trim(substr($path, strlen(static::getWebRoot())), '/\\\\');
        }
        else {
            $relativePath='/' . trim($path, '/\\\\');
        }

        return static::normalizeRelativePath($relativePath);
    }

    protected static function getRelativeFileName($filename)
    {
        return static::normalizeRelativePath(static::getRelativePath($filename) . '/' . basename($filename));
    }

    protected static function getTmbFileName($filename, $width=null, $height=null, $prefix='')
    {
        $width=(int)$width;
        $height=(int)$height;
        $filename=static::normalizeFileName($filename);
        $sourcePath=dirname($filename);
        $sourceBasename=basename($filename); 
        $relativePath=static::getRelativePath($filename);
        $salt=hash_file('md5', $filename);
        $tmbBasename=$prefix.$salt . (($width || $height) ? "_{$width}_{$height}" : '') . "_{$sourceBasename}";

        return static::normalizeRecusivePath(static::normalizePath(static::getBasePath() . $relativePath . '/' . $tmbBasename));
    }

    protected static function getBasePath()
    {
        static $basePath=null;
        
        if(!$basePath) {
            $basePath=static::normalizePath(\Yii::getPathOfAlias(self::RESIZED_PATH));
            static::createPath($basePath);
        }
        
        return $basePath;
    }

    protected static function createPath($path)
    {
        if(!is_dir($path)) {
			mkdir($path, 0755, true);
            chmod($path, 0755);
        }
    }

    protected static function getWebRoot()
    {
        static $webroot=null;

        if(!$webroot) {
            $webroot=static::normalizePath(\Yii::getPathOfAlias('webroot'));
        }

        return $webroot;
    }

    protected static function normalizePath($path)
    {
        return preg_replace('#[/\\\\]+#', DIRECTORY_SEPARATOR, $path);
    }

    protected static function normalizeRelativePath($path)
    {
        return preg_replace('#[/\\\\]+#', '/', $path);
    }

    protected static function normalizeRecusivePath($filename)
    {
        $relativeBasePath=static::normalizePath(static::getRelativeFileName(static::getBasePath()));
        return preg_replace('#(' . preg_quote($relativeBasePath) . ')+#', $relativeBasePath, $filename);
    }
}
