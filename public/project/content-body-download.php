<div class="download">

	<div class="c-row _md_">
	<?php $args = array(
	'posts_per_page'   => -1,
	'numberposts'      => -1,
	'offset'           => 0,
	'category'         => '',
	'orderby'          => 'menu_order',
	'order'            => 'ASC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'download',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'post_status'      => 'publish, private',
	'suppress_filters' => true,
);

	$myposts = get_posts( $args );
foreach ( $myposts as $post ) :
	setup_postdata( $post ); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class( 'download__item c-col _tablet6_ _pc4_' ); ?>>
		<div class="download__header">
		<figure class="download__figure">
		<?php
		the_post_thumbnail( 'medium_large' );
		?>
		</figure>

		<div class="download__body">

			<div class="download__title"><?php the_title(); ?></div>

			<?php if ( $file = get_field( 'download-file', get_the_ID() ) ) : ?>
			<a class="download__button c-button _primary_  u-sm" href="<?php echo $file['url']; ?>" target="_blank"><i class="fas fa-download"></i><span class="download__hide"> ダウンロード</span></a>
			<?php endif; ?>

			<div class="download__content"><?php the_content(); ?></div>
		</div>
	</div>
	</div>

	<?php
	endforeach;
	wp_reset_postdata();
?>

	</div><!--row-->

</div><!--download-->
