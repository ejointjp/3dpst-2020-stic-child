<?php
require get_theme_file_path('inc/work/functions.php');
require get_theme_file_path('inc/work/shortcode/anchor.php');
require get_theme_file_path('inc/work/shortcode/contact.php');

// 材料ライブラリ
require get_theme_file_path('inc/material-library/material-library.php');

// 画像サイズ追加
add_image_size('square', 750, 750, true);

// ウィジェットでショートコードを実行できるようにする
add_filter('widget_text', 'do_shortcode');

// 管理バー設定
add_action(
  'admin_bar_menu',
  function ($wp_admin_bar) {
    // WordPressアイコン
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('comments');
  },
  99
);



// サイドバー追加
add_action(
  'widgets_init',
  function () {
    register_sidebar(
      array(
        'id'            => 'sidebar-page',
        'name'          => '固定ページ',
        'description'   => '固定ページに表示されます',
        'before_widget' => '<div id="%1$s" class="c-widget__item _%1$s_ %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="c-widget__title"><span>',
        'after_title'   => '</span></h2>',
      )
    );
  }
);

add_action(
  'widgets_init',
  function () {
    register_sidebar(
      array(
        'id'            => 'sidebar-hardware',
        'name'          => 'ハードウェア',
        'description'   => 'ハードウェアのページに表示されます',
        'before_widget' => '<div id="%1$s" class="c-widget__item _%1$s_ %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="c-widget__title"><span>',
        'after_title'   => '</span></h2>',
      )
    );
  }
);

add_action(
  'widgets_init',
  function () {
    register_sidebar(
      array(
        'id'            => 'sidebar-sample',
        'name'          => '造形サンプル',
        'description'   => '造形サンプルのページに表示されます',
        'before_widget' => '<div id="%1$s" class="c-widget__item _%1$s_ %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="c-widget__title"><span>',
        'after_title'   => '</span></h2>',
      )
    );
  }
);

add_action('template_redirect', 'custom_after_the_content');
function custom_after_the_content() {
  // 造形サンプル一覧ページ
  if (is_page('samples')) {
    add_filter('after_the_content', 'get_the_content_samples', 9, 1);
  } elseif (is_page('materials')) {
    add_filter('after_the_content', 'get_the_content_material_library', 9, 1);
  } elseif (is_page('preview')) {
    add_filter('after_the_content', 'get_the_content_preview', 9, 1);
  } elseif (is_page('downloads')) {
    add_filter('after_the_content', 'get_the_content_download', 9, 1);
  } elseif (is_page('hardwares')) {
    add_filter('after_the_content', 'get_the_content_hardwares', 9, 1);
  }

  if (is_single()) {
    add_filter('after_the_content', 'get_the_related_sample_items', 9, 1);
  }
}

function get_the_content_hardwares($content) {
  ob_start();
  get_template_part('project/content-body-hardwares');
  $content .= ob_get_clean();

  return $content;
}

function get_the_content_samples($content) {
  ob_start();
  get_template_part('project/content-body-samples');
  $content .= ob_get_clean();

  return $content;
}

function get_the_content_material_library($content) {
  ob_start();
  get_template_part('project/content-body-material-library');
  $content .= ob_get_clean();

  return $content;
}

function get_the_content_material_library_2022($content) {
  ob_start();
  get_template_part('project/content-body-material-library-2022');
  $content .= ob_get_clean();

  return $content;
}

function get_the_content_preview($content) {
  ob_start();
  get_template_part('project/content-body-preview');
  $content .= ob_get_clean();

  return $content;
}


function get_the_content_download($content) {
  ob_start();
  get_template_part('project/content-body-download');
  $content .= ob_get_clean();

  return $content;
}

function get_the_related_sample_items($content) {
  ob_start();
  get_template_part('part/sample-related-samples');
  $content .= ob_get_clean();

  return $content;
}


