<?php
/**
 * NotoColorEmoji
 *
 * Подключение Noto Color Emoji в админке
 *
 * @category     plugin
 * @version      1.0.0
 * @package      evo
 * @internal     @events OnDocFormRender,OnManagerTopPrerender,OnManagerMainFrameHeaderHTMLBlock
 * @internal     @properties 
 * @internal     @modx_category Utilites
 * @internal     @installset base
 * @internal     @disabled 0
 * @homepage     https://github.com/ProjectSoft-STUDIONIONS/NotoColorEmoji#readme
 * @license      https://github.com/ProjectSoft-STUDIONIONS/NotoColorEmoji/blob/main/LICENSE GNU General Public License v3.0 (GPL-3.0)
 * @reportissues https://github.com/ProjectSoft-STUDIONIONS/NotoColorEmoji/issues
 * @author       Чернышёв Андрей aka ProjectSoft <projectsoft2009@yandex.ru>
 * @lastupdate   2026-01-16
 */

if (!defined('MODX_BASE_PATH')):
	http_response_code(403);
	die('For');
endif;

$e = &$modx->event;
$params = $e->params;

$output = "";

switch ($e->name) {
	case 'OnDocFormRender':
		$output = <<<EOD
<script>
!(function(){
	let link = 'https://projectsoft-studionions.github.io/noto-color-emoji/',
		content_body = document.getElementById('content_body'),
		a, p;
	if(content_body){
		a = document.createElement("a");
		a.href = link;
		a.target = "_blank";
		a.innerHTML = "здесь";
		p = document.createElement("p");
		p.style.cssText = "margin-top: 10px; margin-bottom: 10px; font-weight: 700; font-style: italic;";
		p.innerHTML = "Скопировать Emoji для использования в контенте можно ";
		p.append(a);
		content_body.insertAdjacentElement("afterend", p);
	}
}());
</script>
EOD;
		$modx->event->output($output);
		break;
	case 'OnManagerTopPrerender':
	case 'OnManagerMainFrameHeaderHTMLBlock':
		$css_path = 'assets/plugins/utilites/notocoloremoji/noto-color-emoji.min.css';
		$mtime = is_file(MODX_BASE_PATH . $css_path) ? filemtime(MODX_BASE_PATH . $css_path) : '1768553104';
		$output = <<<EOD
<link rel="stylesheet" type="text/css" href="/{$css_path}?v={$mtime}">
EOD;
		$modx->event->output($output);
		break;
	default:
		// code...
		break;
}
