<?php get_header(); ?>

<section class="c-hero">
  <?php if (has_post_thumbnail()) : ?>
    <?php the_post_thumbnail('full'); ?>
  <?php endif; ?>

  <div class="c-container _lg_">
    <div class="c-hero__content">
      <h1 class="c-hero__title">モノづくりに強い、本格3Dプリントサービス</h1>
      <p class="c-hero__description">3Dプリントに関する一連のサービスを総合的に提供､さまざまなものづくりの現場における､試作・検証のコスト削減・効率化を全面的にサポートします｡</p>
      <div class="c-hero__button">
        <?php echo do_shortcode('[a id=136 text=3Dプリントステーションが選ばれている理由 class="btn btn--theme--secondary btn--responsive"]'); ?>
      </div>
    </div>
  </div>

</section>

<section style="padding: 3rem 1.5rem; max-width: 640px; margin: auto;">
  <a href="<?php echo home_url('7810#link-sample'); ?>" target="_blank" style="max-width: 840px; margin: auto; display: block;">
    <img src="<?php echo get_theme_file_uri('/assets/images/minisanpurubanner.jpg'); ?>" alt="3Dプリントを体感してみよう ミニチュアサンプルお申し込みはこちらから">
  </a>
</section>

<section class=" c-post-info">
  <div class="c-post-info__container container _lg_">
    <?php
    // $category_info_id = 23; //お知らせのカテゴリID
    $args = array(
      'posts_per_page'   => 1,
      'numberposts'      => 1,
      'offset'           => 0,
      'category'         => '',
      'orderby'          => 'post_date',
      'order'            => 'DESC',
      'include'          => '',
      'exclude'          => '',
      'meta_key'         => '',
      'meta_value'       => '',
      'post_type'        => 'post',
      'post_mime_type'   => '',
      'post_parent'      => '',
      'post_status'      => 'publish',
      'suppress_filters' => true
    );

    $myposts = get_posts($args);
    foreach ($myposts as $post) : setup_postdata($post); ?>

      <div class="c-post-info__date">
        <?php the_date(); ?>
      </div>
      <div class="c-post-info__content">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </div>

    <?php endforeach;
    wp_reset_postdata(); ?>
    <div class="c-post-info__button">
      <a class="c-button _primary_ u-round u-xs" href="<?php echo home_url('/blog'); ?>">ブログ一覧 <i class="fas fa-chevron-right"></i></a>
    </div>
</section>

<section class="c-section">
  <div class="c-section__container c-container _3l_">
    <h2 class="c-section__title">造形サンプル</h2>
    <div class="c-sample">
      <div class="slick">
        <?php
        $args = array(
          'posts_per_page' => 12,
          'orderby'        => 'post_date',
          'order'          => 'DESC',
          'post_type'      => 'sample'
        );

        $myposts = get_posts($args);
        foreach ($myposts as $post) : setup_postdata($post);
          get_template_part('component/article-sample-archive');
        endforeach;
        wp_reset_postdata();
        ?>

      </div><!-- slick -->
    </div><!-- c-sample -->

    <div class="c-section__button u-mt10">
      <a class="c-button _primary_ u-round " href="/sample/">造形サンプル一覧を見る <i class="fas fa-chevron-right"></i></a>
    </div>
  </div>
</section>



<section class="c-section">
  <div class="c-section__contaner c-container _3l_">
    <h2 class="c-section__title">3Dプリントステーションのサービス</h2>
    <?php echo do_shortcode('[child-page id=46 content=true img=wide exclude="302, 470, 184, 136" col="_tablet6_ _pc4_"]'); ?>
  </div>

  <div class="c-section__button u-mt10">
    <a class="c-button _primary_ u-round" href="/services/">サービス一覧を見る <i class="fas fa-chevron-right"></i></a>
  </div>
</section>

<section class="c-section">
  <div class="c-section__container c-container _lg_">
    <h2 class="c-section__title">ご利用ガイド</h2>
    <?php echo do_shortcode('[child-page id=120 img=wide col="_tablet6_ _pc4_"]'); ?>

    <div class="c-section__button u-mt10">
      <a class="c-button _primary_ u-round" href="/guide/">ご利用ガイドを見る <i class="fas fa-chevron-right"></i></a>
    </div>
  </div>
</section>

<section class="c-section">
  <div class="c-section__container c-container _xs_">
    <div class="contact contact--page u-trim aligncenter">
      <h3>お気軽にご連絡ください</h3>
      <p class="contact__phone">
        <span class="contact__phone__icon"><i class="fas fa-phone"></i></span>
        <span class="contact__phone__number">025-290-7121</span>
      </p>
      <p class="contact__text">株式会社シーキューブ 3Dプリントステーション</p>
      <p class="u-subtext u-xs u-mt2">※土日祝を除く9:00 - 17:00</p>

    </div>
  </div>
</section>

<?php get_footer();