add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');
function custom_enqueue_scripts() {
  wp_enqueue_script(
    '3dpst',
    get_theme_file_uri('assets/script.js'),
    array('jquery'),
    filemtime(get_theme_file_path('assets/script.js')),
    true
  );

  if (is_page('materials')) {
    wp_enqueue_script(
      'material-library',
      get_theme_file_uri('assets/material-library.js'),
      array('jquery'),
      filemtime(get_theme_file_path('assets/material-library.js')),
      'all'
    );
  }

  if (get_post_type() === 'material') {
    wp_enqueue_script(
      'material-single',
      get_theme_file_uri('assets/material-single.js'),
      array('jquery'),
      filemtime(get_theme_file_path('assets/material-single.js')),
      'all'
    );
  }

  wp_enqueue_style(
    'google-fonts-open-sans',
    'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap',
    [],
    '',
    'all'
  );

  wp_enqueue_style(
    'google-fonts-roboto',
    'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap',
    [],
    '',
    'all'
  );

  wp_enqueue_style(
    '3dpst',
    get_theme_file_uri('assets/style.css'),
    array('stic'),
    '',
    'all'
  );

  wp_enqueue_style(
    '3dpst-add',
    get_theme_file_uri('dist/style-add.css'),
    array('3dpst'),
    '2022-09-21 15:53:29',
    'all'
  );
}

add_action('init', 'stic_custom_post_types');
function stic_custom_post_types() {

  $slug   = 'hardware';
  $name   = 'ハードウェア';
  $labels = stic_custom_post_type_label($name);
  $args   = array(
    'labels'              => $labels,
    'description'         => '',
    'public'              => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'show_in_rest'        => true,
    'menu_position'       => 20,
    'menu_icon'           => null,
    'hierarchical'        => true,
    'taxonomies'          => array(),
    'has_archive'         => false,
    'supports'            => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'excerpt',
      'trackbacks',
      // 'custom-fields',
      // 'comments',
      'revisions',
      // 'post-formats'
      'page-attributes'
    ),
  );
  register_post_type($slug, $args);

  $slug   = 'sample';
  $name   = '造形サンプル';
  $labels = stic_custom_post_type_label($name);
  $args   = array(
    'labels'              => $labels,
    'description'         => '造形サンプルを追加します。',
    'public'              => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'show_in_rest'        => true,
    'menu_position'       => 20,
    'menu_icon'           => null,
    'hierarchical'        => false,
    'taxonomies'          => array(),
    'has_archive'         => false,
    'supports'            => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      // 'excerpt',
      'trackbacks',
      // 'custom-fields',
      // 'comments',
      'revisions',
      // 'post-formats'
    ),
  );
  register_post_type($slug, $args);

  $slug   = 'q-and-a';
  $name   = 'よくあるご質問';
  $labels = stic_custom_post_type_label($name);
  $args   = array(
    'labels'              => $labels,
    'description'         => 'よくあるご質問を追加します。',
    'public'              => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'show_in_rest'        => true,
    'menu_position'       => 20,
    'menu_icon'           => null,
    'hierarchical'        => false,
    'taxonomies'          => array(),
    'has_archive'         => false,
    'supports'            => array(
      'title',
      'editor',
      'author',
      // 'thumbnail',
      // 'excerpt',
      // 'trackbacks',
      // 'custom-fields',
      // 'comments',
      // 'revisions',
      // 'post-formats'
    ),
  );
  register_post_type($slug, $args);

  $slug   = 'download';
  $name   = 'ダウンロード';
  $labels = stic_custom_post_type_label($name);
  $args   = array(
    'labels'              => $labels,
    'description'         => 'ダウンロードファイルを追加します。',
    'public'              => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => false,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'show_in_rest'        => true,
    'menu_position'       => 20,
    'menu_icon'           => null,
    'hierarchical'        => true,
    'taxonomies'          => array(),
    'has_archive'         => false,
    'supports'            => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      // 'excerpt',
      // 'trackbacks',
      // 'custom-fields',
      // 'comments',
      // 'revisions',
      // 'post-formats'
    ),
  );
  register_post_type($slug, $args);
}

