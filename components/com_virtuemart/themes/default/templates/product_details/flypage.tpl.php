<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

mm_showMyFileName(__FILE__);

 ?>
<?php echo $buttons_header // The PDF, Email and Print buttons ?>
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
document.write('<a href="#" class="virtue_link" onclick="bookmark(\'http://www.cindylackore.com\',\'CindyLackore.com\');" style="float:right; padding-right:20px;"> Bookmark This Page</a><br/>')
} 
</script></span>

<a onclick="window.open(this.href,'targetWindow','width=580,height=630,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,');return false;" href="/index2.php?option=com_recommendfriends&amp;Itemid=12" class="virtue_link">Email To Friends</a>
<span class="browse_products_top"><?php echo $ask_seller ?></span>
<span class="browse_products_top"><a href="javascript:history.go(-1)" class="virtue_link" style="padding-left:10px;">Previous Page</a></span>
<?php

echo '<span class="browse_products_top"><a href="'.$previous_product_url.'" class="virtue_link">Previous Item</a></span>';
echo '<span class="browse_products_top"><a href="'.$next_product_url.'" class="virtue_link">Next Item</a></span>';

?>
<br/>
<br style="clear:both;" />
<table border="0" style="width: 100%;">
  <tbody>
    <tr>
      <?php  if( $this->get_cfg('showManufacturerLink') ) { $rowspan = 5; } else { $rowspan = 4; } ?>
      <td rowspan="1" colspan="2" align="center"><h1><?php echo $product_name ?> <span style="font-size:15px;">- Actual Product Photos</span> </h1><?php echo $edit_link ?></td>
    </tr>
    <tr>
      <td rowspan="1" colspan="2">
        <?php echo $product_description ?><br/><br/>
        <span style="font-style: italic;"><?php echo $file_list ?></span> </td>
    </tr>
	    <tr>
      <td width="50%" valign="top" align="left" style="font-weight:bold;" valign="top"><?php echo $product_price_lbl ?> <?php echo $product_price ?><br /></td>
      <td valign="top"> <div style="width:250px; height:165px; border:1px #666666 solid; padding:5px;">$4.99 Standard Shipping for your entire order. Shipping within two days.<br/><br/>Free Fed-Ex 2 day express shipping for orders above $250. <br/><br/>
<?php echo $addtocart ?><br /></div></td>
    </tr>
    <tr>
      <td colspan="2"></td>
    </tr>

    <tr>
      <td colspan="3" align="left">Please note that the photos displayed below shows the item exactly as it appears. Each unique piece of hand sculpted glass art is personally made by Cindy Lackore. Each piece is unique and cannot be exactly duplicated, so if you see a piece that fascinates you, please be sure not to miss it. There is nothing more special than wearing a truly unique piece of jewelry.<br/></td>
    </tr>
    <tr>
      <td colspan="3" align="center">

<img src="/components/com_virtuemart/shop_image/product/<?php echo $product_full_image ?>" width="500px" height="500px" /> <br/>
        <br/>
        <?php echo $this->vmlistAdditionalImages( $product_id, $images ) ?></td>
    </tr>
  </tbody>
</table>
<?php 

if( !empty( $recent_products )) { ?>
<div class="vmRecent"> <?php echo $recent_products; ?> </div>
<?php 
}

if( !empty( $navigation_childlist )) { ?>
<?php echo $VM_LANG->_('PHPSHOP_MORE_CATEGORIES') ?><br />
<?php echo $navigation_childlist ?><br style="clear:both"/>
<?php 
} ?>
