jQuery(document).ready(function () {
    // Slideshow v2.6.0 (c) 2015 Jesse Fowler, Fiserv
    // Requires jQuery, jQuery Mobile, and CSS
    jQuery.fn.slideShow = function (options) {
        var settings = jQuery.extend({
            showDuration: 10000,
            transitionSpeed: 1000,
            container: this,
            currentIndex: 0,
            tocActive: 'toc-active',
            captionActive: 'captionActive',
            thumbOpacity: 1,
            hoverSelect: false,
            autoPlay: true,
            TOC: 2, 							// TOC: 0 - Off, 1 - Numbered, 2 - Image Alt, 3 - Thumbnails
            tocThumbnailed: false,
            randomSelect: true,
            hoverPause: false,
            captionTables: true,
            debug: false
        }, options);

        var images = settings.container.find('table>tbody>tr>td>p:first-child img, table>tbody>tr>td>p:first-child video'),
			interval,
			toc = [],
			captions = [],
			afterFirstSlide = false,
			hold = false,
			TOCParent = settings.container.parent();	//settings.container.parent().parent().parent().parent()	

        settings.container.addClass('slideshow');
        var muteAll = function () {
            images.each(function () {
                if (jQuery(this).is('video')) {
                    jQuery(this).get(0).muted = true;
                }
            });
        }
        muteAll();
        var pauseAllVideos = function (e) {
            images.not(e).each(function () {
                if (jQuery(this).is('video') && !jQuery(this).get(0).loop && !images.get(0).paused) {
                    jQuery(this).get(0).pause();
                }
            });
        }
        pauseAllVideos();


        var start = function () {
            if (settings.autoPlay && typeof (interval) === 'undefined') {
                interval = self.setInterval(show, settings.showDuration);
            }
        };

        var stop = function () {
            window.clearInterval(interval);
            interval = undefined;
            //console.log(interval)
        };

        var show = function (to) {

            // Ending animation of the last slide.
            images.removeClass('previous');
            images.eq(settings.currentIndex).removeClass('active');
            images.eq(settings.currentIndex).addClass('previous');
            if (!Modernizr.csstransforms) {
                images.eq(settings.currentIndex).fadeOut(settings.transitionSpeed);
            }
            if (settings.TOC > 0) { TOCParent.find('.slideshow-container-controls').children('div').eq(settings.currentIndex).removeClass(settings.tocActive); }
            if (settings.captionTables) {
                TOCParent.find('.caption-container .caption').eq(settings.currentIndex).removeClass(settings.captionActive);
                // Caption Animation 
                if (!Modernizr.csstransforms) {
                    TOCParent.find('.caption-container .caption').eq(settings.currentIndex).animate({
                        left: -580
                    }, (settings.transitionSpeed / 2), "linear", function () {
                        hold = false;
                    });
                }
            }

            // Beginning of the animation of the new slide.
            images.eq(settings.currentIndex = (typeof to != 'undefined' ? to : (settings.currentIndex < images.length - 1 ? settings.currentIndex + 1 : 0))).addClass('active');
            if (settings.debug) { console.log('Showing slide number: ' + (settings.currentIndex + 1)) }
            if (!Modernizr.csstransforms) {
                images.eq(settings.currentIndex).fadeIn(settings.transitionSpeed);
            }
            muteAll();
            pauseAllVideos();
            if (settings.debug && images.get(settings.currentIndex).buffered) { console.log('Typeof buffered: ' + typeof (images.get(settings.currentIndex).buffered) + '; Buffer length: ' + images.get(settings.currentIndex).buffered.length) }
            if (images.eq(settings.currentIndex).is('video') && typeof (images.get(settings.currentIndex).buffered) !== 'undefined' && images.get(settings.currentIndex).buffered.length > 0) {
                images.get(settings.currentIndex).muted = false;
                if (!images.get(settings.currentIndex).loop) {
                    if (settings.debug) { console.log('Not looping. Paused: ' + images.get(settings.currentIndex).paused) }
                    if (images.get(settings.currentIndex).paused) {
                        images.get(settings.currentIndex).play();
                    }
                    stop();
                    images.eq(settings.currentIndex).unbind('ended');
                    images.eq(settings.currentIndex).bind('ended', function () {
                        if (settings.debug) { console.log('Video slide ended') }
                        //images.get( settings.currentIndex ).currentTime = 0;
                        images.get(settings.currentIndex).load();
                        start();
                        show();
                    });
                } else {
                    if (images.get(settings.currentIndex).currentTime == images.get(settings.currentIndex).duration) {
                        images.get(settings.currentIndex).currentTime = 0;
                    }
                }
            }

            // Class all of the elements in the slideshow with a unique order.
            for (i = 0; i < images.length; i++) {
                images.removeClass("item-" + i);
            }
            for (i = settings.currentIndex; i < images.length; i++) {
                images.eq(i).addClass("item-" + (i - settings.currentIndex));
            }
            for (i = 0; i < settings.currentIndex; i++) {
                images.eq(i).addClass("item-" + (i + images.length - settings.currentIndex));
            }

            if (settings.TOC > 0) { TOCParent.find('.slideshow-container-controls').children('div').eq(settings.currentIndex).addClass(settings.tocActive); }
            if (settings.captionTables) {
                TOCParent.find('.caption-container .caption').eq(settings.currentIndex).addClass(settings.captionActive);
                if (!Modernizr.csstransforms) {
                    hold = true;
                    TOCParent.find('.caption-container .caption').eq(settings.currentIndex).animate({
                        left: 0
                    }, (settings.transitionSpeed / 2), "linear", function () {
                        hold = false;
                    });
                }
            }
        };

        var preview = jQuery("<div/>", {
            'class': 'slideshow-container-controls'
        })
        TOCParent.append(preview);

        var captionsContainer = jQuery("<div/>", {
            'class': 'caption-container'
        })
        settings.container.parent().append(captionsContainer);

        images.each(function (index) {
            /* add caption */
            if (settings.captionTables) {
                if (jQuery(this).parent().prop("tagName") != "A") {
                    var tableContents = '<div class="caption captionInActive">' + jQuery(this).parent('p').parent().html() + '</div>';
                } else {
                    var tableContents = '<div class="caption captionInActive">' + jQuery(this).parent('a').parent('p').parent().html() + '</div>';
                }
                captionsContainer.append(tableContents);
            }
            /* add to table of contents */
            // if(index == 0) { tocPreActive = settings.tocActive }
            if (jQuery(this).prop('alt') != null) { tocAlt = jQuery(this).prop('alt'); } else { tocAlt = "" }
            var imgnum = index + 1;
            if (settings.TOC == 3) {
                var tocImg = '<a href="#"><img src="' + jQuery(this).get('src') + '" alt="' + tocAlt + '" title="' + tocAlt + '"></a>';
            } else if (settings.TOC == 2) {
                var tocImg = '<a href="#"><span class="numeric-index">' + imgnum + '</span>' + tocAlt + '</a>';
            } else {
                var tocImg = '<a href="#">' + imgnum + '</a>';
            };

            var tocDiv = jQuery("<div/>", {
                html: tocImg
            });
            preview.append(tocDiv);
            tocDiv.on({
                click: function (e) {
                    if (e) e.preventDefault();
                    stop();
                    start();
                    show(index);
                }/*, mouseenter: function() {
					jQuery(this).fadeIn(settings.transitionSpeed);
					if (settings.hoverSelect) {
						stop();
						show(index);
					}
				}, mouseleave: function() {
					if(!jQuery(this).hasClass(settings.tocActive)) jQuery(this).fadeTo(settings.transitionSpeed,settings.thumbOpacity);
					if (settings.hoverSelect) {
						start();
					}
				} */
            });

            // captionsContainer.inject('mainimg', 'after'); Not sure if this is a requirement.
            //document.id('content1').grab(preview, 'top');
        });

        if (settings.captionTables) {
            captionsContainer.children('.caption').children('p:first-child').remove();
            captionsContainer.children('.caption').children('*:last-child').addClass('lastchild');
        }

        if (settings.TOC > 0) { preview.css('display', 'block'); } else { preview.css('display', 'none'); }

        jQuery('#previous').on({
            click: function (e) {
                if (e) e.preventDefault();
                stop();
                start();
                if ((settings.currentIndex - 1) < 0) {
                    show(images.length - 1);
                } else {
                    show(settings.currentIndex - 1);
                }
            }
        });

        // Swipe previous
        settings.container.add(captionsContainer).on("swiperight", swiperightHandler);

        function swiperightHandler(event) {
            event.stopImmediatePropagation();
            stop();
            start();
            if ((settings.currentIndex - 1) < 0) {
                show(images.length - 1);
            } else {
                show(settings.currentIndex - 1);
            }
        }

        jQuery('#next').on({
            click: function (e) {
                if (!hold) {
                    if (e) e.preventDefault();
                    stop();
                    start();
                    show();
                }
            }
        });

        // Swipe next
        settings.container.add(captionsContainer).on("swipeleft", swipeleftHandler);

        function swipeleftHandler(event) {
            event.stopImmediatePropagation();
            stop();
            start();
            show();
        }

        /* control: start/stop on mouseover/mouseout */
        if (settings.hoverPause) {
            settings.container.on({
                mouseenter: function () { stop(); },
                mouseleave: function () { start(); }
            });
        }
        start();
        if (settings.randomSelect) {
            var randomSlideNumber = Math.floor(Math.random() * (images.length));
            show(randomSlideNumber);
        } else {
            show(0);
        }

        // Play videos
        settings.container.find('video').each(function () {
            if (jQuery(this).get(0).loop && jQuery(this).get(0).paused) {
                jQuery(this).get(0).play();
            }
        });
    };
    jQuery('#slideshow-container').slideShow({
        debug: false
    });
    jQuery('#slideshow-container-alternate').slideShow();


	//Object-fit fix
    jQuery.fn.imageCover = function (options) {
        var settings = jQuery.extend({
            "align": "50",
            "valign": "50",
        }, options);
        var imgArray = jQuery(this);
        if ( !imgArray.eq(0).css('object-fit') ){
	        function changeWidth(imgArray) {
	            for (i = 0; i < imgArray.length; i++) {
	                var image = imgArray.eq(i),
	                    imageRatio = image.width() / image.height(),
	                    parentRatio = image.closest('div').width() / image.closest('div').height();
	                var removeClasses = function(){
	                    image.removeClass('width100');
	                    image.removeClass('height100');
	                }
	                if (imageRatio <= parentRatio) {
	                    removeClasses();
	                    image.addClass('width100');
	                } else {
	                    removeClasses();
	                    image.addClass('height100');
	                }
	            }
	        }
	        changeWidth(imgArray);
	        jQuery(window).resize(function () {
	            changeWidth(imgArray);
	        });
        }
        return this;
    }
	jQuery(window).load(function () {
	    jQuery("#slideshow-container img, #slideshow-container video").imageCover();
    });

	
});
