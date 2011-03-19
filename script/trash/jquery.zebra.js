/*
 * jQuery Zebra v1.0.0 - http://www.linkexchanger.su/
 *
 * Copyright (c) 2008 Gennady Samkov
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 */
jQuery.fn.zebra = function(options){
    
	// настройки по умолчанию
	var options = jQuery.extend({
		bgEven: '#FFC080', // бэкграунд для четных строк
        bgOdd: '#FFDFBF', // бэкграунд для нечетных строк
        fontEven: '#AA7239', // цвет шрифта четных строк
        fontOdd: '#AA7239', // цвет шрифта нечетных строк
        bgHover: '#FF8000', // бэкграунд при hover
        fontHover: '#55391C' // цвет шрифта при hover
	},options);
	
	return this.each(function() {

		jQuery(this).find('tr:even')
		            .css('background-color', options.bgEven)
		            .css('color', options.fontEven)
		            .hover(
		                function () {
		                	jQuery(this).css('background-color', options.bgHover)
		                	       .css('color', options.fontHover);
		                }, 
                        function () {
                        	jQuery(this).css('background-color', options.bgEven)
                        	       .css('color', options.fontEven);
                        }
		            );
		
        jQuery(this).find('tr:odd')
                    .css('background-color', options.bgOdd)
                    .css('color', options.fontOdd)
                    .hover(
                        function () {
                        	jQuery(this).css('background-color', options.bgHover)
                        	       .css('color', options.fontHover);
                        }, 
                        function () {
                        	jQuery(this).css('background-color', options.bgOdd)
                        	       .css('color', options.fontOdd);
                        }
                    );
        
	});

};