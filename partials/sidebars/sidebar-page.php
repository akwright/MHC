<?php
/**
 * @package MHC
 */
?>
<aside class="sidebar spacing small-12 medium-3 columns" role="complementary">
	<?php
    global $id;
    wp_list_pages("title_li=&child_of=$id&show_date=modified&date_format=$date_format");
  ?>
</aside>