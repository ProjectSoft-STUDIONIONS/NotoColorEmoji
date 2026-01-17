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
 * @lastupdate   2026-01-17
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
	!function(){let a,p,cb=document.getElementById("content_body");cb&&(a=document.createElement("a"),a.href="https://projectsoft-studionions.github.io/noto-color-emoji/",a.target="_blank",a.innerHTML="\u0437\u0434\u0435\u0441\u044c",p=document.createElement("p"),p.style.cssText="margin-top: 10px; margin-bottom: 10px; font-weight: 700; font-style: italic;",p.innerHTML="\u{1F1F7}\u{1F1FA} \u0421\u043a\u043e\u043f\u0438\u0440\u043e\u0432\u0430\u0442\u044c Emoji \u0434\u043b\u044f \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u043d\u0438\u044f \u0432 \u043a\u043e\u043d\u0442\u0435\u043d\u0442\u0435 \u043c\u043e\u0436\u043d\u043e ",p.append(a),cb.insertAdjacentElement("afterend",p))}();
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
