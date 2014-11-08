<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 28.06.14
 * Time: 18:48
 */

namespace common\helpers\html;

use yii\base\Widget;
use yii\helpers\BaseHtml;
use yii\helpers\Html;

class mySelect extends Widget {

    public $data;
    public $model;
    public $attribute;

    private $html;

    public function init () {
//        var_dump($this->model->getAttributeLabel($this->attribute));
        $this->html = Html::beginTag('div', ['class' => 'form-group field-'.BaseHtml::getInputId($this->model, $this->attribute)])."\n";
        $this->html .= Html::label($this->model->getAttributeLabel($this->attribute), BaseHtml::getInputId($this->model, $this->attribute), ['class' => 'control-label'])."\n";
        $this->html .= Html::beginTag('select', [
            'name' => BaseHtml::getInputName($this->model, $this->attribute),
            'id' => BaseHtml::getInputId($this->model, $this->attribute),
            'class' => 'form-control']
        )."\n";
        $this->html .= Html::tag('option', '---', ['value' => ""])."\n";
        $this->html .= $this->renderOptions($this->data, null, "");
        $this->html .= Html::endTag('select')."\n";
        $this->html .= Html::tag('div', '', ['class' => 'help-block'])."\n";
        $this->html .= Html::endTag('div')."\n";
        echo $this->html;
    }

    private function renderOptions ($data, $parent_id = NULL, $str) {
        foreach ($data as $index => $obj) {
            if ($obj->parent_id == $parent_id && $parent_id == null) {
                $str = $this->node($obj) . $this->renderOptions($data, $obj->id, $str);
            }
            if ($obj->parent_id == $parent_id && $parent_id != null) {
                $str = $this->node($obj) . $this->renderOptions($data, $obj->id, $str);
            }
        }
        return $str;
    }

    private function node($obj)
    {
        $space = "";
        for ($i = 0; $i < $obj->level; $i++) {
            $space .= "--";
        }
        $str = Html::tag('option', $space.$obj->name, ['value' => $obj->id, 'selected' => ($obj->id == $this->model->parent_id ? true : false)])."\n";
        return $str;
    }
}