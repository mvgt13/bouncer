<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

$options = [
    'bouncer_enabled',
    'bouncer_mode',
    'bouncer_heading',
    'bouncer_text_en',
    'bouncer_text_de',
    'bouncer_email',
    'bouncer_website_url',
    'bouncer_retry_after',
    'bouncer_allowed_ips',
    'bouncer_allow_xmlrpc',
    'bouncer_allow_rest',
    'bouncer_show_dark_mode',
    'bouncer_show_website_btn',
    'bouncer_bilingual',
    'bouncer_preview_tokens',
    'bouncer_preview_expiry',
    // Legacy options from pre-2.x single-token era:
    'bouncer_preview_token',
    'bouncer_preview_token_expires',
    'bouncer_preview_use_count',
    'bouncer_preview_last_used',
    // Legacy option from Bouncer 1.0.0 ("bouncer-generic"):
    'bouncer_text',
];

foreach ($options as $option) {
    delete_option($option);
}
