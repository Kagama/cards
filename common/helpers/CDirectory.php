<?php
namespace common\helpers;

use Yii;
use yii\base\Component;

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Пример:
 *
 * $path = 'images/catalog_старая реализация без типа продукта';
 * CDirectory::createDir($path);
 *
 */

class CDirectory extends Component
{

    public static function deleteDirWithFiles($directory, $empty = false)
    {

//        if (strpos($dir, "/") == 0) {
//            $dir = substr($dir, 1);
//        }
//        if ((strlen($dir)-1) == strripos ($dir, '/')) {
//            $dir = substr($dir, 0, -1);
//        }

        //$dir = Yii::app()->basePath.'/../'.$dir;

        if (substr($directory, -1) == '/') {
            $directory = substr($directory, 0, -1);
        }
        if (!file_exists($directory) || !is_dir($directory)) {
            return FALSE;
        } elseif (is_readable($directory)) {
            $handle = opendir($directory);
            while (FALSE !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..') {
                    $path = $directory . '/' . $item;
                    if (is_dir($path)) {
                        self::deleteDirWithFiles($path);
                    } else {
                        unlink($path);
                    }
                }
            }
            closedir($handle);
            if ($empty == FALSE) {
                if (!rmdir($directory)) {
                    return FALSE;
                }
            }
        }
        return TRUE;

    }

    public static function createDir($dir, $rightLevel = 0777)
    {
        $dirsArr = explode("/", $dir);
        $count = count($dirsArr);
        $path = Yii::$app->basePath."/../";
        for ($i = 0; $i < $count; $i++) {
            if (empty($dirsArr[$i])) continue;
            if (is_dir($path . $dirsArr[$i])) {
                $path = $path . $dirsArr[$i] . "/";
            } else {
                $path = $path . $dirsArr[$i] . "/";
                mkdir($path, 0755);
                chmod($path, $rightLevel);

            }
        }
    }
}

?>
