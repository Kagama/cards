<?php
namespace common\widget;

use yii\base\Widget;
use yii\base\InvalidCallException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\View;

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 21.05.14
 * Time: 17:44
 */
class TreeViewWidget extends Widget
{

    const INPUT_TEXT = 1;

    public $model;

    /**
     * @var ActiveRecord
     * Данные в виде массива ActiveRecord
     */
    public $data = null;

    /**
     * @var Array
     * html опции: ['class'=>'class-name', 'id' => 'id', 'style' => 'width:200px'] и т.д.
     */
    public $options = [];

    /**
     * @var Array
     * Поля вывода
     */
    public $columns = null;

    /**
     * @var Array
     * Кнопки такие как удалить, редактировать, просмотреть и т.д. выводятся по очереди так как установленно в массиве
     */
    public $buttons = null;

    /**
     * @var Array
     *
     * значение по умолчанию ['parent_id' => null]
     * parent_id - название поля
     * null - значение поля
     */
    public $parentAttr = ['parent_id' => null];

    /**
     * @var string
     * В каком виде выводить информацию по умолчанию выводится в таблице
     */
    public $html = "table";


//    private $_tempArr = null;
    private $_parent_field_name = "";


    public function run()
    {
        if (empty($this->data))
            return null;//throw new InvalidCallException("Свойство \"" . get_called_class() . '::$data" не должно быть пустым');

        if (empty($this->parentAttr))
            throw new InvalidCallException("Свойство \"" . get_called_class() . '::$parentAttr" не должно быть пустым');

        if (empty($this->columns))
            throw new InvalidCallException("Свойство \"" . get_called_class() . '::$columns" не должно быть пустым');

        $this->renderJS();
        $this->renderCSS();

        $this->_parent_field_name = key($this->parentAttr);
        $tempArr = null;
        $tempArr = $this->prepareSourceArray($this->data, $this->parentAttr[$this->_parent_field_name]);

        /**
         * Вызываем функцию вывода информации
         */
        $renderMethod = "render" . ucfirst(trim($this->html));
        return $this->$renderMethod($tempArr);
    }

    private function renderJS()
    {
        \Yii::$app->view->registerJs("
            $('.position_input_update').on('change', function () {
                var _self = $(this);
                var _url = $(this).attr('url-update-data');
                var _value = $(this).val();
                $.ajax({
                    type:'post',
                    url:_url,
                    data:'new_pos='+_value,
                    dataType:'json',
                    success: function (_json) {
                        if (_json.error == true) {
                            _self.css('background-color', 'red');
                        }
                        if (_json.error == false) {
                            _self.css('background-color', '#BCE774');
                        }
                    }
                });
            });
        ", View::POS_END, 'tree-view-widget');
    }

    public function renderCSS()
    {
        \Yii::$app->view->registerCss('
            .table .action-td {
                width:10%;
                text-align:center;
            }
            .table > thead > tr > th, .table > thead > tr > td, .table > tbody > tr > th, .table > tbody > tr > td, .table > tfoot > tr > th, .table > tfoot > tr > td {
            }
            .table tr th {

                font-size:14px;
            }
            .table tr

        ', [], 'tree-view-widget-css');
    }

    private function prepareSourceArray($_data, $_parent_id = null)
    {
        $returnArray = [];
        $parent_filed_name = $this->_parent_field_name;
        foreach ($_data as $index => $ar) {

            if ($ar->$parent_filed_name == $_parent_id) {
                $tempObj = $ar;
                unset($_data[$index]);
                $returnArray[] = array('ar_obj' => $tempObj, 'children' => $this->prepareSourceArray($_data, $tempObj->id));
            }
        }
        return $returnArray;
    }

    private function renderTable($_data)
    {
        $html = $this->renderTableHead();
        $html .= $this->renderTableBody($_data);
        $html .= $this->renderTableFoot();
        return $html;
    }

    private function renderTableHead()
    {

        $html = Html::beginTag('table', $this->options);

        $html .= Html::beginTag('tr');
        foreach ($this->columns as $index => $column) {
            if (is_array($column)) {
                $html .= Html::tag('th', $this->model->getAttributeLabel($index));
            } else {
                $html .= Html::tag('th', $this->model->getAttributeLabel($column));
            }
        }
        if (!empty($this->buttons)) {
            $html .= Html::beginTag('th');
            $html .= Html::endTag('th');
        }
        $html .= Html::endTag('tr');
        return $html;
    }

    private function renderTableBody($_data)
    {
        $html = "";
        //echo count($_data);
        foreach ($_data as $obj) {
            $html .= Html::beginTag('tr');

            foreach ($this->columns as $index => $col) {
                $styleArr = [];
                if (is_array($col)) {
                    if ($col['field'] == self::INPUT_TEXT) {
                        if ($col['ajaxUpdateUrl'] != "") {
                            $col['options']['url-update-data'] = $col['ajaxUpdateUrl'] . "?id=" . $obj['ar_obj']->id;
                        }
                        $html .= Html::beginTag('td', ['style' => 'width:60px; text-align:center;']);
                        $html .= Html::input('text', $index, $obj['ar_obj']->$index, $col['options']);
                        $html .= Html::endTag('td');
                    }
                } else {
                    $attr = (is_array($col) ? $index : $col);
                    $space = "";
                    if ($attr == 'name' || $attr == 'title') {
                        //$styleArr = ['style' => 'padding-left:'.( ($obj['ar_obj']->level+1) * 10).'px;'];
                        for ($i = 0; $i < $obj['ar_obj']->level; $i++) {
                            $space .= " - - - ";
                        }
                    }

                    $html .= Html::beginTag('td', $styleArr);
                    $html .= $space . $obj['ar_obj']->$attr;
                    $html .= Html::endTag('td');
                }

            }
//            $html .=  Html::beginTag('td', array('class' => 'update_position_row'));

//            $html .=  Html::endTag('td');
            $html .= $this->recordActionsBody($obj['ar_obj']);
            $html .= Html::endTag('tr');
            if (!empty($obj['children'])) {
                $html .= $this->renderTableBody($obj['children']);
            }

        }
        return $html;
    }

    private function recordActionsBody($obj)
    {
        $html = Html::beginTag('td', ['class' => 'action-td']);
        foreach ($this->buttons as $index => $button) {
            $text = (isset($button['img']) ? $button['img'] : $button['title']);
            $url = ($button['url'] == '#' ? $button['url'] : Url::to([$button['url'], "id" => $obj->id]));
            $html .= Html::a($text, $url, $button['options']) . "&nbsp;";
        }
        $html .= Html::endTag('td');
        return $html;
    }

    private function renderTableFoot()
    {
        return Html::endTag('table');
    }
}