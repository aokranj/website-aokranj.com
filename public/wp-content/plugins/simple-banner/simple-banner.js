jQuery(document).ready(function ($) {
    const { pro_version_enabled, debug_mode, banner_params } = simpleBannerScriptParams;

    banner_params.forEach((bannerParams, i) => {
        const banner_id = i === 0 ? '' : `_${i+1}`;
        const { 
            simple_banner_text,
            simple_banner_disabled_page_paths,
            disabled_on_current_page,
            close_button_enabled,
            close_button_expiration,
            simple_banner_insert_inside_element,
            simple_banner_prepend_element,
            keep_site_custom_css,
            keep_site_custom_js,
            wp_body_open,
            wp_body_open_enabled,
        } = bannerParams;

        const strings = {
            simpleBanner: `simple-banner${banner_id}`,
            simpleBannerText: `simple-banner-text${banner_id}`,
            simpleBannerCloseButton: `simple-banner-close-button${banner_id}`,
            simpleBannerButton: `simple-banner-button${banner_id}`,
            simpleBannerScrolling: `simple-banner-scrolling${banner_id}`,
            simpleBannerSiteCustomCss: `simple-banner-site-custom-css${banner_id}`,
            simpleBannerSiteCustomJs: `simple-banner-site-custom-js${banner_id}`,
            simpleBannerHeaderMargin: `simple-banner-header-margin${banner_id}`,
            simpleBannerHeaderPadding: `simple-banner-header-padding${banner_id}`,
            simpleBannerClosedCookie: `simplebannerclosed${banner_id}`,
        }

        const isSimpleBannerTextSet = simple_banner_text && simple_banner_text !== undefined && simple_banner_text !== "";
        const isDisabledByPagePath = simple_banner_disabled_page_paths ? simple_banner_disabled_page_paths.split(',')
            .filter(Boolean)
            .some(path => {
                const pathname = path.trim();
                if (pathname.at(0) === '*' && pathname.at(-1) === '*') {
                    return window.location.pathname.includes(pathname.slice(1, -1));
                }
                if (pathname.at(0) === '*') {
                    return window.location.pathname.endsWith(pathname.slice(1));
                }
                if (pathname.at(-1) === '*') {
                    return window.location.pathname.startsWith(pathname.slice(0, -1));
                }
                return window.location.pathname === pathname;
            }) : false;
        const isSimpleBannerEnabledOnPage = !pro_version_enabled || 
            (pro_version_enabled && !disabled_on_current_page && !isDisabledByPagePath);
        const isSimpleBannerVisible = isSimpleBannerTextSet && isSimpleBannerEnabledOnPage;

        if (isSimpleBannerVisible) {
            if (!wp_body_open || !wp_body_open_enabled) {
                const closeButton = close_button_enabled ? `<button aria-label="Close" id="${strings.simpleBannerCloseButton}" class="${strings.simpleBannerButton}">&#x2715;</button>` : '';
                const prependElement = document.querySelector(simple_banner_insert_inside_element || simple_banner_prepend_element || 'body');

                $(
                    `<div id="${strings.simpleBanner}" class="${strings.simpleBanner}"><div class="${strings.simpleBannerText}"><span>${simple_banner_text}</span></div>${closeButton}</div>`
                ).prependTo(prependElement || 'body');
            }

            // could move this out of the loop but not entirely necessary
            const bodyPaddingLeft = $('body').css('padding-left')
            const bodyPaddingRight = $('body').css('padding-right')

            if (bodyPaddingLeft != "0px") {
                $('head').append(`<style type="text/css" media="screen">.${strings.simpleBanner}{margin-left:-${bodyPaddingLeft};padding-left:${bodyPaddingLeft};}</style>`);
            }
            if (bodyPaddingRight != "0px") {
                $('head').append(`<style type="text/css" media="screen">.${strings.simpleBanner}{margin-right:-${bodyPaddingRight};padding-right:${bodyPaddingRight};}</style>`);
            }

            // Add scrolling class
            function scrollClass() {
                const scroll = document.documentElement.scrollTop;
                if (scroll > $(`#${strings.simpleBanner}`).height()) {
                    $(`#${strings.simpleBanner}`).addClass(strings.simpleBannerScrolling);
                } else {
                    $(`#${strings.simpleBanner}`).removeClass(strings.simpleBannerScrolling);
                }
            }
            document.addEventListener("scroll", scrollClass);
        }

        // Add close button function to close button and close if cookie found
        function closeBanner() {
            if (!keep_site_custom_css && document.getElementById(strings.simpleBannerSiteCustomCss)) document.getElementById(strings.simpleBannerSiteCustomCss).remove();
            if (!keep_site_custom_js && document.getElementById(strings.simpleBannerSiteCustomJs)) document.getElementById(strings.simpleBannerSiteCustomJs).remove();
            // Header Margin/Padding only available for Banner #1
            if (document.getElementById(strings.simpleBannerHeaderMargin)) document.getElementById(strings.simpleBannerHeaderMargin).remove();
            if (document.getElementById(strings.simpleBannerHeaderPadding)) document.getElementById(strings.simpleBannerHeaderPadding).remove();
            if (document.getElementById(strings.simpleBanner)) document.getElementById(strings.simpleBanner).remove();
        }
        
        if (isSimpleBannerVisible) {
            const sbCookie = strings.simpleBannerClosedCookie;

            if (close_button_enabled){
                if (getCookie(sbCookie) === "true") {
                    closeBanner();
                    // Set cookie again here in case the expiration has changed
                    setCookie(sbCookie, "true", close_button_expiration);
                } else {
                    document.getElementById(strings.simpleBannerCloseButton).onclick = function() {
                        closeBanner();
                        setCookie(sbCookie, "true", close_button_expiration);
                    };
                }
            } else {
                // disable cookie if it exists
                if (getCookie(sbCookie) === "true") {
                    document.cookie = `${strings.simpleBannerClosedCookie}=true; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
                }
            }
        }
        
    })

    // Cookie Getter/Setter
    function setCookie(cname,cvalue,expiration) {
        let d;
        if (expiration === '' || expiration === '0' || parseFloat(expiration)) {
            const exdays = parseFloat(expiration) || 0;
            d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
        } else {
            d = new Date(expiration);
        }
        const expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function getCookie(cname) {
        const name = cname + "=";
        const decodedCookie = decodeURIComponent(document.cookie);
        const ca = decodedCookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    // Debug Mode
    // Console log all variables
    if (pro_version_enabled && debug_mode) {
        console.log(simpleBannerScriptParams);
    }
});
