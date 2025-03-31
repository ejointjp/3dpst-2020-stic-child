<?php
add_shortcode('contact', 'ps_contact_shortcode');

function ps_contact_shortcode($atts)
{
  ob_start();
?>

  <div class="c-contact">
    <div class="c-contact__container">
      <h3 class="c-contact__title">お気軽にご連絡ください</h3>

      <p class="c-contact__phone">
        <span class="c-contact__phone-icon"><i class="fas fa-phone"></i></span>
        <span class="c-contact__phone-number">025-290-0011</span>
      </p>

      <div class="c-contact__text">株式会社シーキューブ 3Dプリントステーション</div>
      <div class="u-annotation">土日祝を除く9:00 - 18:00</div>
      <p class="u-subtext u-sm u-mt2"><a href="https://carendar.ccube.co.jp" target="_blank" rel="nofollow">営業日を確認</a></p>

      <div class="c-contact__button">
        <?php echo do_shortcode('[a id=610 text="お見積・お問い合わせ" icon="fas fa-envelope" icon_position=before class="button _primary_ _block_ u-round"]'); ?>
      </div>
    </div>
  </div>

<?php
  $data = ob_get_contents();
  ob_end_clean();

  return $data;
}