add_action('init', 'stic_custom_taxonomies', 0);
function stic_custom_taxonomies() {

  $slug        = 'hardware-series';
  $object_type = array('hardware'); // 対応させる投稿タイプ
  $name        = 'シリーズ';
  $args        = array(
    'labels'                => stic_custom_taxonomy_label($name),
    'public'                => true,
    'show_ui'               => true,
    'show_in_navs_menus'    => false,
    'show_tagcloud'         => false,
    'show_in_quick_edit'    => true,
    'show_in_rest'          => true,
    'meta_box_cb'           => null,
    'show_admin_column'     => true,
    'description'           => '',
    'hierarchical'          => true,
    'update_count_callback' => '',
    'rewrite'               => true,
    'sort'                  => true,
  );
  register_taxonomy($slug, $object_type, $args);

  $slug        = 'hardware-type';
  $object_type = array('hardware'); // 対応させる投稿タイプ
  $name        = '造形方式';
  $args        = array(
    'labels'                => stic_custom_taxonomy_label($name),
    'public'                => true,
    'show_ui'               => true,
    'show_in_navs_menus'    => false,
    'show_tagcloud'         => false,
    'show_in_quick_edit'    => true,
    'show_in_rest'          => true,
    'meta_box_cb'           => null,
    'show_admin_column'     => true,
    'description'           => '',
    'hierarchical'          => true,
    'update_count_callback' => '',
    'rewrite'               => true,
    'sort'                  => true,
  );
  register_taxonomy($slug, $object_type, $args);

  $slug        = 'hardware-genre';
  $object_type = array('hardware'); // 対応させる投稿タイプ
  $name        = 'ジャンル';
  $args        = array(
    'labels'                => stic_custom_taxonomy_label($name),
    'public'                => true,
    'show_ui'               => true,
    'show_in_navs_menus'    => false,
    'show_tagcloud'         => false,
    'show_in_quick_edit'    => true,
    'show_in_rest'          => true,
    'meta_box_cb'           => null,
    'show_admin_column'     => true,
    'description'           => '',
    'hierarchical'          => true,
    'update_count_callback' => '',
    'rewrite'               => true,
    'sort'                  => true,
  );
  register_taxonomy($slug, $object_type, $args);

  $slug        = 'sample-material';
  $object_type = array('sample'); // 対応させる投稿タイプ
  $name        = '造形サンプルの材料';
  $args        = array(
    'labels'                => stic_custom_taxonomy_label($name),
    'public'                => true,
    'show_ui'               => true,
    'show_in_navs_menus'    => false,
    'show_tagcloud'         => false,
    'show_in_quick_edit'    => true,
    'show_in_rest'          => true,
    'meta_box_cb'           => null,
    'show_admin_column'     => true,
    'description'           => '造形サンプルの材料カテゴリを選択します。',
    'hierarchical'          => true,
    'update_count_callback' => '',
    'rewrite'               => true,
    'sort'                  => true,
  );
  register_taxonomy($slug, $object_type, $args);

  $slug        = 'sample-printer';
  $object_type = array('sample'); // 対応させる投稿タイプ
  $name        = '造形サンプルのプリンタ';
  $args        = array(
    'labels'                => stic_custom_taxonomy_label($name),
    'public'                => true,
    'show_ui'               => true,
    'show_in_navs_menus'    => false,
    'show_tagcloud'         => false,
    'show_in_quick_edit'    => true,
    'show_in_rest'          => true,
    'meta_box_cb'           => null,
    'show_admin_column'     => true,
    'description'           => '造形サンプルにしたプリンタを選択します。',
    'hierarchical'          => true,
    'update_count_callback' => '',
    'query_var'             => $slug,
    'rewrite'               => true,
    'sort'                  => true,
  );
  register_taxonomy($slug, $object_type, $args);

  $slug        = 'sample-tag';
  $object_type = array('sample'); // 対応させる投稿タイプ
  $name        = '造形サンプルのタグ';
  $args        = array(
    'labels'                => stic_custom_taxonomy_label($name),
    'public'                => true,
    'show_ui'               => true,
    'show_in_navs_menus'    => false,
    'show_tagcloud'         => false,
    'show_in_quick_edit'    => true,
    'show_in_rest'          => true,
    'meta_box_cb'           => null,
    'show_admin_column'     => true,
    'description'           => '造形サンプルに任意のタグを追加します。',
    'hierarchical'          => true,
    'update_count_callback' => '',
    'query_var'             => $slug,
    'rewrite'               => true,
    'sort'                  => true,
  );
  register_taxonomy($slug, $object_type, $args);
}

