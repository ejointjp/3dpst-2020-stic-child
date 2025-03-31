<div class="p-material-library" id="material-library">
  <div class="c-container _3l_">
    <?php
    require_once get_theme_file_path('inc/class-url-manager.php');

    $query = Stic_Url_Manager::query();
    $query = wp_parse_args($query);


    $tax_queries = array();

    foreach ($query as $key => $value) {
      if (is_array($value)) {
        foreach ($value as $val) {
          $tax_query = array(
            'taxonomy' => $key,
            'field'    => 'term_id',
            'terms'    => $val,
          );
          array_push($tax_queries, $tax_query);
        }
      } elseif ($value) {
        $tax_query = array(
          'taxonomy' => $key,
          'field'    => 'term_id',
          'terms'    => $value,
        );
        array_push($tax_queries, $tax_query);
      }
    }

    var_dump($tax_queries);
    $args = array(
      'posts_per_page' => -1,
      'orderby'        => 'post_date',
      'order'          => 'DESC',
      'post_type'      => 'material',
    );

    // predump($tax_queries);
    $args['tax_query'] = $tax_queries;
    $myposts           = get_posts($args);
    ?>

    <div class="c-row">

      <div class="c-col _wide5_">
        <div class="p-material-library__header">
          <!-- <div class="p-material-library__buttonWrap">
      <span class="p-material-library__button button _primary_ u-round" id="p-material-library__button">
        <i class="fas fa-search"></i> 条件を絞って材料を探す
      </span>
      </div> -->

          <div class="p-material-library__search-filter">
            <form class="_custom_ u-trim">

              <!-- <div class="p-material-library__buttonWrap">
        <button type="submit" class="p-material-library__button button _primary_ u-round">
          <i class="fas fa-search"></i> この条件で材料を探す
        </button>
        </div> -->
              <p class="p-material-library__reset"><a class="c-button u-xs u-round" href="<?php the_permalink(); ?>">条件をリセット</a></p>
              <p class="p-material-library__count">検索結果: {{ items.length }}件</span></p>

              <div class="c-form__item">
                <span class="c-form__label">対応プリンタ</span>
                <div class="c-control _image_">
                  <?php
                  $terms = get_terms('material-printer');
                  foreach ($terms as $term) :
                  ?>
                    <label class="c-control__item">
                      <input type="radio" name="mp" value="<?php echo $term->term_id; ?>" v-model="values['mp']" data-label="<?php echo $term->name; ?>" <?php checked($term->term_id, $query['material-printer'] ?? null); ?>>
                      <?php $upload_dir = wp_upload_dir(); ?>
                      <div class="c-control__figure"><img src="<?php echo $upload_dir['baseurl']; ?>/3d-printer/<?php echo $term->slug; ?>.png" alt="<?php echo $term->name; ?>"></div>
                      <div class="c-control__label"><?php echo $term->name; ?></div>
                    </label>
                  <?php endforeach; ?>
                  <label class="c-control__item">
                    <input type="radio" name="mp" value="" v-model="values['mp']" data-label="" <?php checked('', $query['material-printer'] ?? null); ?>>
                    <?php $upload_dir = wp_upload_dir(); ?>
                    <div class="c-control__figure"><img src="<?php echo $upload_dir['baseurl']; ?>/3d-printer/all.png" alt=""></div>
                    <div class="c-control__label">指定なし</div>
                  </label>
                </div>
              </div>

              <div class="c-form__item">
                <div class="c-form__label">特性で絞り込む</div>
                <div class="c-control _horizontal_" id="material-feature">
                  <?php
                  $terms = get_terms('material-feature');
                  foreach ($terms as $term) :
                  ?>
                    <label class="c-control__item">
                      <input type="checkbox" class="c-control__input" name="mf" value="<?php echo esc_attr($term->term_id); ?>" v-model="values['mf']" data-label="<?php echo $term->name; ?>" <?php checked(is_array($query['material-feature'] ?? null) ? in_array(strval($term->term_id), $query['material-feature'] ?? null, true) : false); ?>>
                      <span class="c-control__label"><?php echo esc_html($term->name); ?></span>
                    </label>

                  <?php endforeach; ?>
                </div>
              </div>

              <div class="c-form__item">
                <div class="c-form__label">用途で絞り込む</div>
                <div class="c-control _horizontal_">
                  <?php
                  $terms = get_terms('material-usage');
                  foreach ($terms as $term) :
                  ?>

                    <label class="c-control__item">
                      <input type="radio" class="c-control__input" name="mu" value="<?php echo esc_attr($term->term_id); ?>" v-model="values['mu']" data-label="<?php echo $term->name; ?>" <?php checked(is_array($query['material-usage'] ?? null) ? in_array(strval($term->term_id), $query['material-usage'] ?? null, true) : false); ?>>
                      <span class="c-control__label"><?php echo esc_html($term->name); ?></span>
                    </label>

                  <?php endforeach; ?>
                  <label class="c-control__item">
                    <input type="radio" class="c-control__input" name="mu" value="" v-model="values['mu']" data-label="">
                    <span class="c-control__label">指定なし</span>
                  </label>
                </div>
              </div>

              <div class="u-flex _wrap_">
                <label class="c-form__item">
                  <div class="c-form__label">カラーバリエーション</div>
                  <div class="c-control _horizontal_">

                    <?php $terms = get_terms('material-color'); ?>
                    <?php foreach ($terms as $key => $term) : ?>

                      <label class="c-control__item">
                        <input type="radio" class="c-control__input" name="mc" value="<?php echo esc_attr($term->term_id); ?>" v-model="values['mc']" data-label="<?php echo $term->name; ?>" <?php checked(is_array($query['material-color'] ?? null) ? in_array(strval($term->term_id), $query['material-color'] ?? null, true) : false); ?>>
                        <span class="c-control__label"><?php echo esc_html($term->name); ?></span>
                      </label>

                    <?php endforeach; ?>

                    <label class="c-control__item">
                      <input type="radio" class="c-control__input" name="mc" value="" v-model="values['mc']" data-label="">
                      <span class="c-control__label">指定なし</span>
                    </label>
                  </div>
                </label>

                <!-- <label class="c-form__item">
        </div>

        <div class="p-material-library__buttonWrap">
        <button type="submit" class="p-material-library__button button _primary_ u-round" id="p-material-library__button">
          <i class="fas fa-search"></i> この条件で材料を探す
        </button> -->

              </div>
              <p class="p-material-library__reset"><a class="c-button u-xs u-round" href="<?php the_permalink(); ?>">条件をリセット</a></p>
            </form>
          </div>
        </div>
      </div>

      <div class="c-col _wide7_">
        <!-- <div class="p-material-library__conditions">
      <div
      v-for="item in termNames"
      :data-key="item.key"
      class="c-label u-round"
      >
      {{ item.label }}
      <span
        :data-key="item.key"
        @click="removeTerm(item.key, item.value)"
        class="c-label__icon"
      >
        <i class="fas fa-times"></i>
      </span>
      </div>
    </div> -->
        <p class="p-material-library__count">検索結果: {{ items.length }}件</span></p>


        <div class="p-material-library__body">
          <div class="c-row _sm_">
            <div class="c-col _phone6_ _tablet4_ _pc3_ _fullhd2_" v-for="item in items">
              <a class="c-material-archive" :href="item.link" v-if="item" target="_blank">
                <figure class="c-material-archive__figure">
                  <div class="c-material-archive__image" v-if="item._embedded['wp:featuredmedia']">
                    <img v-if="typeof item._embedded['wp:featuredmedia'][0]['media_details']['sizes']['square']['source_url'] != 'undefined'" :src="item._embedded['wp:featuredmedia'][0]['media_details']['sizes']['square']['source_url']" :alt="item.title.rendered">
                  </div>
                </figure>

                <div class="c-material-archive__content">
                  <h3 class="c-material-archive__title">{{ item.title.rendered }}</h3>
                  <p class="c-material-archive__summary">{{ item.acf['material-summary'] }}</p>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div><!-- row -->
  </div><!-- container -->
  <div class="p-material-library__loading">

    <?php require get_theme_file_path('/inc/svg/loading.svg'); ?>
    <div class="p-material-library__loading__text">Loading</div>

  </div>
</div>