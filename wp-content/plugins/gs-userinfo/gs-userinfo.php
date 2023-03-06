<?php
/**
 * Plugin Name: Плагин JavaScript переадесация по Региону для PolyLang
 * Description: Определяет регион по IP и делает переадресацию
 * Plugin URI: http://goodsite.com.ua/
 * Author: Valeriy Baev
 * Version: 2.0.2
 * Author URI: http://goodsite.com.ua/
 *
 * Text Domain: gs-userinfo
 */


add_action('wp_footer', 'gs_user_redirect', 999);
function gs_user_redirect()
{
    global $post;
    $translations = pll_the_languages(array('raw'=>1));
    $lang = pll_current_language('slug');

    if ($translations["ru"]["url"]) {
        if ($translations["ru"]["no_translation"] != true) {
            $link_ru = $translations["ru"]["url"];
        }

    }

    if ($translations["uk"]["url"]) {
        if ($translations["uk"]["no_translation"] != true) {
            $link_uk = $translations["uk"]["url"];
        }
    }


    ?>
    <script>
        function setCookie(name, value, options = {}) {
            let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

            for (let optionKey in options) {
                updatedCookie += "; " + optionKey;
                let optionValue = options[optionKey];
                if (optionValue !== true) {
                    updatedCookie += "=" + optionValue;
                }
            }
            document.cookie = updatedCookie;
        }

        function geoip(json) {
            var country = json.country_code;
            var sUsrAg = navigator.userAgent.toString();
            var lang = "<?php echo $lang; ?>";

            if (
                (sUsrAg.indexOf('bot') == -1) &
                (sUsrAg.indexOf('crawl') == -1) &
                (sUsrAg.indexOf('slurp') == -1) &
                (sUsrAg.indexOf('spider') == -1) &
                (sUsrAg.indexOf('mediapartners') == -1) &
                (sUsrAg.length > 10)
            ) {
                var redirect_exists = document.cookie.indexOf('gs-country-redirect-session=')

                if (redirect_exists == -1) {
                    if ((lang != "uk") & (country == "UA")) {
                        <?php if (!empty($link_uk)) { ?>
                        window.location.href = "<?php echo $link_uk; ?>";
                        <?php } ?>
                        setCookie('gs-country-redirect-session', true, {path: '/'});
                    }
                    else {
                        var ru_locale = console.log(navigator.languages.join(' ').indexOf('ru'));

                        if (ru_locale != -1) {
                            <?php if (!empty($link_ru)) { ?>
                            window.location.href = "<?php echo $link_ru; ?>";
                            <?php } ?>
                            setCookie('gs-country-redirect-session', true, {path: '/'});
                        }

                        setCookie('gs-country-redirect-session', true, {path: '/'});
                    }
                }

            }
        }

    </script>
    <script async src="https://get.geojs.io/v1/ip/geo.js"></script>
<?php
}
?>