<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); ?>
<?php if(!@is_object( $pagenav)) return;  ?>
<!-- BEGIN PAGE NAVIGATION -->

<?php if($_GET[category_id] != "")
{
?>
<div align="center" id="pagenavigations">
	<?php $pagenav->writePagesLinks( $search_string ); ?>
</div>
<?php }
else {
} ?>

<!-- END PAGE NAVIGATION -->