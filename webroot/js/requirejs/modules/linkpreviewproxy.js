define(['require'], function(require){
    function proxifyUrl(proxy_url, url) {
        return proxy_url+"?url=" + encodeURIComponent(url);
    }

    function unproxifyUrl(proxy_url, url) {
        return decodeURIComponent(url.split(proxy_url+"?url=")[1]);
    }

    $.ajaxPrefilter(function( settings ) {
        if (settings && settings.crossDomain && settings.url) {
            var proxy_url = webroot+'components/linkpreview/demos/php-proxy/proxy.php';
            settings.url = proxifyUrl(proxy_url,settings.url);

            var settingsCopy = {
                url: unproxifyUrl(proxy_url, settings.url),
                complete: settings.complete,
                success: settings.success,
                error: settings.error
            };

            settings.complete = function(jqXHR, textStatus) {
                settingsCopy.complete(jqXHR, textStatus);
            };

            settings.success = function(data, textStatus, jqXHR) {
                settingsCopy.success(data, textStatus, jqXHR);
            };

            settings.error = function(jqXHR, textStatus, errorThrown) {
                settingsCopy.error(jqXHR, textStatus, errorThrown);
            };
        }

        settings.crossDomain = false;
    });
});