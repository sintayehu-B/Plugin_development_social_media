<?php

/*
Plugin Name: Social Media Share
Plugin URI: https://github.com/sintayehu-B/Plugin_development_social_media
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

// creating an optional page

function social_media_share_page()
{
   ?>
      <div class="wrap">
         <h1>Social Sharing Options</h1>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("SocialMediaShare_config_section");
 
               do_settings_sections("SocialMediaShare");
                
               submit_button(); 
            ?>
         </form>
      </div>
   <?php
}

// adding configuration section

function SocialMediaShare_settings()
{
    add_settings_section("SocialMediaShare_config_section", "", null, "SocialMediaShare");
 
    add_settings_field("SocialMediaShare-facebook", "Do you want to display Facebook share button?", "SocialMediaShare_facebook_checkbox", "SocialMediaShare", "SocialMediaShare_config_section");
    add_settings_field("SocialMediaShare-twitter", "Do you want to display Twitter share button?", "SocialMediaShare_twitter_checkbox", "SocialMediaShare", "SocialMediaShare_config_section");
    add_settings_field("SocialMediaShare-linkedin", "Do you want to display LinkedIn share button?", "SocialMediaShare_linkedin_checkbox", "SocialMediaShare", "SocialMediaShare_config_section");
    add_settings_field("SocialMediaShare-reddit", "Do you want to display Reddit share button?", "SocialMediaShare_reddit_checkbox", "SocialMediaShare", "SocialMediaShare_config_section");
    add_settings_field("SocialMediaShare-telegram", "Do you want to display Telegram share button?", "SocialMediaShare_telegram_checkbox", "SocialMediaShare", "SocialMediaShare_config_section");
 
    register_setting("SocialMediaShare_config_section", "SocialMediaShare-facebook");
    register_setting("SocialMediaShare_config_section", "SocialMediaShare-twitter");
    register_setting("SocialMediaShare_config_section", "SocialMediaShare-linkedin");
    register_setting("SocialMediaShare_config_section", "SocialMediaShare-reddit");
    register_setting("SocialMediaShare_config_section", "SocialMediaShare-telegram");
}
 
// adding facebook checkbox

function SocialMediaShare_facebook_checkbox()
{  
   ?>
        <input type="checkbox" name="SocialMediaShare-facebook" value="1" <?php checked(1, get_option('SocialMediaShare-facebook'), true); ?> /> Check for Yes
   <?php
}

// adding twitter checkbox

function SocialMediaShare_twitter_checkbox()
{  
   ?>
        <input type="checkbox" name="SocialMediaShare-twitter" value="1" <?php checked(1, get_option('SocialMediaShare-twitter'), true); ?> /> Check for Yes
   <?php
}

// adding linkedin checkbox

function SocialMediaShare_linkedin_checkbox()
{  
   ?>
        <input type="checkbox" name="SocialMediaShare-linkedin" value="1" <?php checked(1, get_option('SocialMediaShare-linkedin'), true); ?> /> Check for Yes
   <?php
}

// adding reddit_checkbox

function SocialMediaShare_reddit_checkbox()
{  
   ?>
        <input type="checkbox" name="SocialMediaShare-reddit" value="1" <?php checked(1, get_option('SocialMediaShare-reddit'), true); ?> /> Check for Yes
   <?php
}
 
add_action("admin_init", "SocialMediaShare_settings");

// adding telegram checkbox

function SocialMediaShare_telegram_checkbox(){
    ?>
        <input type="checkbox" name="SocialMediaShare-telegram" value="1" <?php checked(1, get_option('SocialMediaShare-telegram'), true); ?> /> Check for Yes
   <?php

}

add_action("admin_init", "SocialMediaShare_telegram_checkbox");

// adding social media share icon
