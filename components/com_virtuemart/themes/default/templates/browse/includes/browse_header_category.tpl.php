<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 

mm_showMyFileName(__FILE__);?>

<a onclick="window.open(this.href,'targetWindow','width=580,height=630,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,');return false;" href="/index2.php?option=com_recommendfriends&amp;Itemid=12" class="virtue_link">Email To Friends</a>
<span class="browse_products_top"><a href="/index.php?option=com_rsform&formId=4" class="virtue_link">Ask Questions</a></span>
<span class="browse_products_top" style="padding-left: 200px;">
<script type="text/javascript">
var text = "Bookmark This Page!"

var site = "http://www.cindylackore.com";

var desc = "Cindy Lackore"
var ver = navigator.appName
var num = parseInt(navigator.appVersion)
if ((ver == "Microsoft Internet Explorer")&&(num >= 4))
{
document.write('<a title="Bookmark this page" href="javascript:window.external.AddFavorite(site,desc);" ');
document.write('onMouseOver=" window.status=')
document.write("text; return true ")
document.write('"onMouseOut=" window.status=')
document.write("' '; return true ")
document.write('">'+ text + '</a>')
}
else
{
document.write('<a href="#" class="virtue_link" onclick="bookmark(\'http://www.cindylackore.com\',\'CindyLackore.com\');" > Bookmark This Page</a>')
} 
</script></span>

<br/><br/><br/>
<div align="center">
<h3>Click on individual Picture<br/>

for More information and detail view<br/>

Results below, for further info. in this space...</h3></div>

<br/><br/><br/>

<!-- 
<h3><?php echo $browsepage_lbl; ?> 

	<?php 

	if( $this->get_cfg( 'showFeedIcon', 1 ) && (VM_FEED_ENABLED == 1) ) { ?>

	<a href="index.php?option=<?php echo VM_COMPONENT_NAME ?>&amp;page=shop.feed&amp;category_id=<?php echo $category_id ?>" title="<?php echo $VM_LANG->_('VM_FEED_SUBSCRIBE_TOCATEGORY_TITLE') ?>">

	<img src="<?php echo VM_THEMEURL ?>/images/feed-icon-14x14.png" align="middle" alt="feed" border="0"/></a>

	<?php 

	} ?>

</h3>



<div style="text-align:left;">

	<?php echo $navigation_childlist; ?>

</div>

<?php if( trim(str_replace( "<br />", "" , $desc)) != "" ) { ?>



		<div style="width:100%;float:left;">

			<?php echo $desc; ?>

		</div>

		<br class="clr" /><br />

		<?php

     }

?> -->