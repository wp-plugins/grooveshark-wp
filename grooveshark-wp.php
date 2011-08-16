<?php
/*
Plugin Name: Grooveshark WP
Plugin URI: http://plugins.jrseoservices.com/grooveshark-wp-plugin
Description: Displays your recent Grooveshark plays as a widget.
Version: 1.0.1
Author: JR SEO
Author URI: http://www.jrseoservices.com
*/

/*  Copyright 2011 JR SEO - support@jrseoservices.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'grooveshark_wp_add_pages');

// action function for above hook
function grooveshark_wp_add_pages() {
    add_options_page('Grooveshark WP', 'Grooveshark WP', 'administrator', 'grooveshark_wp', 'grooveshark_wp_options_page');
}

// grooveshark_wp_options_page() displays the page content for the Test Options submenu
function grooveshark_wp_options_page() {

    // variables for the field and option names 
    $opt_name = 'mt_Grooveshark_account';
    $opt_name_2 = 'mt_Grooveshark_limit';
	$opt_name_3 = 'mt_Grooveshark_query';
	$opt_name_4 = 'mt_Grooveshark_title2';
    $opt_name_5 = 'mt_Grooveshark_plugin_support';
    $opt_name_6 = 'mt_Grooveshark_title';
    $opt_name_9 = 'mt_Grooveshark_cache';
    $hidden_field_name = 'mt_Grooveshark_submit_hidden';
    $data_field_name = 'mt_Grooveshark_account';
    $data_field_name_2 = 'mt_Grooveshark_limit';
	$data_field_name_3 = 'mt_Grooveshark_query';
	$data_field_name_4 = 'mt_Grooveshark_title2';
    $data_field_name_5 = 'mt_Grooveshark_plugin_support';
    $data_field_name_6 = 'mt_Grooveshark_title';
    $data_field_name_9 = 'mt_Grooveshark_cache';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
    $opt_val_2 = get_option($opt_name_2);
	$opt_val_3 = get_option($opt_name_3);
	$opt_val_4 = get_option($opt_name_4);
    $opt_val_5 = get_option($opt_name_5);
    $opt_val_6 = get_option($opt_name_6);
    $opt_val_9 = get_option($opt_name_9);
   
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
        $opt_val_2 = $_POST[$data_field_name_2];
		$opt_val_3 = $_POST[$data_field_name_3];
		$opt_val_4 = $_POST[$data_field_name_4];
        $opt_val_5 = $_POST[$data_field_name_5];
        $opt_val_6 = $_POST[$data_field_name_6];
        $opt_val_9 = $_POST[$data_field_name_9];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name_2, $opt_val_2 );
		update_option( $opt_name_3, $opt_val_3 );
		update_option( $opt_name_4, $opt_val_4 );
        update_option( $opt_name_5, $opt_val_5 );
        update_option( $opt_name_6, $opt_val_6 ); 
        update_option( $opt_name_9, $opt_val_9 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Grooveshark WP Plugin Options', 'mt_trans_domain' ) . "</h2>";

    // options form
   
    $change3 = get_option("mt_Grooveshark_plugin_support");
    $change6 = get_option("mt_Grooveshark_cache");

if ($change3=="Yes" || $change3=="") {
$change3="checked";
$change31="";
} else {
$change3="";
$change31="checked";
}

if ($change5=="user" || $change5=="") {
$change5="checked";
$change51="";
} else {
$change5="";
$change51="checked";
}

    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Widget Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_6; ?>" value="<?php echo $opt_val_6; ?>" size="50">
</p><hr />

<p><?php _e("Grooveshark Username:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p><?php _e("Number of plays to Show:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_2; ?>" value="<?php echo $opt_val_2; ?>" size="3">
</p><hr />

<p><?php _e("Show Plugin Support?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change3; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change31; ?>>No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
</div>
<?php
 
}

function show_Grooveshark_user($args) {

extract($args);

  $widget_title = get_option("mt_Grooveshark_title"); 
  $max_tracks = get_option("mt_Grooveshark_limit");  
  $optionGrooveshark = get_option("mt_Grooveshark_account");
  $supportplugin = get_option("mt_Grooveshark_plugin_support"); 
  $optionGroovesharkcache = get_option("mt_Grooveshark_cache");
  $Groovesharkquery = get_option("mt_Grooveshark_query");

$widget_title=str_replace("%user%", $optionGrooveshark, $widget_title);

if ($widget_title=="") {
$widget_title="Grooveshark Plays";
}

include_once(ABSPATH . WPINC . '/rss.php');

$docload=fetch_rss('http://api.grooveshark.com/feeds/1.0/users/'.$optionGrooveshark.'/recent_listens.rss');

$items = array_slice($docload->items, 0, $max_tracks);

  $i = 1;

$Groovesharkdisp="";

  $Groovesharkdisp .= $before_title; 

  $Groovesharkdisp .= $widget_title.$after_title."<br />".$before_widget."<ul>";

foreach ($items as $item) :
    $Groovesharkdisp .= '<li><a rel="nofollow" href="'.$item['link'].'">'.$item['title'].'</a></li><br />';

endforeach;

  $Groovesharkdisp .= "</ul>";
  
if ($supportplugin=="Yes" || $supportplugin=="") {
$Groovesharkdisp .= "<p style='font-size:x-small'>Grooveshark Plugin made by <a href='http://www.open-office-download.net'>Open Office</a>.</p>";
}

$Groovesharkdisp .= $after_widget;

echo $Groovesharkdisp;

}

function init_Grooveshark_widget() {
register_sidebar_widget("Grooveshark WP Recent Plays", "show_Grooveshark_user");
}

add_action("plugins_loaded", "init_Grooveshark_widget");

?>
