<?php

namespace app\components;

use yii\base\Component;

class Months extends Component {
    private $months = [
        'Январь',
        'Февраль',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентярь',
        'Октябрь',
        'Ноябрь',
        'Декабрь'
    ];

    public function getLatest($index) { 
        $year = date("Y");
        for($i = 0; $i < 5; $i++) {
            $array[] = [$this->months[$index - 1], $year];
            $index--;
            if($index < 1) {
                $index = 12;
                $year--;
            }
        }
        return $array;
    }

    public function IdByName($name) {
        return array_search($name, $this->months) + 1;
    }
}