<?php 

	// $_SERVER['REQUEST_URI'] = str_replace('/kovka', '', $_SERVER['REQUEST_URI']);


	$redirect = '';
	if (isset($_SERVER['REQUEST_URI'])){
		$redirect_ = explode('/', $_SERVER['REQUEST_URI']);
		foreach ($redirect_ as $key => $value) {
			if ($value !== ''){
				$redirect .= '/'.$value;
			}
		}
	}

	$redirect = strstr($redirect, '?', true) ?
		strstr($redirect, '?', true) : $redirect;


	if ($redirect != '' && $redirect != '/') {
		if (file_exists('pages'.$redirect.'.php')) {
			include 'pages'.$redirect.'.php';
		} else if (file_exists('pages'.$redirect.'/index.php')) {
			include 'pages'.$redirect.'/index.php';
		} else {
			include 'pages/error404.php';
		}
	} else {
		include 'pages/home.php';
	}
?>

<div class="container" style="text-align: center">
    <script type="text/javascript">(function() {
            if (window.pluso)if (typeof window.pluso.start == "function") return;
            if (window.ifpluso==undefined) { window.ifpluso = 1;
                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                var h=d[g]('body')[0];
                h.appendChild(s);
            }})();</script>
    <div class="pluso" data-background="transparent" data-options="big,square,line,horizontal,nocounter,theme=01" data-services="vkontakte,odnoklassniki,facebook,twitter,google,print"></div>
</div>
