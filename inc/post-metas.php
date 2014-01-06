<?php 

/**
 * Add posts meta boxes. 
 */


// Add the Meta Box  
function add_post_details_meta_box() {  
    add_meta_box(  
        'post_meta_box', // $id  
        'Détails de l\'article', // $title   
        'show_post_meta_box', // $callback  
        'post', // $page  
        'normal', // $context  
        'high'); // $priority  
} 
add_action('add_meta_boxes', 'add_post_details_meta_box');  


// Field Array  
$prefix = 'postDetail_';  
$post_details_fields = array(  
    array(  
        'label'=> 'Texte court',  
        'desc'  => 'Pour page d\'accueil, listes, résultats recherche',  
        'id'    => $prefix.'shortText',  
        'type'  => 'textarea'  
    ),
    array(  
        'label'  => 'Code media',  
        'desc'  => '(vimeo/dailymotion/soundcloud)',  
        'id'    => $prefix.'mediaMarkup',  
        'type'  => 'textarea' 
    ),
    array(  
        'label'  => 'Ne pas afficher le visuel principal',  
        'desc'  => '(si code vidéo ou slide)',  
        'id'    => $prefix.'showPic',  
        'type'  => 'checkbox' 
    ),
    array(  
        'label'  => 'Mise en avant',  
        'desc'  => '(afficher en Une du Magazine)',  
        'id'    => $prefix.'featured',  
        'type'  => 'checkbox' 
    ),
    array(  
        'label'  => 'Image Portrait',  
        'desc'  => 'Image Portrait',  
        'id'    => $prefix.'portraitMedia',  
        'type'  => 'image' 
    )    
);  


// The Callback  
function show_post_meta_box() {  
global $post_details_fields, $post;  
// Use nonce for verification  
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
      
    // Begin the field table and loop  
    echo '<table class="form-table">';  
    foreach ($post_details_fields as $field) {  
        // get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // begin a table row with  
        echo '<tr> 
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
                <td>';  
                switch($field['type']) {  

                	// text  
					case 'text':  
					    echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /> 
					        <br /><span class="description">'.$field['desc'].'</span>';  
					break; 

					// textarea  
					case 'textarea':  
					    echo '<textarea name="'. $field['id'] .'" id="'. $field['id']. '" cols="60" rows="4">'. $meta .'</textarea> 
					        <br /><span class="description">'. $field['desc'] .'</span>';  
					break;  

					// checkbox  
					case 'checkbox':  
					    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/> 
					        <label for="'.$field['id'].'">'.$field['desc'].'</label>';  
					break;  					

					// select  
					case 'select':  
					    echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';  
					    foreach ($field['options'] as $option) {  
					        echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
					    }  
					    echo '</select><br /><span class="description">'.$field['desc'].'</span>';  
					break;

					// date
					case 'date':
						echo '<input type="date" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<br /><span class="description">'.$field['desc'].'</span>';
					break;			

					// repeatable text
					case 'repeatable-text':  
					    echo '<a class="repeatable-add button" href="#">+</a> 
					            <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';  
					    $i = 0;  
					    if ($meta) {  
					        foreach($meta as $row) {  
					            echo '<li><span class="sort hndle">|||</span> 
					                        <input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" /> 
					                        <a class="repeatable-remove button" href="#">-</a></li>';  
					            $i++;  
					        }  
					    } else {  
					        echo '<li><span class="sort hndle">|||</span> 
					                    <input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="30" /> 
					                    <a class="repeatable-remove button" href="#">-</a></li>';  
					    }  
					    echo '</ul> 
					        <span class="description">'.$field['desc'].'</span>';  
					break;  

                    // image  
                    case 'image':  
                        $image = get_template_directory_uri().'/images/image.png';    
                        echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';  
                        if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium'); $image = $image[0]; }                 
                        echo    '<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" /> 
                                    <img src="'.$image.'" class="custom_preview_image" alt="" /><br /> 
                                        <input class="custom_upload_image_button button" type="button" value="Choose Image" /> 
                                        <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small> 
                                        <br clear="all" /><span class="description">'.$field['desc'].'';  
                    break;

                } //end switch  
        echo '</td></tr>';  
    } // end foreach  
    echo '</table>'; // end table  
}  


// Save the Data  
function save_post_meta($post_id) {  
    global $post_details_fields;  
      
    // verify nonce  
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // check permissions  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
      
    // loop through fields and save the data  
    foreach ($post_details_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_post_meta');    







