<?php

namespace App;

class Index
{
    public static $phones = array(
        '+7(499)899-78-87', '+7(926)300-29-09',
    );
    public static $email = 'sus-stroy@mail.ru';

    public static function getCallHourOptions() {
        $options = [];
        for ($h = 9; $h < 22; $h++) {
            $hour_shift = date('i') >= 45 ? 1 : 0; //  +1 час, когда время 11:45, а показать надо 12:00.
            $selected = $h == date('H') + $hour_shift ? 'selected' : '';
            $options[] = ['value' => $h, 'selected' => $selected];
        }

        return $options;
    }

    public static function getCallMinuteOptions() {
        $options = [];
        for ($m = 0; $m < 60; $m += 15) {
            $selected = self::isSelectedMinutes(date('i'), $m) ? 'selected' : '';
            if ($m === 0) {
                $m = '00';
            }
            $options[] = ['value' => $m, 'selected' => $selected];
        }

        return $options;
    }

    public static function renderCallTimeOptions(array $options) {
        $out = '';
        foreach ($options as $option) {

            $out .= '<option value="' . $option['value'] . '" '.$option['selected'].'>' . $option['value'] . '</option>';

        }

        return $out;
    }

    public static function isSelectedMinutes($now_min, $m) {
        if ($now_min >= 45 && $m == 0) {
            return true;
        }
        if ($now_min < $m && $now_min + 15 >= $m ) {
            return true;
        }
        return false;
    }
}