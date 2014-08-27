<?php
/**
 * @package MHC
 */
?>

<?php $search_placeholder = __( 'Type your query, hit enter', 'mhc_theme' ); ?>
<form method="get" id="searchform" action="<?php echo home_url(); ?>/" role="search">
	<input type="text" placeholder=<?php echo '"' . $search_placeholder . '" '; ?> class='textinput' name="s" id="s" />
</form>