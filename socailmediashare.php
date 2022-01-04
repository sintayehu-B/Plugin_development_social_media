<?php

/*
Plugin Name: Social Media Share
Plugin URI: https://github.com/sintayehu-B/plugin_dev
Description: Displays Social Share icons below every post
Version: 1.0.0
Author: Sintayehu Sermessa
Author URI : https://github.com/sintayehu-B
*/

defined('ABSPATH') or die("The plugin you trying to access is not here bro :) ");

if(!defined('ABSPATH')){
    exit;
}

// adding social media item

function social_menu_item(){
    add_submenu_page("options-general.php", "Social Share", "Social media Share", "manage_options", "SocialMediaShare", "social_media_share_page");
}

// adding hook to the function
add_action("admin_menu", "social_menu_item");
