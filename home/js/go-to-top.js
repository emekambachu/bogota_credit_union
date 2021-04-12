jQuery(document).ready(function () {
    //Smooth Scroll
    jQuery(function () {
        jQuery('a#gototop').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = jQuery(this.hash);
                target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    jQuery('html,body').animate({
                        scrollTop: target.offset().top
                    }, 850, 'swing');
                    return false;
                }
            }
        });
    });
    // Scroll Trigger 1.0.0 (c) Kristen Rogers, Fiserv 2015.  All rights reserved.
    // Requires jQuery and CSS.
    (function (jQuery) {

        jQuery.fn.scrollTrigger = function (options) {

            var settings = jQuery.extend({
                triggerClass: "scroll-active",
                scrollMin: 0,
                target: this
            }, options);

            var $this = this,
                height = jQuery(window).scrollTop(),
                scrollMinProvided = true,
                targetProvided = true;

            if (settings.scrollMin == 0) {
                scrollMinProvided = false;
            }
            if (settings.target === this) {
                targetProvided = false;
            }

            $this.each(function (index) {
                if (!scrollMinProvided) {
                    settings.scrollMin = jQuery(this).offset().top - (jQuery(window).innerHeight() * .75);
                }
                if (height >= settings.scrollMin) {
                    if (targetProvided) {
                        settings.target.addClass(settings.triggerClass);
                    } else {
                        jQuery(this).addClass(settings.triggerClass);
                    }
                } else if (height < settings.scrollMin) {
                    if (targetProvided) {
                        settings.target.removeClass(settings.triggerClass);
                    } else {
                        jQuery(this).removeClass(settings.triggerClass);
                    }
                }
            });
            return $this;
        }
    }(jQuery));

    /*Examples
    Normal Implementation:
    jQuery("#header").scrollTrigger();
    
    Custom Implementation:
    jQuery("#gototop").scrollTrigger({
        triggerClass: "customclass",
    }); */
    /****************to work with inc_functions uncomment*****************/
    //jQuery: document ready function
    // Full URL Anchors v1.0.0 Copyright (c) 2014 Fiserv

    jQuery.fn.fullURLAnchors = function () {
        if (this.length > 0) {
            var url = window.location.toString();
            url = url.split("#")[0];
            this.each(function (index) {
                var thisHref = jQuery(this).attr("href");
                if (typeof thisHref !== "undefined" && thisHref.charAt(0) == "#") {
                    jQuery(this).attr("href", url + jQuery(this).attr("href"));
                }
            });
        }
    };

    jQuery("a").fullURLAnchors();
});

jQuery(window).scroll(function () {
    jQuery("#gototop").scrollTrigger({
        triggerClass: "gototopactive",
        scrollMin: 350
    });

});