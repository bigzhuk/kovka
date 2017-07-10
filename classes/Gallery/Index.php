<?php
namespace Gallery;

class Index {

    public static function get_photo_folders() {
        return array(
            'naves' => 'Навесы',
            'balkon' => 'Балконы',
            'besedka' => 'Беседки',
            'lestnica' => 'Лестницы',
            'mangal' => 'Мангалы',
            'mebel' => 'Мебель и интерьер',
            'mostik' => 'Мостики',
            'ogradka' => 'Оргадки',
            'reshetka' => 'Решётки',
            'urna' => 'Урны',
            'vorota' => 'Ворота',
            'zabor' => 'Заборы'
        );
    }

    public static function drawProductPhotoTable($photos) {
        return
            '<table class="mini_gallery" cellspacing="10" style="float: left">
					<tbody>
						<tr class="parent-container">'
            .self::drawProductPhotoTr($photos).'
						</tr>
					</tbody>
			</table><div style="clear: left"></div>';
    }

    private static function drawProductPhotoTr($photos) {
        $out = '';

        foreach ($photos as $photo) {
            $thumb = \Catalog\Decorator\Catalog::getThumbPathFromPhotoPath($photo);
            $out.= '<td style="height: 1px; background-image: url(\''.$thumb.'\')" href="'.$photo.'"></td>';
        }
        return $out;
    }


    public static function draw_photo_table($folder, $title = '', $count = 10) {
        $title = $title ? '<h2>'.$title.'</h2>' : '';
        $out =
            $title.'
			<table class="mini_gallery" cellspacing="10">
					<tbody>
						<tr class="parent-container">'
            .self::draw_photo_tr($folder, $count).'
						</tr>
					</tbody>
			</table>';
        return $out;
    }

    public static function draw_photo_tr($folder, $count) {
        $out = '';
        for ($i=1; $i <= $count; $i++) {
            $i = $i < 10 ? '0'.$i : $i;
            if(is_file('images/photo/'.$folder.'/'.$i.'.jpg')) {
                $out.= '<td style="background-image: url(\'images/photo/'.$folder.'/'.$i.'.jpg\')"
			href="images/photo_big/'.$folder.'/'.$i.'.jpg"></td>';
            }
        }
        return $out;
    }
}