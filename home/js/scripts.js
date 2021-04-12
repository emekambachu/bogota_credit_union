
//Validate form 1.1.0
(function () {
    jQuery.fn.validateForm = function (options) {
        var settings = jQuery.extend(true, {
            submitObject: jQuery('[type=submit]'), // The object containing the submit ability (jQuery object)
            class: {
                valid: "valid", // The class used to add the custom error for an invalid entry (string)
                invalid: "invalid" // The class used to add the custom error for an invalid entry (string)
            },
            listeners: "change keyup blur", // The event listeners used to determine when to remove the class (string)
            focusPosition: "30%", // The percentage from the top of the viewport the invalid field is placed (string)
            success: function () { // The callback function upon successful validation (function)
                console.log('This form is valid.');
                return true;
            },
            error: function () { // The callback function upon unsuccessful validation (function)
                console.log('This form is not valid.');
                return false;
            }
        }, options),
            _obj = jQuery(this),
            classThis = function (currentElement, validationType, e) {
                var valid = currentElement.get(0).checkValidity(),
                    classed = function () {
                        if (/radio/i.test(currentElement.get(0).type)) {
                            return currentElement.parent().parent();
                        } else {
                            return currentElement.parent();
                        }
                    },
                    eventType = e ? e.type : false;
                switch (validationType) {
                    case _obj.validateForm.class.valid:
                        if (valid) {
                            classed().addClass(_obj.validateForm.class.valid);
                            classed().removeClass(_obj.validateForm.class.invalid);
                        } else {
                            classed().removeClass(_obj.validateForm.class.valid);
                        }
                        break;
                    case _obj.validateForm.class.invalid:
                        if (valid || eventType == "blur") {
                            classed().removeClass(_obj.validateForm.class.invalid);
                        } else {
                            classed().addClass(_obj.validateForm.class.invalid);
                            classed().removeClass(_obj.validateForm.class.valid);
                        }
                        break;
                }
                return true;
            },
            scrollPosition = function (currentElement) {
                return currentElement.offset().top - (jQuery(window).height() * (parseInt(_obj.validateForm.focusPosition) / 100));
            },
            listenerObject = function (currentElement) {
                if (jQuery('[name=' + currentElement.get(0).name + ']').length > 1) {
                    return jQuery('[name=' + currentElement.get(0).name + ']');
                } else {
                    return currentElement;
                }
            },
            validate = function (form) { //Validates all inputs.
                var requiredElements = form.find('input:invalid:not([disabled]), select:invalid:not([disabled]), textarea:invalid:not([disabled])');
                for (i = 0; i < requiredElements.length; i++) {
                    var currentElement = jQuery(requiredElements[i]);
                    invalidField(currentElement);
                    return false;
                }
                return true;
            },
            invalidField = function (obj) {
                //Give user feedback on unfilled required input
                classThis(obj, _obj.validateForm.class.invalid);
                obj.focus();
                jQuery('html, body').scrollTop(scrollPosition(obj));
                listenerObject(obj).on(_obj.validateForm.listeners, function (e) {
                    classThis(obj, _obj.validateForm.class.invalid, e);
                });
            },
            init = function (obj) {
                for (var i = 0, n = obj.length; i < n; i++) {
                    var thisForm = obj.eq(i);
                    thisForm.find(_obj.validateForm.submitObject.selector).on('click', function () {
                        if (!thisForm.get(0).noValidate) {
                            if (validate(thisForm)) {
                                return _obj.validateForm.success();
                            } else {
                                return _obj.validateForm.error();
                            }
                        }
                    });
                    thisForm.find('input:not([disabled]), select:not([disabled]), textarea:not([disabled])').on(_obj.validateForm.listeners, function () {
                        return classThis(jQuery(this), _obj.validateForm.class.valid);
                    });
                }
            };
        _obj.validateForm = settings;
        init(this);
        return this;
    }
}(jQuery));
function initPersonalization(init) {
    /////////////////////////

    // Customized greeting
    function initGreeting() {
        var greeting = "";
        // This array holds the "friendly" day names
        var day_names = new Array(7)
        day_names[0] = "Sunday"
        day_names[1] = "Monday"
        day_names[2] = "Tuesday"
        day_names[3] = "Wednesday"
        day_names[4] = "Thursday"
        day_names[5] = "Friday"
        day_names[6] = "Saturday"
        // This array holds the "friendly" month names
        var month_names = new Array(12)
        month_names[0] = "January"
        month_names[1] = "February"
        month_names[2] = "March"
        month_names[3] = "April"
        month_names[4] = "May"
        month_names[5] = "June"
        month_names[6] = "July"
        month_names[7] = "August"
        month_names[8] = "September"
        month_names[9] = "October"
        month_names[10] = "November"
        month_names[11] = "December"
        // Get the current date
        date_now = new Date()
        // Figure out the friendly day name
        day_value = date_now.getDay()
        date_text = day_names[day_value]
        // Figure out the friendly month name
        month_value = date_now.getMonth()
        date_text += " " + month_names[month_value]
        // Add the day of the month
        date_text += " " + date_now.getDate()
        // Add the year
        date_text += ", " + date_now.getFullYear()
        // Get the minutes in the hour
        minute_value = date_now.getMinutes()
        if (minute_value < 10) {
            minute_value = "0" + minute_value
        }
        // Get the hour value and use it to customize the greeting
        hour_value = date_now.getHours()
        if (hour_value == 0) {
            greeting = "Good morning, "
            time_text = "  " + (hour_value + 12) + ":" + minute_value + " AM"
        }
        else if (hour_value < 12) {
            greeting = "Good morning!"
            time_text = "  " + hour_value + ":" + minute_value + " AM"
        }
        else if (hour_value == 12) {
            greeting = "Good afternoon!"
            time_text = "  " + hour_value + ":" + minute_value + " PM"
        }
        else if (hour_value < 17) {
            greeting = "Good afternoon!"
            time_text = "  " + (hour_value - 12) + ":" + minute_value + " PM"
        }
        else {
            greeting = "Good evening!"
            time_text = "  " + (hour_value - 12) + ":" + minute_value + " PM"
        }
        var fullGreeting = greeting + " It's " + date_text;  //add time + time_text
        if (document.id('greeting')) {
            document.id('greeting').set('html', fullGreeting);
        }
    }
    initGreeting();

    // Personalization
    //initPersonalization();

    var personalizationEnable = init;
    var testCookie = Cookie.write('personalization', personalizationEnable, { duration: 365 });
    if (Cookie.read('personalization')) {
        try {
            $('personalization').addClass('active');
        } catch (e) {

        }
    }
    if (document.id('personalizationPopupxy') && personalizationEnable && Cookie.read('personalization')) {
        var personalizationFirstName = Cookie.read('personalizationFirstName'),
			spans = $$('span.firstname');
        //personalizationsForm 	= document.id('personalizationForm');


        // personalization popup 
        var initializepersonalization = function () {
            document.id('personalizationPopupxy').addClass('active');
            document.id('personalizationName').focus();
        };

        // Name personalization
        var personalizationInitialize = function () {
            personalizationFirstName = Cookie.read('personalizationFirstName');
            if (spans != '') {
                //console.warn(spans);
                spans.each(function (el) {
                    firstNameElement = new Element('a', {
                        'class': 'personalizationSetting',
                        'styles': {
                            'cursor': 'pointer'
                        },
                        events: {
                            click: function () {
                                initializepersonalization();
                            }
                        }
                    });
                    if ($chk(personalizationFirstName) && (personalizationFirstName != 'Skipped')) {
                        firstNameElement.set('html', personalizationFirstName + " ");
                    } else {
                        var linkHtml = el.get('html');
                        firstNameElement.set('html', linkHtml);
                    }
                    el.set('html', '');
                    firstNameElement.inject(el);
                    document.id('personalizationPopupxy').removeClass('active');
                });

                if ($chk(personalizationFirstName) && (personalizationFirstName != 'Skipped')) {

                } else if (personalizationFirstName == 'Skipped') {

                } else {
                    initializepersonalization(); //Disable to remove initial popup
                }

            } else {
                //alert('Spans found.');
            }
        };
        personalizationInitialize();

        personalizationSubmit = function (e) {
            e.preventDefault();
            //var e = new Event(e).stop();
            //var personalizationCookie = Cookie.write('personalizationFirstName', (document.id('personalizationName').value), {duration: 365});
            var personalizationCookie = Cookie.write('personalizationFirstName', (document.id('personalizationName').value), { duration: 365 });
            personalizationInitialize();
            document.id('personalizationPopupxy').removeClass('active');
        };

        var personalizationclose = $$('.personalizationClose');
        personalizationclose.each(function (el, index) {
            el.addEvents({
                click: function () {
                    //var personalizationCookie = Cookie.write('personalizationFirstName', 'Skipped', {duration: 0});
                    var personalizationCookie = Cookie.write('personalizationFirstName', 'Skipped', { duration: 0 });
                    document.id('personalizationPopupxy').removeClass('active');
                }
            });
        });
        var personalizationcloseperm = $$('.personalizationcloseperm');
        personalizationcloseperm.each(function (el, index) {
            el.addEvents({
                click: function () {
                    //var personalizationCookie = Cookie.write('personalizationFirstName', 'Skipped', {duration: 90});
                    var personalizationCookie = Cookie.write('personalizationFirstName', 'Skipped', { duration: 90 });
                    document.id('personalizationPopupxy').removeClass('active');
                }
            });
        });
        if (document.id('personalizationForm')) {
            var personalizationSubmits = document.id('personalizationForm').getChildren('input[type=submit]');
            personalizationSubmits.addEvents({
                click: function () {
                    personalizationSubmit();
                }
            });
        }
        var personalizationOpen = $$('.personalizationSet');
        personalizationOpen.each(function (el, index) {
            el.addEvents({
                click: function () {
                    var personalizationCookie = Cookie.dispose('personalizationFirstName');
                    personalizationFirstName = Cookie.read('personalizationFirstName');
                    initializepersonalization();
                }
            });
        });

    }
}


