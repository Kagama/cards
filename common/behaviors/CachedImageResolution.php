<?php

namespace common\behaviors;

use common\helpers\CDirectory;
use Yii;
use yii\db\ActiveRecord;
use yii\base\Behavior;
use yii\image\drivers\Image;



class CachedImageResolution extends Behavior {

    public $attr_src = "src";
    public $attr_img_name = "img";

    private $path_to_cache_dir = "";
    private $resize = "";
    private $master = "";
    private $crop = "";

    public function doCache($_resize = '100x100', $_master = 'width', $_crop = '', $crop_x = 'center', $crop_y = 'center') {

        $this->resize = strtolower($_resize);
        $this->master = $_master;
        $this->crop = strtolower($_crop);

        if (($link_cache = $this->allReadyInCache()) === true) {
            return $this->getCachedImg();
        } else {
//            var_dump(is_file(Yii::$app->basePath."/../common/images/modules/catalog/manufacture/42/c28cef4f2ea72554527660cef1bcef65.jpg"));

            if (!is_file(Yii::$app->basePath."/../".$this->getPathRealPhoto())) {
                return false;
            }

            list($width, $height) = explode("x", $this->resize);

            // Создаем директорию для кеша
            CDirectory::createDir("cache"."/".$this->getPhotoSrc());

            $image = Yii::$app->image->load(Yii::$app->basePath."/../".$this->getPathRealPhoto());

            $height = ($height == 'null' ? null : $height);
            $IMGmaster = ($this->master == 'height' ? Image::HEIGHT : ($this->master == 'width' ? Image::WIDTH : Image::AUTO ) ) ;

            if (empty($this->crop)) {
                $image->resize($width, $height, $IMGmaster);
            } else {
                $cropWidth = null;
                $cropHeight = null;
                list($cropWidth, $cropHeight) = explode("x", $this->crop);
                if (empty($cropHeight)) {
                    $cropHeight = $cropWidth;
                }
                $image->resize($width, $height, $IMGmaster)->crop($cropWidth, $cropHeight);
            }

            $image->save(Yii::$app->basePath."/../".$link_cache, 100);
            return "/".$link_cache;
        }
    }

    protected  function getPhotoSrc () {
        return $this->owner->{$this->attr_src};
    }

    protected function getPhotoName() {
        return $this->owner->{$this->attr_img_name};
    }

    private function getPathToCacheDir () {
        $this->path_to_cache_dir = Yii::$app->basePath."/../cache"; //Yii::getAlias('@common/cache');
    }

    protected function getPhotoPath() {
        return $this->path_to_cache_dir.'/'.$this->getPhotoSrc();
    }
    protected function getPathRealPhoto() {
        return "".$this->getPhotoSrc()."/".$this->getPhotoName();
    }
    protected function getPhoto() {
        return $this->getPhotoPath()."/".$this->getPhotoName();
    }

    private function getCachedImg () {
        $this->getPathToCacheDir();
        return "cache/".$this->getPhotoSrc()."/".$this->resize."_".($this->crop != "" ? $this->crop."_" : "").$this->getPhotoName();
    }

    private function allReadyInCache () {
        $path_to_img = $this->getCachedImg();
        return is_file(Yii::$app->basePath."/../".$path_to_img) ? true : $path_to_img;
    }
}
