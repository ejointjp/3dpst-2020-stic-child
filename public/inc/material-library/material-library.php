<?php
add_action('init', 'c3_custom_post_types');
function c3_custom_post_types()
{
  $slug   = 'material';
  $name   = '材料ライブラリ';
  $labels = stic_custom_post_type_label($name);
  $args   = array(
    'labels'              => $labels,
    'description'         => '材料ライブラリデータを追加します。',
    'public'              => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'show_in_rest'        => true,
    'rest_base'           => 'material',
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
      'trackbacks',
      // 'custom-fields',
      // 'comments',
      'revisions',
      // 'post-formats'
    ),
  );
  register_post_type($slug, $args);

  $slug   = 'item';
  $name   = '材料と付属品';
  $labels = stic_custom_post_type_label($name);
  $args   =  array(
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
    'rest_base'           => 'item',
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
      'trackbacks',
      // 'custom-fields',
      // 'comments',
      'revisions',
      // 'post-formats'
    ),
  );
  register_post_type($slug, $args);
}

add_action('init', 'c3_custom_taxonomies', 0);
function c3_custom_taxonomies()
{

  $slug        = 'material-feature';
  $object_type = array('material'); // 対応させる投稿タイプ
  $name        = '材料の特性';
  $args        = array(
    'labels'                => stic_custom_taxonomy_label($name),
    'public'                => true,
    'show_ui'               => true,
    'show_in_navs_menus'    => false,
    'show_tagcloud'         => false,
    'show_in_quick_edit'    => true,
    'show_in_rest'          => true,
    'rest_base'             => 'material-features', // and検索にするため、material-featureをフィルターフック使うのであえて複数形にしてある
    'meta_box_cb'           => null,
    'show_admin_column'     => true,
    'description'           => '材料の特性を選択します。',
    'hierarchical'          => true,
    'update_count_callback' => '',
    'query_var'             => $slug,
    'rewrite'               => true,
    'sort'                  => true,
  );
  register_taxonomy($slug, $object_type, $args);

  $slug        = 'material-printer';
  $object_type = array('material'); // 対応させる投稿タイプ
  $name        = '材料の対応プリンタ';
  $args        = array(
    'labels'                => stic_custom_taxonomy_label($name),
    'public'                => true,
    'show_ui'               => true,
    'show_in_navs_menus'    => false,
    'show_tagcloud'         => false,
    'show_in_quick_edit'    => true,
    'show_in_rest'          => true,
    'rest_base'             => 'mp',
    'meta_box_cb'           => null,
    'show_admin_column'     => true,
    'description'           => '材料に対応するプリンタを選択します。',
    'hierarchical'          => true,
    'update_count_callback' => '',
    'query_var'             => $slug,
    'rewrite'               => true,
    'sort'                  => true,
  );
  register_taxonomy($slug, $object_type, $args);

  $slug        = 'material-color';
  $object_type = array('material'); // 対応させる投稿タイプ
  $name        = '材料のカラー';
  $args        = array(
    'labels'                => stic_custom_taxonomy_label($name),
    'public'                => true,
    'show_ui'               => true,
    'show_in_navs_menus'    => false,
    'show_tagcloud'         => false,
    'show_in_quick_edit'    => true,
    'show_in_rest'          => true,
    'rest_base'             => 'mc',
    'meta_box_cb'           => null,
    'show_admin_column'     => true,
    'description'           => '材料のカラーを選択します。',
    'hierarchical'          => true,
    'update_count_callback' => '',
    'query_var'             => $slug,
    'rewrite'               => true,
    'sort'                  => true,
  );
  register_taxonomy($slug, $object_type, $args);

  // $slug = 'material-material';
  // $object_type = [ 'material' ]; // 対応させる投稿タイプ
  // $name = '材料の材質';
  // $args = array(
  // 'labels'                => stic_custom_taxonomy_label( $name ),
  // 'public'                => true,
  // 'show_ui'               => true,
  // 'show_in_navs_menus'    => false,
  // 'show_tagcloud'         => false,
  // 'show_in_quick_edit'    => true,
  // 'show_in_rest'          => true,
  // 'meta_box_cb'           => null,
  // 'show_admin_column'     => true,
  // 'description'           => '材料の材質を選択します。',
  // 'hierarchical'          => true,
  // 'update_count_callback' => '',
  // 'query_var'             => $slug,
  // 'rewrite'               => true,
  // 'sort'                  => true
  // );
  // register_taxonomy( $slug, $object_type, $args );

  $slug        = 'material-usage';
  $object_type = array('material'); // 対応させる投稿タイプ
  $name        = '材料の用途';
  $args        = array(
    'labels'                => stic_custom_taxonomy_label($name),
    'public'                => true,
    'show_ui'               => true,
    'show_in_navs_menus'    => false,
    'show_tagcloud'         => false,
    'show_in_quick_edit'    => true,
    'show_in_rest'          => true,
    'rest_base'             => 'mu',
    'meta_box_cb'           => null,
    'show_admin_column'     => true,
    'description'           => '材料の用途を選択します。',
    'hierarchical'          => true,
    'update_count_callback' => '',
    'query_var'             => $slug,
    'rewrite'               => true,
    'sort'                  => true,
  );
  register_taxonomy($slug, $object_type, $args);
}



