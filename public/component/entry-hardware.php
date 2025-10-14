<article id="post-<?php the_ID(); ?>" <?php post_class('c-entry'); ?>>
  <?php
  if (get_theme_mod('stic_eyecatch_position') === 'before-title' && get_post_meta(get_the_ID(), 'stic_display_eyecatch', true) !== 'hide') {
    get_template_part('component/eyecatch', 'inline');
  }
  ?>
  <div class="c-entry__content">
    <header class="c-entry__header">
      <div class="c-container _3l_">
        <?php dynamic_sidebar('entry-header'); ?>
        <h1 class="c-entry__title"><?php the_title(); ?></h1>
        <p class="c-entry__description"><?php echo get_the_excerpt(); ?>
          <?php
          if (get_post_type() === 'post') {
            get_template_part('component/meta', 'entry-header');
          }
          ?>
      </div>
    </header>

    <?php
    // if (get_post_meta(get_the_ID(), 'stic_display_eyecatch', true) !== 'hide') {
    //   get_template_part('component/eyecatch', 'inline');
    // }
    ?>

    <div class="c-entry__body">
      <?php get_template_part('component/widget', 'entry-body-top'); ?>
      <div id="stic-toc-src">
        <?php the_content(); ?>

        <?php
        $terms = get_the_terms(get_the_ID(), 'hardware-series');
        if (!empty($terms) && !is_wp_error($terms)) {
          $printer = $terms[0]->slug;

          $args = [
            'posts_per_page'   => 12,
            'numberposts'      => 12,
            'orderby'          => 'rand',
            'order'            => 'DESC',
            'exclude'          => get_the_ID(),
            'post_type'        => 'sample',
            'post_status'      => 'publish',
            'tax_query'        => [
              [
                'taxonomy' => 'sample-printer',
                'field'    => 'slug',
                'terms'    => [$printer]
              ]
            ]
          ];

          $myposts = get_posts($args);

          if ($myposts) : ?>
            <h2>関連する造形サンプル</h2>
            <div class="c-sample slick-sample-single">
              <?php foreach ($myposts as $post) : setup_postdata($post); ?>
                <?php get_template_part('component/article-sample-archive'); ?>
              <?php endforeach;
              wp_reset_postdata(); ?>
            </div>
            <p><a href="<?php echo home_url('/sample-printer/' . $printer); ?>" class="c-button _primary_">もっと見る</a></p>
        <?php endif;
        }
        ?>

        <h2>製品のお見積り・ご相談・お問い合わせ</h2>
        <p>製品のお見積り・資料請求やご質問・ご相談などはこちらのお問い合わせフォームより承っております。</p>
        <p><a class="c-button u-round _submit_" href="/contact" target="_blank">お問い合わせフォームへ</a></p>

      </div>


      <?php // ここまで
      ?>
      <?php echo apply_filters('after_the_content', ''); ?>
      <?php get_template_part('component/meta', 'entry-body-bottom'); ?>
      <?php get_template_part('component/widget', 'entry-body-bottom'); ?>
    </div>
  </div>

  <aside class="c-entry__footer">
    <?php get_template_part('component/widget', 'entry-footer-top'); ?>
    <?php get_template_part('component/adjacent-post'); ?>

    <?php if (comments_open()) : ?>
      <div class="p-discussion">
        <?php comments_template(); ?>
        <?php trackback_rdf(); ?>
        <div class="c-trackback">
          <h3 class="c-trackback__title">トラックバック</h3>
          <input class="c-trackback__url" type="text" readonly="readonly" onfocus="this.select();" value="<?php trackback_url(); ?>">
        </div>
      </div>

    <?php endif; ?>

    <?php get_template_part('component/widget', 'entry-footer-bottom'); ?>

  </aside>

</article>