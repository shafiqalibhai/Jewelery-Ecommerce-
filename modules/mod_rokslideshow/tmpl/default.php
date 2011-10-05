<?php // no direct access
/**
* @package RokSlideshow
* @copyright Copyright (C) 2007 RocketWerx. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/
defined('_JEXEC') or die('Restricted access'); 
$doc = &JFactory::getDocument();
$doc->addScript('modules/mod_rokslideshow/tmpl/slideshow.js');
JHTML::_('behavior.mootools');

$showCaption 	= $params->get( 'showCaption', 1 );
$showTitleCaption 	= $params->get( 'showTitleCaption', 1 );
$heightCaption = $params->get('heightCaption', 45);
$width = $params->get( 'width', 400 );
$height = $params->get( 'height', 300 );
$altTag = $params->get( 'altTag', 'RokSlideshow - http://www.rocketwerx.com' );
$imageDuration = $params->get( 'imageDuration', 9000 );
$transDuration = $params->get( 'transDuration', 2000);
$transType = $params->get( 'transType', 'combo');
$transition = $params->get( 'transition', 'Expo.easeOut');
$pan = $params->get( 'pan', 50);
$zoom = $params->get( 'zoom', 50);
$loadingDiv = $params->get( 'loadingDiv', 1);
$imageResize = $params->get( 'imageResize', 1);
$titleSize = $params->get( 'titleSize', '13px');
$titleColor = $params->get( 'titleColor', '#fff');
$descSize = $params->get( 'descSize', '11px');
$descColor = $params->get( 'descColor', '#ccc');

if (count($images) > 0) :
?>
	<div id="slidewrap">
		<div id="slideshow"></div>
		<div id="loadingDiv"></div>
	</div>
	<script type="text/javascript">
		window.RokSlideshowPath = '<?php echo $doc->baseurl; ?>';
		window.addEvent('load', function(){
				var imgs = [];

				<?php foreach($images as $img) { 
					$info = modRokSlideshowHelper::getInfo($imagePath, $img);
					?>
					imgs.push({
						file: '<?php echo $img; ?>',
						<?php if ($showCaption==1) { ?>
						title: '<?php echo(trim($info[0])); ?>',
						desc: '<?php echo(trim($info[2])); ?>',
						url: '<?php echo(trim($info[1])); ?>'
					  <?php } else { ?>
						title: '',
						desc: '',
						url: ''
						<?php } ?>
					});
				<?php } ?>
				
				var myshow = new Slideshow('slideshow', { 
					type: '<?php echo $transType; ?>',
					showTitleCaption: <?php echo $showTitleCaption; ?>,
					captionHeight: <?php echo $heightCaption; ?>,
					width: <?php echo $width; ?>, 
					height: <?php echo $height; ?>, 
					pan: <?php echo $pan; ?>,
					zoom: <?php echo $zoom; ?>,
					loadingDiv: <?php echo $loadingDiv; ?>,
					resize: <?php echo($imageResize==1?'true':'false'); ?>,
					duration: [<?php echo $transDuration; ?>, <?php echo $imageDuration; ?>],
					transition: Fx.Transitions.<?php echo $transition; ?>,
					images: imgs, 
					path: '<?php echo $doc->baseurl."/".$imagePath; ?>'
				});
				
				myshow.caps.h2.setStyles({
					color: '<?php echo $titleColor; ?>',
					fontSize: '<?php echo $titleSize; ?>'
				});
				myshow.caps.p.setStyles({
					color: '<?php echo $descColor; ?>',
					fontSize: '<?php echo $descSize; ?>'
				});
			});
			</script>
<?php
endif;
?>