//Add custom HTML5 validation
(function () {
    jQuery.fn.customError = function (options) {
        var settings = jQuery.extend({
            field: jQuery(this),
            dataset: "data-error"
        }, options);
        for (i = 0; i < settings.field.length; i++) {
            settings.field.eq(i).on('invalid', function () {
                var message = jQuery(this).attr(settings.dataset);
                this.setCustomValidity(message);
            }).on('change keydown blur', function () {
                this.setCustomValidity('');
            });
        }
        return this;
    }
}(jQuery));
//jQuery
jQuery(document).ready(function () {
    jQuery('input[data-error], select[data-error], textarea[data-error]').customError();
	//Table to div
    (function (jQuery) {

        jQuery.fn.tableWrapper = function (options) {

            // This is the easiest way to have default options.
            var settings = jQuery.extend({
                // These are the defaults.
                wrapperClass: "subsection",
                structure: "section",
            }, options);

            var $this = jQuery(this);
            $this.each(function () {
                //console.warn(jQuery(this));
                var wrapper = jQuery('<' + settings.structure + ' class="' + settings.wrapperClass + '"></' + settings.structure + '>');
                var tableimg = jQuery(this).css('background-image'),
	        		subsectionContent = '';
                if (tableimg != 'none') {
                    wrapper.css("background-image", tableimg);
                }
                jQuery(this).children("tbody").children("tr").each(function () {
                    subsectionContent += '<div class="' + settings.wrapperClass + '-content">';
                    jQuery("td:first", this).each(function () {
                        subsectionContent += jQuery(this).html();
                    });
                    subsectionContent += '</div>';
                });
                wrapper.html(subsectionContent);
                jQuery(this).replaceWith(wrapper);
            });
        }
    }(jQuery));
    /*Examples
	Normal Implementation:
	jQuery("table.subsection-table").tableWrapper();
	
	Custom Implementation:
	jQuery("table.subsection-table").tableWrapper({
	    wrapperClass: "customclass",
	});
	*/
    jQuery("table.Subsection-Table").tableWrapper();

    jQuery("table.Subsection-Image-Table").tableWrapper({
        wrapperClass: "subsection-image",
    });
    jQuery("table.Subsection-Promo-Table").tableWrapper({
        wrapperClass: "subsection-promo",
        structure: "div"
    });
    jQuery("table.Quick-Links-Table").tableWrapper({
        wrapperClass: "quick-links",
        structure: "nav"
    });

    //Ajax Form Post
    jQuery('a.Include-Form').cmsInclude({
        url: "inc_contact-form.aspx",
        async: true,
        success: function () {
            jQuery('#the-form').ajaxPost({
                url: "sendmail52.aspx",
                postContainer: jQuery('#contact'),
            }).validateForm({
                success: function () {
                    let captchaAnswer = jQuery('#captchaAnswer'),
                        captcha2 = jQuery('[name=captcha2]');
                    if (captchaAnswer.val() != captcha2.val()) {
                        captchaAnswer.parent('label').addClass('invalid');
                        captchaAnswer.on("change keydown blur", function (e) {
                            captchaAnswer.parent('label').removeClass('invalid');
                        });
                        return (false);
                    }
                    return (true);
                }
            });
        }
    }); 

    //CMS Include
    jQuery('a.Include').cmsInclude();

    //Remove Spaces 2.0.0
    jQuery('p').each(function () {
        var $this = jQuery(this);
        if ($this.html().replace(/\s|&nbsp;/g, '').length == 0)
            $this.remove();
    });

    var links = document.getElementsByTagName("a");
    for (var i = 0; i < links.length; i++) {
        if (links[i].href.match(/speedbump/i) && links[i].href.match(/\?link\=/i) && !links[i].target) {
            links[i].target = '_blank';
        }
    }

    // Removes the blank paragraphs from the bottom of site notice.
    jQuery("#noticeHtml>p:last-of-type").filter(function () {
        return jQuery.trim(jQuery(this).html()) == '&nbsp;';
    }).remove();
    jQuery("ul.toolsnav li").click(function () {
        jQuery(this).toggleClass("activetools");
    });
    jQuery('#promo2stocks').load('inc_stocks.aspx');
    // Responsive Zoom 2.2.2 (c) Jesse Fowler, Fiserv 2014.  All rights reserved.
    // Requires Modernizr, jQuery

    function debounce(func, wait, immediate) {
        var timeout;
        return function () {
            var context = this, args = arguments;
            var later = function () {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    Modernizr.addTest('zoom', function () {
        var test = document.createElement('div');
        if (test.style.zoom === undefined) {
            delete test;
            return false;
        }
        delete test;
        return true;
    });

    jQuery.fn.responsiveZoom = function (options) {
        var settings = jQuery.extend({
            hideBeforeResized: true
        }, options);

        //console.log('Mobile size detected.');	
        var responsiveZoomers = jQuery(this);
        //console.log(responsiveZoomers.length);
        //console.log('Modernizr.csstransforms: ' + Modernizr.csstransforms);
        responsiveZoomers.each(function () {
            //if ( jQuery( "body" ).hasClass( 'mobile' ) ) {

            // reset zoom before calc.
            if (Modernizr.zoom && !Modernizr.csstransforms) {
                jQuery(this).css("zoom", 1);
                //console.log('Reset the zoom to 1.');
            } else {
                jQuery(this).css("transform-origin", "0 0");
                jQuery(this).css("transform", "scale(1)");
                //console.log('Reset the transform scale to: ' + jQuery( this ).css("transform"));
            }

            // The element being zoomed can't be display:none.
            if (jQuery(this).css("display") === 'none') {
                if (jQuery(this).prop("tagName") == "TABLE") {
                    jQuery(this).css("display", "table");
                } else {
                    jQuery(this).css("display", "inline");
                }
                var elWidth = jQuery(this).width();
                jQuery(this).css("display", "none");
            } else {
                var elWidth = jQuery(this).width();
            }

            // Widths set as a percentage are set to pixels for proper scaling.
            if (jQuery(this).attr("tagName") == "TABLE") {
                if (!jQuery(this).data("original-width-string")) {
                    jQuery(this).data("original-width-string", jQuery(this)[0].style.width);
                }
                if (!jQuery(this).data("original-width")) {
                    jQuery(this).data("original-width", elWidth);
                    jQuery(this).css("width", elWidth);
                    //console.log('Set the width to: ' + elWidth);
                } else {
                    jQuery(this).css("width", jQuery(this).data("original-width"));
                    //console.log('Reset the width to: ' + jQuery( this ).data("original-width"));
                }
            }

            // Calculates the zoom level.
            if (Modernizr.zoom && !Modernizr.cssgradients) {
                if (!jQuery(this).data("original-position")) {
                    jQuery(this).data("original-position", jQuery(this).css("position"));
                }
                jQuery(this).css("position", "absolute").css("visibility", "hidden");
            }
            if (!jQuery(this).parent().hasClass("responsive-zoom-wrapper")) {
                var elParentWidth = jQuery(this).parent().width();
            } else {
                var elParentWidth = jQuery(this).parent().parent().width();
            }
            if (Modernizr.zoom && !Modernizr.cssgradients) {
                jQuery(this).css("position", jQuery(this).data("original-position")).css("visibility", "visible");
            }
            //console.log('elParentWidth: ' + elParentWidth);

            //console.log('elWidth: ' + elWidth + ' / elParentWidth: ' + elParentWidth );
            var elZoom = elParentWidth / elWidth;
            //console.log('elZoom: ' + elZoom);

            // Create a new div to hold the parents height if zoom is not supported.
            if (!jQuery(this).parent().hasClass("responsive-zoom-wrapper")) {
                var responsiveZoomWrapper = jQuery('<div class="responsive-zoom-wrapper"></div>');
                jQuery(this).after(responsiveZoomWrapper);
                responsiveZoomWrapper.append(jQuery(this));
                jQuery(this).parent().css("margin-top", jQuery(this).css("margin-top"));
                jQuery(this).css("margin-top", 0);
                jQuery(this).parent().css("margin-bottom", jQuery(this).css("margin-bottom"));
                jQuery(this).css("margin-bottom", 0);
                //console.log('Created responsiveZoomWrapper');
            }

            // Applies the zoom
            if (elZoom < 1) {
                if (Modernizr.zoom && !Modernizr.csstransforms) {
                    jQuery(this).css("zoom", elZoom);
                    //console.log('Zoom set to: ' + elZoom);
                } else {
                    jQuery(this).css("transform-origin", "0 0");
                    jQuery(this).css("transform", "scale(" + elZoom + ")");
                    jQuery(this).parent().css("width", jQuery(this).width() * elZoom);
                    jQuery(this).parent().css("height", jQuery(this).height() * elZoom);
                }
            } else {
                if (Modernizr.zoom && !Modernizr.csstransforms) {
                    jQuery(this).css("zoom", "");
                } else {
                    jQuery(this).css("transform-origin", "");
                    jQuery(this).css("transform", "");
                    if (jQuery(this).parent().hasClass("responsive-zoom-wrapper")) {
                        var parentToRemove = jQuery(this).parent();
                        jQuery(this).css("margin-top", "");
                        jQuery(this).css("margin-bottom", "");
                        parentToRemove.after(jQuery(this));
                        parentToRemove.remove();
                    }
                }
                jQuery(this).css("width", jQuery(this).data("original-width-string"));
            }

            if (settings.hideBeforeResized) { jQuery(this).css("opacity", 1); }
        });
        return this;
    };

    var windowWidth = jQuery(window).width();
    var onWinResizer = debounce(function () {
        if (jQuery(window).width() != windowWidth) {
            onWinResize();
            windowWidth = jQuery(window).width();
        }
    }, 500);

    jQuery(window).on('resize', onWinResizer);

    function onWinResize() {
        var windowSize = jQuery(window).width();
        // Set page width maximums and minimums
        pageWidth = parseFloat(windowSize);
        if (pageWidth < 1000) {
            try {
                jQuery("body").addClass("mobile");
                jQuery("body").removeClass("desktop");
            } catch (err) { }
        } else {
            try {
                jQuery("body").removeClass("mobile");
                jQuery("body").addClass("desktop");
            } catch (err) { }
        }
        /* Examples:
        jQuery( ".responsivezoom" ).responsiveZoom ({
            hideBeforeResized: false
        });
        */

        jQuery("#stocks table").responsiveZoom();
        jQuery(".Table-Simple, .Table-Style").responsiveZoom();
        onWinResizeInitalized = true;
    }
    jQuery(".Table-Simple, .Table-Style").responsiveZoom();

    jQuery.fn.scrollTrigger = function (options) {

        var settings = jQuery.extend({
            triggerClass: "scroll-active",
            scrollMin: 0,
            elementOffset: 1, //percentage of window height if scrollMin not defined.
            resetOnScrollUp: true,
            target: this
        }, options);

        var jQuerythis = this,
            height = jQuery(window).scrollTop(),
            scrollMinProvided = true,
            targetProvided = true;

        if (settings.scrollMin == 0) {
            scrollMinProvided = false;
        }
        if (settings.target === this) {
            targetProvided = false;
        }

        jQuerythis.each(function (index) {
            if (!scrollMinProvided) {
                settings.scrollMin = jQuery(this).offset().top - (jQuery(window).innerHeight() * settings.elementOffset);
            }
            if (height >= settings.scrollMin) {
                if (targetProvided) {
                    settings.target.addClass(settings.triggerClass);
                } else {
                    jQuery(this).addClass(settings.triggerClass);
                }
            } else if (height < settings.scrollMin && settings.resetOnScrollUp) {
                if (targetProvided) {
                    settings.target.removeClass(settings.triggerClass);
                } else {
                    jQuery(this).removeClass(settings.triggerClass);
                }
            }
        });
        return jQuerythis;
    }

    /*Examples
	Normal Implementation:
	jQuery("#header").scrollTrigger();
	
	Custom Implementation:
	jQuery("#gototop").scrollTrigger({
	    triggerClass: "customclass",
	*/
    jQuery(window).scroll(function () {
        jQuery('nav#primary').scrollTrigger({
            triggerClass: 'open-bottom',
            elementOffset: 0.33,
        });
    });
    //Sticky Main Nav / Hide Homenav
    jQuery.fn.stickyNav = function (options) {
        var settings = jQuery.extend({
            offsetTop: 0,
        }, options);
        if (this.length > 0) {
            var windowTop = jQuery(window).scrollTop();
            var obj = jQuery(this);
            var objTop = obj.offset().top - (jQuery(window).height() * settings.offsetTop);

            if (windowTop > objTop) {
                obj.addClass('fixed');
            } else {
                obj.removeClass('fixed');
            }
            jQuery(window).bind('scroll', function () {
                windowTop = jQuery(window).scrollTop();
                if (windowTop >= objTop) {
                    obj.addClass('fixed');
                } else {
                    obj.removeClass('fixed');
                }
            });
            var debouncer;
            jQuery(window).resize(function () {
                clearTimeout(debouncer);
                debouncer = setTimeout(function () {
                    obj.removeClass('fixed');
                    objTop = obj.offset().top - (jQuery(window).height() * settings.offsetTop);

                    if (windowTop > objTop) {
                        obj.addClass('fixed');
                    } else {
                        obj.removeClass('fixed');
                    }
                }, 500);
            });
        }
        return this;
    }
    jQuery('nav#primary').stickyNav();
    // mobile nav
    jQuery("#toolbarlinks").click(function () {
        jQuery("body").toggleClass("opentools");
    });
    jQuery("ul.toolsnav li").click(function () {
        jQuery(this).toggleClass("activetools");
    });
    jQuery("a#nav-open").click(function () {
        jQuery("#login").removeClass("open");
        jQuery(this).toggleClass("open");
        jQuery("nav#primary ul li h2").each(function () {
            jQuery(this).removeClass("open");
        });
    });
    jQuery("nav#primary ul li h2").click(function () {
        jQuery(this).toggleClass("open");
    });
    jQuery("a#login-open").click(function () {
        jQuery("#nav-open").removeClass('open');
        jQuery("#login").toggleClass("open");
    });
    jQuery.fn.navPanelWidth = function (options) {
        var settings = jQuery.extend({
            widthPercent: 140,
        }, options);

        for (i = 0; i < jQuery(this).length; i++) {
            var currentDiv = jQuery(this).eq(i);
            var widthPercentage = currentDiv.children().length * settings.widthPercent;
            currentDiv.css('width', widthPercentage + '%');
            if (currentDiv.children().length <= 1) {
                currentDiv.css('margin', '');
            }
        }
    }
    jQuery("nav#primary ul li > div").navPanelWidth();

    function tableDataTitle() {
        var selectedTable = document.querySelectorAll(".Table-Product");
        if (selectedTable.length > 0) {
            for (t = 0; t < selectedTable.length; t++) {
                var headerCells = selectedTable[t].getElementsByTagName("th"),
                    dataCells = selectedTable[t].getElementsByTagName("td");

                //for every td cell in the row
                for (i = 0; i < dataCells.length; i++) {
                    //get cells cells index
                    var dataCellIndex = dataCells[i].cellIndex,

                    //get same header cells index innerText
                        headerCellText = headerCells[dataCellIndex].innerText;

                    //add the th value as the attribute of the td
                    dataCells[i].setAttribute("data-title", headerCellText);
                }
            }
        }
    }
    tableDataTitle();
        // Responsive Site Notice 3.1.2 Copyright 2015 Jesse Fowler, Fiserv.  All rights reserved.
    // Requires jQuery, CSS and notice article
        (function (jQuery) {

            jQuery.fn.responsiveSiteNotice = function (options) {

                var settings = jQuery.extend({
                    reqLength: 15,
                    fixedPosition: false,
                    delay: 100
                }, options);

                this.each(function () {
                    var $notice = jQuery(this),
                        $noticeHtml = $notice.find('.noticeHtml'),
                        uniqueName = $notice.attr('id') + "NoticeText";
                    var bodyClassName;
                    if ($notice.hasClass("appbanner")) {
                        bodyClassName = "bannernoticeactive";
                    }
                    else {
                        bodyClassName = "noticeactive";
                    }
                    if ($noticeHtml.html().length > settings.reqLength) {

                        var noticeCloser = jQuery('<div class="noticecloser"></div>');

                        var noticeCloserSession = jQuery('<div class="noticeclosersession"></div>');

                        var firstTable = $notice.find('.noticeHtml>table>tbody>tr>td');
                        if (firstTable.length) {
                            noticeCloserSession.prependTo(firstTable);
                            noticeCloser.prependTo(firstTable);
                        } else {
                            noticeCloserSession.prependTo($noticeHtml);
                            noticeCloser.prependTo($noticeHtml);
                        }

                        var bypassNotice = localStorage.getItem(uniqueName),
                            noticeHtmlNow = $noticeHtml.html();
                        if (bypassNotice) {
                            sessionStorage.setItem(uniqueName, bypassNotice);
                        }
                        var bypassNoticeSession = sessionStorage.getItem(uniqueName);

                        if (settings.fixedPosition) {
                            var newId = $notice.prop('id') + '-clone';
                            $notice.clone().prop('id', newId).prependTo(jQuery('body'));
                        }
                        function noticeOpen() {
                            $notice.addClass('active');
                            jQuery('body').addClass(bodyClassName);
                        }
                        function noticeClose() {
                            $notice.removeClass('active');
                            jQuery('body').removeClass(bodyClassName);
                        }
                        try {
                            if (bypassNotice != noticeHtmlNow && bypassNoticeSession != noticeHtmlNow) {
                                setTimeout(noticeOpen, settings.delay);
                                localStorage.removeItem(uniqueName);
                                sessionStorage.removeItem(uniqueName);
                            } else if (bypassNoticeSession != noticeHtmlNow) {
                                setTimeout(noticeOpen, settings.delay);
                                localStorage.removeItem(uniqueName);
                                sessionStorage.removeItem(uniqueName);
                            }
                        } catch (e) {
                            setTimeout(noticeOpen, settings.delay);
                        }

                        noticeCloser.on('click', function () {
                            noticeClose();
                            try {
                                localStorage.setItem(uniqueName, noticeHtmlNow);
                                sessionStorage.setItem(uniqueName, noticeHtmlNow);
                            } catch (e) {
                                console.log('You are in Privacy Mode. Please deactivate Privacy Mode and then reload the page.');
                            }
                            
                        });

                        noticeCloserSession.on('click', function () {
                            noticeClose();
                            try {
                                sessionStorage.setItem(uniqueName, noticeHtmlNow);
                            } catch (e) {
                                console.log('You are in Privacy Mode. Please deactivate Privacy Mode and then reload the page.');
                            }
                            
                        });

                    } else if ($noticeHtml.html().length < settings.reqLength) {
                        localStorage.removeItem(uniqueName);
                        sessionStorage.removeItem(uniqueName);
                    }
                });

                return this;

            };

        }(jQuery));

        // Removes the blank paragraphs from the bottom of site notice.
        jQuery("#noticeHtml>p:last-of-type").filter( function() {
            return jQuery.trim(jQuery(this).html()) == '&nbsp;';
        }).remove();

});
jQuery(window).load(function () {
    if (jQuery("body").hasClass("home")) {
        //Uncomment the line below for implementation
        jQuery(".notice").responsiveSiteNotice();
    }
});