// REST API関連

// material-featureをor検索にする
add_filter('rest_material_query', 'my_rest_material_query', 10, 2); // rest_{post_type}_query
function my_rest_material_query($args, $request)
{
  if (isset($request['mf'])) {
    $features = explode(',', $request['mf']);
    foreach ($features as $feature) {
      $args['tax_query'][] = array(
        'taxonomy' => 'material-feature',
        'terms'    => $feature,
        'value'    => 'id',
      );
    }
  }

  return $args;
}




// function my_rest_api_format($response, $post, $request) {

// 	// 記事ID取得
// 	$post_id = $response->data['id'];

// 	// 公開日時を公開日に変更
// 	$date = $response->data['date'];
// 	$ts = strtotime($date);
// 	$date = date('Y年m月d日', $ts);

// 	// 記事タイトル（20文字オーバーは三点リーダー）
// 	$title = wp_trim_words($response->data['title']['rendered'], 20, '...');

// 	// 記事詳細URL
// 	$url = $response->data['link'];


// 	// 加工したいフォーマットに整形
// 	$data_formatted = [
// 		'post_id' => $post_id,
// 		'date' => $date,
// 		'title' => $title,
// 		'url' => $url,
// 	];

// 	return $data_formatted;
// }

// add_filter('rest_prepare_material', 'my_rest_api_format', 10, 3);

// materialのper_pageの最大数を変更
// add_filter( 'rest_material_collection_params', 'big_json_change_post_per_page', 10, 1 );
// function big_json_change_post_per_page( $params ) {
// if ( isset( $params['per_page'] ) ) {
// $params['per_page']['maximum'] = 200;
// }
// return $params;
// }

// add_filter( 'rest_material_collection_params', 'custom_rest_material_collection_params', 10, 1);
// function custom_rest_material_collection_params( $params ) {
// $params[ 'orderby' ][ 'enum' ][] = 'menu_order';
// $params[ 'order' ][ 'enum' ][] = 'ASC';
// $params[ 'order' ][ 'enum' ][] = 'DESC';

// return $params;
// }


// メタキーフィルターにワイルドカードを使えるようにする
// function my_posts_where_wildcard( $where, $query ) {
// if ( $query->get( 'wildcard_meta_key' ) ) {
// $where = str_replace( 'meta_key =', 'meta_key LIKE', $where );
// }
// return $where;
// }
// add_filter( 'posts_where', 'my_posts_where_wildcard', 10, 2 );

// function my_posts_where( $where ) {
// $where = str_replace("meta_key = 'material-color_$", "meta_key LIKE 'material-color_%", $where);
// return $where;
// }
// add_filter('posts_where', 'my_posts_where');
// function add_wildcard_to_meta_key_filter( $where ) {
// $where = str_replace("meta_key = 'test_repeater_%", "meta_key LIKE 'test_repeater_%", $where);
// return $where;
// }
// add_filter('posts_where', 'add_wildcard_to_meta_key_filter');
