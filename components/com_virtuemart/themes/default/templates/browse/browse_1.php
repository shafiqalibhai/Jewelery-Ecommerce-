<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

mm_showMyFileName(__FILE__);

 ?>

 <div class="browseProductContainer">

        <div class="browseProductImageContainer">

		<a title="<?php echo $product_name ?>" href="<?php echo $product_flypage ?>">
            <?php echo ps_product::image_tag( $product_thumb_image, 'class="browseProductImage" border="0" title="'.$product_name.'" alt="'.$product_name .'"' ) ?>
		</a>
        </div>

        <h3 class="browseProductTitle" style="text-align:center;"><a class="product_browse_link" title="<?php echo $product_name ?>" href="<?php echo $product_flypage ?>">
            <?php echo $product_name ?></a>
        </h3>

</div>