add_action('pre_get_posts', 'custom_pre_get_posts');
function custom_pre_get_posts($query) {
  // 管理画面とメインクエリに干渉しないようにする
  if (is_admin() || !$query->is_main_query()) {
    return;
  }

  if ($query->is_archive('sample') || $query->is_archive('hardware')) {
    $query->set('posts_per_page', '-1');
    $query->set('numberposts', '-1');
  }
}

// タクソノミー名からget_postsの tax_queryの値となる配列を返す
function stic_get_tax_query_array($tax_slug) {
  $terms = get_the_terms(get_the_ID(), $tax_slug);

  if ($terms && !is_wp_error($terms)) {
    $term_slugs = array();
    foreach ($terms as $term) {
      $term_slugs[] = $term->slug;
    }

    return array(
      'taxonomy' => $tax_slug,
      'field'    => 'slug',
      'terms'    => $term_slugs,
    );
  }
}


// プレビューユーザー用
add_action('init', 'preview_user_action');
function preview_user_action() {
  // preview01さん
  if (
    wp_get_current_user()->user_login === 'preview01'
    || wp_get_current_user()->user_login === 'preview02'
    || wp_get_current_user()->user_login === 'preview03'
    || wp_get_current_user()->user_login === 'preview04'
  ) {
    add_action('admin_bar_menu', 'user_preview_admin_bar_menu', 9999);
    add_action('auth_redirect', 'preview_redirect');
  }
}

add_action('admin_bar_menu', 'custom_admin_bar_menu', 9999);
function custom_admin_bar_menu($wp_admin_bar) {
  $args = array(
    'id'    => 'preview-list',
    'title' => 'レビュー待ち記事一覧',
    'href'  => get_home_url() . '/preview',
  );

  $wp_admin_bar->add_node($args);
}

// プレビューユーザーの管理バーを設定
function user_preview_admin_bar_menu($wp_admin_bar) {
  $wp_admin_bar->remove_node('wp-logo');
  $wp_admin_bar->remove_node('site-name');
  $wp_admin_bar->remove_node('new-content');
  $wp_admin_bar->remove_node('edit');
  $wp_admin_bar->remove_node('search');
}

function preview_redirect() {
  wp_redirect(get_home_url() . '/preview');
  exit();
}

// 造形サンプルの情報テーブルを取得する
add_shortcode('sample', 'sample_data_shortcode');
function sample_data_shortcode($atts) {
  extract(
    shortcode_atts(
      array(
        'id'      => null,
        'img'     => true,
        'printer' => true,
        'size'    => true,
        'price'   => true,
        'date'    => true,
      ),
      $atts
    )
  );

  if ($id) {
    $width         = get_field('sample-size-width', $id);
    $depth         = get_field('sample-size-depth', $id);
    $height        = get_field('sample-size-height', $id);
    $data_price    = get_field('sample-price', $id);
    $data_date     = get_field('sample-date', $id);
    $printers      = get_the_terms($id, 'sample-printer');
    $format_price  = $data_price ? number_format($data_price) : '';
    $printer_array = array();

    foreach ($printers as $printer) {
      $item[] = $printer->name;
    }

    $items = array(
      array(
        'item'  => $printer,
        'name'  => 'printer',
        'title' => '使用プリンタ',
        'data'  => implode(' / ', $item),
      ),
      array(
        'item'  => $size,
        'name'  => 'size',
        'title' => 'サイズ(mm)',
        'data'  => sprintf('W%s x D%s x H%s', $width, $depth, $height),
      ),
      array(
        'item'  => $price,
        'name'  => 'price',
        'title' => '参考価格',
        'data'  => $format_price . '円',
      ),
      array(
        'item'  => $date,
        'name'  => 'date',
        'title' => '参考納期',
        'data'  => $data_date . '日',
      ),
    );

    $html  = '<div class="sample-data">';
    $html .= '<div class="sample-data__img">';
    $html .= sprintf('<a href="%s">%s</a>', get_permalink($id), get_the_post_thumbnail($id, 'square'));
    $html .= '</div>';
    $html .= '<div class="sample-data__content">';

    foreach ($items as $item) {
      if ($item['item']) {
        $html .= '<div class="sample-data__item">';
        $html .= sprintf('<div class="sample-data__title">%s</div>', $item['title']);
        $html .= sprintf('<div class="sample-data__data">%s</div>', $item['data']);
        $html .= '</div>';
      }
    }

    $html .= '</div>';
    $html .= '</div>';

    return $html;
  }
}


