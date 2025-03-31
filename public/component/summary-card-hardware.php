<?php
// 一覧のアイテム カード形
?>

<a <?php post_class('c-summary _card_'); ?> href="<?php the_permalink(); ?>">
  <figure class="c-summary__figure">
    <div class="c-summary__image">
      <?php if (get_the_post_thumbnail()) : ?>
        <?php the_post_thumbnail(); ?>

      <?php elseif (get_theme_mod('stic_default_eyecatch')) : ?>
        <img src="<?php echo wp_get_attachment_image_src(get_theme_mod('stic_default_eyecatch'), 'full')[0]; ?>" alt="">
      <?php endif; ?>
    </div>
  </figure>

  <div class="c-summary__content">
    <div class="c-summary__body">
      <h2 class="c-summary__title _exclude_"><?php the_title(); ?></h2>
      <p class="c-summary__description"><?php echo get_the_excerpt(); ?></p>
    </div>
    <?php if (get_post_type() !== 'page') : ?>
      <div class="c-summary__footer">


        <div class="c-meta">
          <?php //get_template_part('component/meta', 'category');
          ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</a>