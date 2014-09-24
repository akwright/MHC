<?php
/**
 * @package MHC
 */
?>
    <?php if ( is_active_sidebar( 'widget-footer' ) ) : ?>
    <footer class="page-footer <?php if(is_front_page()) echo "page__section alternate"; ?> row" role="contentinfo">
      <div class="twelve columns">
      <?php if ( ! dynamic_sidebar( 'Footer' ) ) : ?><?php endif; ?>
      </div>
    </footer>
    <?php endif; ?>
  </div>
  <div class="mobile-menu-wrap">
    <menu class="mobile-menu">
      <?php wp_nav_menu( array(
        'theme_location' => 'mhc_primary_navigation',
        'container' => false,
        'menu_class' => 'links'
      ) ); ?>
    </menu>
    <button class="close-button" id="close-button">Close Menu</button>
  </div>
<?php wp_footer(); ?>
</body>
</html>