// MW WP Form関連 ///////////////////////////////

// MW WP Form アップロードディレクトリを指定
/**
 * @param empty                 $path
 * @param MW_WP_Form_Data       $Data
 * @param string name 属性値
 * @return string 空値以外を返したときだけそのパスが使用される
 */
function mwform_upload_dir($path, $Data, $key) {
  /* 2.8.0 〜 */
  return '/mw-wp-form-media';
}
add_filter('mwform_upload_dir_mw-wp-form-10', 'mwform_upload_dir', 10, 3);

// MW WP Form keyの内容をカスタマイズ
/**
 * @param string $value 送信された値
 * @param string $key メールタグ
 * @param int    $insert_contact_data_id データベースに保存した場合、そのときの Post ID
 */
function mwform_custom_mail_tag($value, $key, $insert_contact_data_id) {
  if ($key === 'file') {
    if ($value) {
      $value = '添付ファイルあり';
    } else {
      $value = '添付ファイルなし';
    }
  }
  return $value;
}
add_filter('mwform_custom_mail_tag', 'mwform_custom_mail_tag', 10, 3);

// MW WP Form お問い合わせ内容を選択したら必須項目を追加
function mwform_validation($Validation, $data, $Data) {
  if ($data['about'] === 'hardware') {
    $Validation->set_rule('hardware', 'noEmpty');
  }
  return $Validation;
}
add_filter('mwform_validation_mw-wp-form-10', 'mwform_validation', 10, 3);


// タイトルから非公開の文字を消す
add_filter(
  'the_title',
  function ($title = '') {
    if (empty($title)) {
      return $title;
    }
    if (is_user_logged_in()) {
      return $title;
    }

    $search[0] = '/^' . str_replace('%s', '(.*)', preg_quote(__('Protected: %s'), '/')) . '$/';
    $search[1] = '/^' . str_replace('%s', '(.*)', preg_quote(__('Private: %s'), '/')) . '$/';
    return preg_replace($search, '$1', $title);
  }
);

function stic_get_the_category($classname = null) {
  $categories  = get_the_category();

  foreach ($categories as $category) {
    echo sprintf('<a class="c-meta__a %s-%s" href="%s" rel="tag"%s>%s</a>', $category->taxonomy, $category->slug, get_category_link($category->term_id), $classname, $category->cat_name);
  }


  // $classname = !is_null($classname) ? sprintf(' class="%s"', $classname) : '';
  // $category  = get_the_category();

  // if ($category[0]) {
  //   return sprintf('<a class="c-meta__a %s-%s" href="%s" rel="tag"%s>%s</a>', $category[0]->taxonomy, $category[0]->slug, get_category_link($category[0]->term_id), $classname, $category[0]->cat_name);
  // }
}


// Public Post Previewのnonceを延長する
// デフォルトは48時間 7日に変更
add_filter('ppp_nonce_life', 'my_nonce_life');
function my_nonce_life() {
  return 7 * DAY_IN_SECONDS;
}
