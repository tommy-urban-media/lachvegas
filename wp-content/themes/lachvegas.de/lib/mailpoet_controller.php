<?php
/**
 * Handles Shortcodes for Mailpoet E-Mail Template
 */

class MailpoetController {


    public function __construct() {
        $this->registerShortcodes();
    }

    public function registerShortcodes() {
        add_filter('mailpoet_newsletter_shortcode', array($this, 'mailpoet_custom_shortcode'), 10, 5);
    }

    public function mailpoet_custom_shortcode($shortcode, $newsletter, $subscriber, $queue, $newsletter_body) {
        
        // always return the shortcode if it doesn't match your own!
        if ($shortcode === '[custom:news]') {
            $latestNews = $this->renderLatestPosts(5, 'news', 'news');
            return $latestNews;
        }

        if ($shortcode === '[custom:posts]') {
            $latestPosts = $this->renderLatestPosts(3, 'post', 'posts');
            return $latestPosts;
        }

        if ($shortcode === '[custom:statistic]') {
            $latestPosts = $this->renderLatestPosts(1, 'statistic', 'statistic');
            return $latestPosts;
        }

        if ($shortcode === '[custom:poll]') {
            $latestPosts = $this->renderLatestPosts(1, 'poll', 'poll');
            return $latestPosts;
        }
        
        return false;
    }


    public function renderLatestPosts( $post_num = 5, $post_type = 'news', $template) {
        $args = array(
            'posts_per_page' => $post_num,
            'orderby' => 'date',
            'date_query' => array(
                'before' => date('Y-m-d H:i:s', strtotime('+1 day'))
            ),
            'post_status' => 'publish',
            'post_type' => $post_type
        );

        if ($post_type == 'post') {
            $args['tax_query'] = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'post_settings',
                    'field' => 'name',
                    'terms' => array('teasable')
                )
            );
        }

        $newsPostsQuery = new WP_Query($args);

        $output = '';
        global $post, $mail_query;

        $mail_query = $newsPostsQuery;

        ob_start();
        get_template_part('lib/templates/mailpoet/' . $template);
        wp_reset_postdata();
        return ob_get_clean();
    }

}
