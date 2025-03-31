<?php get_header(); ?>

<div class="l-content">
  <div class="l-content__header">
    <div class="c-container _lg_">
      <?php get_template_part('component/widget', 'content-header-archive'); ?>
    </div>
  </div>


  <?php if (is_home() || is_category()) : ?>
    <div class="blog-nav">
      <div class="c-container _lg_">
        <div class="blog-nav-list">
          <a class="blog-nav-item blog-nav-all" href=" <?php echo home_url('blog'); ?>">ALL</a>
          <?php
          $args = [
            'order' => 'ASC',
            'orderby' => 'menu_order'
          ];
          foreach (get_categories($args) as $category) {
            $current = is_category($category->slug) ? 'current' : '';

            printf('<a href="%s" class="blog-nav-item blog-nav-%s %s">%s</a>', get_category_link($category->term_id), $category->slug, $current, $category->cat_name);
          }
          ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php
  if (is_page('hardwares') || is_post_type_archive('hardware') || is_tax(['hardware-series', 'hardware-type', 'hardware-genre'])) {

    get_template_part('layout/content-body-archive', 'column-2-right-sidebar');
  } else {
    get_template_part('layout/content-body-archive', get_theme_mod('stic_template_archive', 'column-1-wide'));
  }
  ?>

  <div class="l-content__footer">
    <div class="c-container _lg_">
      <?php get_template_part('component/pagination'); ?>
      <?php get_template_part('component/widget', 'content-footer-archive'); ?>
    </div>
  </div>
</div><!-- .l-content -->

<?php
get_footer();
