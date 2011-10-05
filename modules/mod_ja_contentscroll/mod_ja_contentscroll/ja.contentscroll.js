/*------------------------------------------------------------------------
# JA Zeolite for Joomla 1.5 - Version 1.0 - Licence Owner JA108425
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/

window.addEvent('domready', function() {
	var fx = new Fx.Style($('ja-contentslider-nav-knob'), 'left', {duration: 300, wait: false});
	var myScrollFx = new Fx.Scroll($('ja-contentslider-center'), {
		wait: false
	});

	var x = $('ja-contentslider-center').scrollWidth - $('ja-contentslider-center').offsetWidth;
	var mySlide = new Slider($('ja-contentslider-nav-slider'), $('ja-contentslider-nav-knob'), {	
		steps: x,

		onTick: function(pos){
			fx.start(pos);
			myScrollFx.scrollTo(this.toStep(pos), 0);
		}

	}).set(0);

	mySlide.drag.addEvent('onDrag', function() {
		mySlide.step = mySlide.toStep(mySlide.drag.value.now[mySlide.z]);
		myScrollFx.set([mySlide.step, 0]);
	});

	$('ja-contentslider-nav-left').addEvent ('click', function() {
		mySlide.step -= 100;
		mySlide.step = mySlide.step.limit(0, mySlide.options.steps);
		fx.start(mySlide.toPosition(mySlide.step));
		myScrollFx.scrollTo(mySlide.step, 0);
	});

	$('ja-contentslider-nav-right').addEvent ('click', function() {
		mySlide.step += 100;
		mySlide.step = mySlide.step.limit(0, mySlide.options.steps);
		fx.start(mySlide.toPosition(mySlide.step));
		myScrollFx.scrollTo(mySlide.step, 0);
	});

});
