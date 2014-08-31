<?php
/**
 * @package MHC
 */
?>
  <?php if ( is_active_sidebar( 'widget-footer' ) ) : ?>
  <footer class="container page-footer <?php if(is_front_page()) echo "page__section alternate"; ?> row" role="contentinfo">
    <div class="twelve columns">
    <?php if ( ! dynamic_sidebar( 'Footer' ) ) : ?><?php endif; ?>
    </div>
  </footer>
  <?php endif; ?>
</div>
<?php wp_footer(); ?>
</body>
</html>