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

    public static function  renderBackCall() {
        return '
<div style="color: white">
    <form name="recall_form">
    <div style="margin-top: 10px">
        <div class="recall_input">
            <input id="recall_name" style="width: 90%" placeholder="Имя" name="name" type="text">
        </div>
        <div class="recall_input">
             <input id="recall_phone" style="width: 90%" placeholder="Телефон" name="phone" type="text">
        </div>
    </div>
    <div class="form-radio">
         <div class="recall_input">Когда вам перезвонить?</div>
         <div class="bt-radio"><input class="radio" type="radio" name="form_radio_item" value="1" data-text="Первая половина дня <span>9:00-15:00</span>" style="display: none;"><a href="javascript:void(0)" class="bt-radio-trigger" data-radioname="form_radio_item">Первая половина дня <span>9:00-15:00</span></a></div>
         <div class="form-radio-sep"></div>
         <div class="bt-radio"><input class="radio" type="radio" name="form_radio_item" value="2" data-text="Вторая половина дня <span>15:00-21:00</span>" style="display: none;"><a href="javascript:void(0)" class="bt-radio-trigger" data-radioname="form_radio_item">Вторая половина дня <span>15:00-21:00</span></a></div>
         <div class="form-radio-sep"></div>
         <div class="bt-radio"><input class="radio" type="radio" name="form_radio_item" value="3" data-text="В ночное время <span>21:00-2:00</span>" style="display: none;"><a href="javascript:void(0)" class="bt-radio-trigger" data-radioname="form_radio_item">В ночное время <span>21:00-2:00</span></a></div>
         <div class="clear"></div>
     </div>
     <div>
         <textarea id="recall_msg" name="recall_msg" style="width: 90%; margin-top: 10px; font-size: 16px; height: 80px;" placeholder="Текст сообщения"></textarea>
     </div>
   
    <input style="margin-top: 10px" id="recall_btn" type="button" value="Отправить" onclick="recall();">
</form>
</div>';
        /*return
        '<div class="form-main">
                                <form name="SIMPLE_FORM_1" action="/" method="POST" enctype="multipart/form-data" _lpchecked="1"><input type="hidden" name="sessid" id="sessid_1" value="cdddbbc258145864c6f506d7c06cfb8c"><input type="hidden" name="WEB_FORM_ID" value="1">                        <div class="form-input-name">
                <input type="text" name="form_text_1" value="Ваше имя" data-placeholder="Ваше имя" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
            </div>
            <div class="form-section-email">
                <div class="form-input-email">
                    <input type="text" name="form_email_2" value="E-mail" data-placeholder="E-mail">
                </div>
                <div class="form-input-phone">
                    <input type="text" name="form_text_3" value="Телефон" data-placeholder="Телефон">
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-radio">
                <div class="form-radio-text">В какое время Вам удобнее позвонить?</div>
                <div class="bt-radio"><input class="radio" type="radio" name="form_radio_SIMPLE_QUESTION_773" value="4" data-text="Первая половина дня <span>9:00-15:00</span>" style="display: none;"><a href="javascript:void(0)" class="bt-radio-trigger" data-radioname="form_radio_SIMPLE_QUESTION_773">Первая половина дня <span>9:00-15:00</span></a></div>
                <div class="form-radio-sep"></div>
                <div class="bt-radio"><input class="radio" type="radio" name="form_radio_SIMPLE_QUESTION_773" value="5" data-text="Вторая половина дня <span>15:00-21:00</span>" style="display: none;"><a href="javascript:void(0)" class="bt-radio-trigger" data-radioname="form_radio_SIMPLE_QUESTION_773">Вторая половина дня <span>15:00-21:00</span></a></div>
                <div class="form-radio-sep"></div>
                <div class="bt-radio"><input class="radio" type="radio" name="form_radio_SIMPLE_QUESTION_773" value="6" data-text="В ночное время <span>21:00-2:00</span>" style="display: none;"><a href="javascript:void(0)" class="bt-radio-trigger" data-radioname="form_radio_SIMPLE_QUESTION_773">В ночное время <span>21:00-2:00</span></a></div>
                <div class="clear"></div>
            </div>
            <div class="form-textarea-message">
                <textarea name="form_textarea_7" data-placeholder="Введите сообщение...">Введите сообщение...</textarea>
            </div>
            <div class="form-section-submit">
                <input class="form-submit" type="submit" name="web_form_submit" value="Отправить заявку" onclick="yaCounter30071049.reachGoal(\'call\'); return true;">
            </div>
            </form>		    </div>';*/
    }
}