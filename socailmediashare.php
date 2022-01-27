<?php

/*
Plugin Name: Social Media Share
Plugin URI: https://github.com/sintayehu-B/Plugin_development_social_media
Description: Displays Social Share icons below every post
Version: 1.0.0
Author: Sintayehu Sermessa
Author URI : https://github.com/sintayehu-B
*/
//  denying direct access to the php file 
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
    add_settings_field("SocialMediaShare-instagram", "Do you want to display instagram share button?", "SocialMediaShare_instagram_checkbox", "SocialMediaShare", "SocialMediaShare_config_section");
 
    register_setting("SocialMediaShare_config_section", "SocialMediaShare-facebook");
    register_setting("SocialMediaShare_config_section", "SocialMediaShare-twitter");
    register_setting("SocialMediaShare_config_section", "SocialMediaShare-linkedin");
    register_setting("SocialMediaShare_config_section", "SocialMediaShare-reddit");
    register_setting("SocialMediaShare_config_section", "SocialMediaShare-telegram");
    register_setting("SocialMediaShare_config_section", "SocialMediaShare-instagram");
}
 
// adding facebook checkbox

function SocialMediaShare_facebook_checkbox()
{  
   ?>
        <input type="checkbox" name="SocialMediaShare-facebook" value="1" <?php checked(1, get_option('SocialMediaShare-facebook'), true); ?> /> Enable
   <?php
}

// adding twitter checkbox

function SocialMediaShare_twitter_checkbox()
{  
   ?>
        <input type="checkbox" name="SocialMediaShare-twitter" value="1" <?php checked(1, get_option('SocialMediaShare-twitter'), true); ?> /> Enable
   <?php
}

// adding linkedin checkbox

function SocialMediaShare_linkedin_checkbox()
{  
   ?>
        <input type="checkbox" name="SocialMediaShare-linkedin" value="1" <?php checked(1, get_option('SocialMediaShare-linkedin'), true); ?> /> Enable
   <?php
}

// adding reddit_checkbox

function SocialMediaShare_reddit_checkbox()
{  
   ?>
        <input type="checkbox" name="SocialMediaShare-reddit" value="1" <?php checked(1, get_option('SocialMediaShare-reddit'), true); ?> /> Enable
   <?php
}
 
add_action("admin_init", "SocialMediaShare_settings");

// adding telegram checkbox

function SocialMediaShare_telegram_checkbox(){
    ?>
        <input type="checkbox" name="SocialMediaShare-telegram" value="1" <?php checked(1, get_option('SocialMediaShare-telegram'), true); ?> /> Enable
   <?php

}

add_action("admin_init", "SocialMediaShare_telegram_checkbox");

// adding instagram checkbox

function SocialMediaShare_instagram_checkbox(){
    ?>
        <input type="checkbox" name="SocialMediaShare-instagram" value="1" <?php checked(1, get_option('SocialMediaShare-instagram'), true); ?> /> Enable
   <?php

}

add_action("admin_init", "SocialMediaShare_instagram_checkbox");

// adding social media share icon

function add_SocialMediaShare_icons($content)
{
    $html = "<div class='SocialMediaShare-wrapper'><div class='share-on'>Share on: </div>";

    global $post;

    $url = get_permalink($post->ID);
    $url = esc_url($url);

    if(get_option("SocialMediaShare-facebook") == 1)
    {
        $html = $html . "<div class='facebook'><a target='_blank' href='http://www.facebook.com/sharer.php?u=" . $url . "'><i class='fab fa-facebook'></i> </a></div>";
    }

    if(get_option("SocialMediaShare-twitter") == 1)
    {
        $html = $html . "<div class='twitter'><a target='_blank' href='https://twitter.com/share?url=" . $url . "'><i class='fab fa-twitter'></i></a></div>";
    }

    if(get_option("SocialMediaShare-linkedin") == 1)
    {
        $html = $html . "<div class='linkedin'><a target='_blank' href='https://www.linkedin.com/shareArticle?mini=true&url=" . $url . "'> <i class='fab fa-linkedin-in'></i></a></div>";
    }

    if(get_option("SocialMediaShare-reddit") == 1)
    {
        $html = $html . "<div class='reddit'><a target='_blank' href='http://reddit.com/submit?url=" . $url . "'><i class='fab fa-reddit-alien'></i></a></div>";
    }
    if(get_option("SocialMediaShare-telegram") == 1)
    {
        $html = $html . "<div class='telegram'><a target='_blank' href='https://telegram.me/share/url?url=<URL>" . $url . "'><i class='fab fa-telegram-plane'></i></a></div>";
    }
    if(get_option("SocialMediaShare-instagram") == 1)
    {
        $html = $html . "<div class='instagram'><a target='_blank' href='http://instagram.com/share/url?url=<URL>" . $url . "'> <i class='fab fa-instagram'></i> </div>";
        
    }

    $html = $html . "<div class='clear'></div></div>";

    return $content = $content . $html;
}

add_filter("the_content", "add_SocialMediaShare_icons");

// connecting css file

function social_media_share_style() 
{
    wp_register_style("social_media_share_style-file", plugin_dir_url(__FILE__) . "/css/style.css");
    wp_register_style("social_media_share_style-file", plugin_dir_url(__FILE__) . "/css/font-awesome/css/font-awesome.css");
    
    wp_enqueue_style("social_media_share_style-file");
}

add_action("wp_enqueue_scripts", "social_media_share_style");