<?php
/**
 * @package MHC
 */
?>
<?php if ( is_active_sidebar( 'widget-footer' ) ) : ?>
<footer class="container page-footer" role="contentinfo">
  <div class="row">
  <?php if ( ! dynamic_sidebar( 'Footer' ) ) : ?>

  <?php endif; ?>
  </div>
</footer>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>