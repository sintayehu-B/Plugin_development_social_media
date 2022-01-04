function social_media_share_page()
{
      <div class="wrap">
         <h1>Social Sharing Options</h1>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("social_share_config_section");
 
               do_settings_sections("SocialMediaShare");
                
               submit_button(); 
            ?>
         </form>
      </div>
}
