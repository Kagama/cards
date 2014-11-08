<?php
namespace common\helpers;
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 15.05.14
 * Time: 19:51
 */
class CString
{

    const RU_LANG = 1;
    const ENG_LANG = 2;

    /**
     * Транслит по госту "ГОСТ 16876-71"
     *
     * @param string $string
     * @param integer $lang
     * @return string
     */
    static public function translitTo($string, $lang = 1)
    {
        if ($lang == 1) {
            $RuToEn = array('.' => '_', '?' => '', '!' => '', '<' => '', '>' => '', '/' => '', '|' => '', "\\" => '', '-' => '_', "\"" => '', "\'" => '', 'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'jo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'jj', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'kh', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'eh', 'ю' => 'ju', 'я' => 'ja');
            $RuToEn2 = array('А' => 'a', 'Б' => 'b', 'В' => 'v', 'Г' => 'g', 'Д' => 'd', 'Е' => 'e', 'Ё' => 'jo', 'Ж' => 'zh', 'З' => 'z', 'И' => 'i', 'Й' => 'jj', 'К' => 'k', 'Л' => 'l', 'М' => 'm', 'Н' => 'n', 'О' => 'o', 'П' => 'p', 'Р' => 'r', 'С' => 's', 'Т' => 't', 'У' => 'u', 'Ф' => 'f', 'Х' => 'kh', 'Ц' => 'c', 'Ч' => 'ch', 'Ш' => 'sh', 'Щ' => 'shh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'Э' => 'eh', 'Ю' => 'ju', 'Я' => 'ja');

            $string = trim(strip_tags($string));
            $string = strtr($string, $RuToEn);

            $string = strtr($string, $RuToEn2);
            $string = preg_replace("/\s+/ms", "_", $string);
            $string = preg_replace("/[ ]+/", "_", $string);
            $string = preg_replace("/[^a-z0-9_\.]+/mi", "", $string);
        }
        return $string;
    }

    static public function replace($search, $replace, $subject)
    {
        return str_replace($search, $replace, $subject);
    }

    static public function price($_price)
    {
        $float = "";
        $integer = "";
        $str = (string)$_price;
        if (strpos($str, '.')) {
            list($integer, $float) = explode('.', $str);
        } else {
            $integer = $str;
        }
        $strLen = strlen($integer);
        $temp = "";
        $ii = 0;
//                echo $strLen;
        if ($strLen >= 4) {
            for ($i = $strLen; $i > 0; $i--) {
                if ($i % 3 == 0) {
                    $temp .= " ";
                }
                $temp .= $integer{$ii};
                $ii++;
            }
            if ($temp{0} == " ") {
                $temp = substr($temp, 1);
            }
        } else {
            $temp = $integer;
        }
        return $temp; // 2222
//                return $temp . (!empty($float) ? "." . $float : ""); // 222.22
    }

    static public function strLen($_str, $_enc = 'UTF-8')
    {
        return mb_strlen($_str, $_enc);
    }

    public static function subStr($_str, $_start, $_length, $_after_str = '...', $_enc = 'UTF-8')
    {
        $real_str_length = self::strLen($_str, $_enc);
        if ($_length < $real_str_length) {
            return mb_substr($_str, $_start, ($_length - (self::strLen($_after_str))), $_enc) . $_after_str;
        }
        return mb_substr($_str, $_start, $_length, $_enc);
    }
}