<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @package szpnew-wp-theme
 */

// Określ język
$pll_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'pl';
$is_english = $pll_lang === 'en';

// Tłumaczenia
if ($is_english) {
    $page_title = '404 – Page Not Found';
    $page_intro = 'The page you are looking for may have been moved or no longer exists.';
    $page_content = 'Return to the homepage or contact us if you need support.';
    $button_text = 'Back to Homepage';
    $contact_text = 'Contact us';
} else {
    $page_title = '404 – Nie znaleziono strony';
    $page_intro = 'Wygląda na to, że strona, której szukasz, nie istnieje lub została przeniesiona.';
    $page_content = 'Wróć na stronę główną lub skontaktuj się z nami, jeśli potrzebujesz wsparcia.';
    $button_text = 'Wróć na stronę główną';
    $contact_text = 'Skontaktuj się z nami';
}

// URL-e
$home_url = home_url('/');
$contact_url = $is_english ? home_url('/en/contact/') : home_url('/kontakt/');

get_header();
?>

<!-- Page Top / Hero -->
<section class="rs-page-top include-bg no-bg">
    <div class="rs-page-top-overlay d-none d-lg-block"></div>
    <div class="container">
        <div class="rs-page-top-content">
            <h2 class="rs-page-top-title text-white">
                <?php echo esc_html($page_title); ?>
            </h2>
            <?php if ($page_intro) : ?>
                <div class="rs-page-top-intro text-white">
                    <p><?php echo esc_html($page_intro); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<main class="default-page rs-legal-page" role="main">
    <section class="section-space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="rs-legal-page-content text-center">
                        <p class="mb-4"><?php echo esc_html($page_content); ?></p>

                        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                            <a href="<?php echo esc_url($home_url); ?>" class="rs-btn has-theme-blue has-icon has-bg">
                                <?php echo esc_html($button_text); ?>
                                <span class="icon-box">
                                    <svg class="icon-first" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                        <path d="M31.71,15.29l-10-10L20.29,6.71,28.59,15H0v2H28.59l-8.29,8.29,1.41,1.41,10-10Z" />
                                    </svg>
                                    <svg class="icon-second" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                        <path d="M31.71,15.29l-10-10L20.29,6.71,28.59,15H0v2H28.59l-8.29,8.29,1.41,1.41,10-10Z" />
                                    </svg>
                                </span>
                            </a>

                            <a href="<?php echo esc_url($contact_url); ?>" class="rs-btn has-theme-blue-outline has-icon">
                                <?php echo esc_html($contact_text); ?>
                                <span class="icon-box">
                                    <svg class="icon-first" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                        <path d="M31.71,15.29l-10-10L20.29,6.71,28.59,15H0v2H28.59l-8.29,8.29,1.41,1.41,10-10Z" />
                                    </svg>
                                    <svg class="icon-second" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                        <path d="M31.71,15.29l-10-10L20.29,6.71,28.59,15H0v2H28.59l-8.29,8.29,1.41,1.41,10-10Z" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
