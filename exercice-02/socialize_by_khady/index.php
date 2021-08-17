<?php

/**
 * Plugin Name:         Socialize_by_Khady
 * Description:         Social media Widget to display links to social media networks website. hope you like my app!
 * Version:             0.1
 * Author:              apprentice_KHADY_GUEYE
 */


 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action("admin_menu","addMenu");


function addMenu(){
    // get user name
    global $current_user;
    wp_get_current_user();
    $user="jbkjb";

    // add a menu to the admin page
    add_menu_page( "socialize", "socialize", "manage_options", "socialize_settings", "settingMenu");
}




//socialize setting menu 

function settingMenu(){
    echo "<h1>Welcome !</h1>";
    echo "<p>Here You can share the links to your social media networks. Feel free to fill in the form and include this shortcode : [show_social_network] on your webpage</p>";
    echo "<p style:'margin-top:5%'>Your current saved settings:</p>";

    //get already saved links
    $options=[get_option( "my_twitter_link"),get_option( "my_facebook_link"),get_option( "my_pinterest_link"),get_option( "my_instagram_link")];
    

    $settings_saved.="<table>";
    $settings_saved.="<tr><th><p style='color:#888888'>Your twitter: </p></th>";
    $settings_saved.="<th>".$options[0] ."</th></tr>";
    $settings_saved.="<tr><th><p  style='color:#888888'>Your Facebook: </p></th>";
    $settings_saved.="<th>".$options[1]."</th></tr>";
    $settings_saved.="<tr><th><p  style='color:#888888'>Your Pinterest: </p></th>";
    $settings_saved.="<th>".$options[2]."</th></tr>";
    $settings_saved.="<tr><th><p  style='color:#888888'>Your Instagram: </p></th>";
    $settings_saved.="<th>".$options[3]."</th></tr>";
    $settings_saved.="</table>";

    echo $settings_saved;

    


    //form to fill for social media links 

    $form.="<form method='POST' action=''>";
    $form.="<table style='width:50%;margin:3% auto'>";
    $form.="<tr><th><label style='color:#888888'>Your twitter: </label></th>";
    $form.="<th><input type='text' name='twitter' placeholder='Help us find you on Twitter' width='50px' height='30px'/></th></tr>";
    $form.="<tr><th><label  style='color:#888888'>Your Facebook: </label></th>";
    $form.="<th><input type='text' name='facebook' placeholder='Help us find you on Facebook'/></th></tr>";
    $form.="<tr><th><label  style='color:#888888'>Your Pinterest: </label></th>";
    $form.="<th><input type='text' name='pinterest' placeholder='Help us find you on Pinterest'/></th></tr>";
    $form.="<tr><th><label  style='color:#888888'>Your Instagram: </label></th>";
    $form.="<th><input type='text' name='instagram' placeholder='Help us find you on Instagram'/></th></tr>";
    $form.="</table>";
    //submit button
    $form.="<input type='submit' name='submit' value='submit' style='margin-left:2%;background-color:#1B065E;border:none;font-size:0.7em;color:#fff;padding:1% 4%'/>";
    $form.="</form>";

    echo $form;
    get_links_from_form();
}



//Form data handler

function get_links_from_form(){

    if(isset($_POST['submit'])){
        echo "<meta http-equiv='refresh' content='0'>";
        
// get the form values
        $twitter= $_POST['twitter'];
        $facebook=$_POST['facebook'];
        $pinterest=$_POST['pinterest'];
        $instagram=$_POST['instagram'];

        echo $twitter;

//save to databade : TWITTER
        if(get_option( "my_twitter_link")){
            if($twitter!=""){
                $result.=update_option( "my_twitter_link", $twitter);
            }
        }else{
            $result.=add_option( "my_twitter_link", $twitter);
        }
        
//save to databade : FACEBOOK
        if(get_option( "my_facebook_link")){
            if($facebook!=""){
                $result.=update_option( "my_facebook_link", $facebook);
            }
        }else{
            $result.=add_option( "my_facebook_link", $facebook);
        }

//save to databade : PINTEREST
        if(get_option( "my_pinterest_link")){
            if($pinterest!=""){
                $result.=update_option( "my_pinterest_link", $pinterest);
            }
        }else{
            $result.=add_option( "my_pinterest_link", $pinterest);
        }
       
//save to databade : INSTAGRAM
        if(get_option( "my_instagram_link")){
            if($instagram!=""){
                $result.=update_option( "my_instagram_link", $instagram);
            }
        }else{
            $result.=add_option( "my_instagram_link", $instagram);
        }

        echo $result;
        echo "Saved!";
  
    }
}
add_action( 'wp_head','get_links_from_form');






//socialize print on page function

function socialize(){


         // social netword input variables
         $twitterbutton = get_option( "my_twitter_link");
         $facebookbutton = get_option( "my_facebook_link");
         $pinterestbutton = get_option( "my_pinterest_link");
         $instagrambutton = get_option( "my_instagram_link");

    
        // sharing button showing on page
        $content .= '<div>';
        $content .= 'Find me on Twitter: <a href="'. $twitterbutton .'" target="_blank">'.$twitterbutton.'</a> <br/>';
        $content .= 'Find me on Facebook: <a href="'.$facebookbutton.'" target="_blank">'.$facebookbutton.'</a><br/>';
        $content .= 'Find me on Pinterest: <a href="'.$pinterestbutton.'" target="_blank">'.$pinterestbutton.'</a><br/>';
        $content .= 'Find me on Instagram:  <a href="'.$instagrambutton.'" target="_blank">'.$instagrambutton.'</a><br/>';
        $content .= '</div>';
        
        return $content;
}

// This will create a wordpress shortcode .
add_shortcode('show_social_network','socialize');

?>