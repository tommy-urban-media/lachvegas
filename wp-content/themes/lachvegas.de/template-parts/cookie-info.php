<?php 

$cookie = false;

if ( isset($_COOKIE['lv_cookie_info']) && (int)$_COOKIE['lv_cookie_info'] == 1 ) {
    $cookie = true;
}

?>


<?php if (!$cookie): ?>
<div class="cookie-info" data-component="CookieBox">
    <div class="cookie-info-text">
        <p>
            Diese Website verwendet Kekse (engl. Cookies). Kekse sind kleine Datein die auf ihrem Computer gespeichert werden um das Benutzererlebnis auf unseren Seiten zu verbessern. Fast alle Webseiten verwenden Kekse.
            Durch das Benutzen dieser Seite stimmen sie automatisch den Cookie-Richtlinien zu. Weitere Informationen können sie den <a href="<?= home_url('/') ?>datenschutzerklaerung/">Datenschutzrichtlinien</a> entnehmen.
        </p>
    </div>
    <button class="link" data-button>Ok einverstanden, jetzt hab ich Heißhunger auf Kekse.</button>
</div>
<?php endif ?>