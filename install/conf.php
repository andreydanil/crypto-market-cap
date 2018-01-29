<?php
/**
 * conf.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

defined('INSTALLER_NAME') or die('Unauthorized access');

$FORM_DEFINITION = [
    'General Settings' => [
        ['id' => 'app_name', 'title' => 'Website name',],
        ['id' => 'app_url', 'title' => 'Website URL', 'value' => guess_app_url()],
        ['id' => 'theme', 'title' => 'Color Theme', 'type' => 'select', 'options' => ['blue' => 'Blue', 'green' => 'Green', 'purple' => 'Purple', 'red' => 'Red', 'cyan' => 'Cyan']],
        ['id' => 'ga_id', 'title' => 'Google Analytics tracking ID', 'help' => 'The tracking ID is a string like UA-000000-0'],
        ['id' => 'page_speed', 'title' => 'Enable Page-speed module?', 'type' => 'checkbox', 'checked' => false, 'help' => 'The page-speed module can automatically optimize your site'],
    ],
    'MySQL Database Server Settings' => [
        ['id' => 'sql_host', 'title' => 'Database Host', 'help' => 'You should be able to get this info from your web host, if localhost doesn\'t work '],
        ['id' => 'sql_port', 'title' => 'Port'],
        ['id' => 'sql_name', 'title' => 'Database Name', 'help' => 'The name of the database you want to install ' . INSTALLER_NAME . ' in'],
        ['id' => 'sql_user', 'title' => 'Username', 'help' => 'Your MySQL username'],
        ['id' => 'sql_pass', 'title' => 'Password', 'help' => 'Your MySQL password', 'type' => 'password'],
    ],
    'Administrative Account Details' => [
        ['id' => 'admin_email', 'title' => 'Administrator Email', 'help' => 'Email account that will receive messages from visitors'],
    ],
    'Forum Settings' => [
        ['id' => 'disqus_id', 'title' => 'Disqus Shortname', 'help' => 'Your Disqus.com unique registered shortname'],
    ],
    'Email Server Settings' => [
        ['id' => 'mail_host', 'title' => 'Email Server Host',],
        ['id' => 'mail_port', 'title' => 'Port'],
        ['id' => 'mail_user', 'title' => 'Username',],
        ['id' => 'mail_pass', 'title' => 'Password',],
        ['id' => 'mail_encr', 'title' => 'Encryption',],
    ],
    'Monetization Settings' => [
        ['id' => 'adsense_pub', 'title' => 'Google Adsense Publisher ID', 'help' => 'The Adsense Publisher ID is a string like pub-0000000000000000'],
        ['id' => 'adsense_slot1', 'title' => 'Adsense Slot #1 ID',],
        ['id' => 'adsense_slot2', 'title' => 'Adsense Slot #2 ID',],
        ['id' => 'changelly_id', 'title' => 'Changelly.com Affiliate ID', 'help' => 'Your <a href="https://changelly.com/affiliate" target="_blank">Changelly.com</a> affiliate ID'],
    ],
    'Donation Details' => [
        ['id' => 'donate_btc', 'title' => 'Bitcoin Wallet', 'help' => 'Your Bitcoin wallet to receive donations from visitors'],
        ['id' => 'donate_eth', 'title' => 'Ethereum Wallet', 'help' => 'Your Ethereum wallet'],
        ['id' => 'donate_ltc', 'title' => 'Litecoin Wallet', 'help' => 'Your Litecoin wallet'],
    ],
];

$_PERMISSIONS = [
    'bootstrap/cache/' => '0775',
    'storage/' => '0775',
    'storage/app/' => '0775',
    'storage/framework/' => '0775',
    'storage/logs/' => '0775',
];

$_EXTENSIONS = [
    'openssl' => 'OpenSSL',
    'pdo' => 'PDO',
    'mbstring' => 'Mbstring',
    'tokenizer' => 'Tokenizer',
    'JSON' => 'JSON',
    'cURL' => 'cURL',
];
