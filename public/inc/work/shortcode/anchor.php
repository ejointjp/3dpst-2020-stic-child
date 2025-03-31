<?php
require_once get_theme_file_path('inc/class-url-manager.php');

// アンカータグを作成するショートコード
add_shortcode('a', 'stic_anchor_shortcode');

function stic_anchor_shortcode($atts)
{
	extract(
		shortcode_atts(
			array(
				'id'            => null,
				'icon'          => 0,
				'icon_position' => 'after',
				'text'          => null,
				'class'         => null,
				'p'             => null,
				'autotitle'     => 1,
				'suffix'        => '',
				'link'          => 0,
				'target'        => '',
				'args'          => '',
				'hash'          => '',
				'add_referer'   => false,
				'send_referer'  => false,
			),
			$atts
		)
	);

	// $url = get_page_link($id);
	// $getpage = get_page($id);

	if (is_null($id) || !is_numeric($id)) {
		if (current_user_can('edit_posts')) {
			return '<span style="color: #f33;">リンクIDが無効です</span>';
		} else {
			return '<span style="color: #aaa;">リンク先が見つかりませんでした</span>';
		}
	}

	$title = get_the_title($id);
	$url   = get_permalink($id) . $suffix;
	if ($hash) {
		$url = $url . '#' . $hash;
	}

	$get_param   = $args ? '?' . $args : '';
	$url_manager = new Stic_Url_Manager();

	// $ref = $url_manager->excerpt_query( $ref );

	if ($send_referer && $_GET['referer']) {
		$url = add_query_arg('referer', urlencode($_GET['referer']), $url);
	} else {
		$url = $get_param ? $url . $get_param : $url;
	}
	// リンク文字の決定

	if ($autotitle || !$text) {
		$text = $title;
	}

	if ($class) {
		$class = ' class="' . $class . '"';
	}

	$icon_before = '';
	$icon_after  = '';

	if ($link) {
		return sprintf('<p class="link"><a href="%s">%s</a>', $url, $text);
	}

	if ($icon) {

		if ($icon == '1') {
			$icon = '<i class="fas fa-chevron-right"></i>';
		} else {
			$icon = sprintf('<i class="%s"></i>', $icon);
		}

		if ($icon_position === 'before') {
			$icon_before = $icon . ' ';
		} else {
			$icon_after = ' ' . $icon;
		}
	}

	if ($p) {
		if ($p == '1') {
			$p_prefix = '<p>';
		} else {
			$p_prefix = sprintf('<p class="%s">', $p);
		}

		$p_suffix = '</p>';
	} else {
		$p_prefix = '';
		$p_suffix = '';
	}

	if ($target) {
		$target = sprintf(' target="%s"', $target);
	}
	return sprintf('%s<a href="%s"%s%s>%s%s%s</a>%s', $p_prefix, $url, $class, $target, $icon_before, $text, $icon_after, $p_suffix);
}
