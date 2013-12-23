<?php 

/**
 * Add events meta boxes. 
 */


// Add the Meta Box  
function add_event_details_meta_box() {  
    add_meta_box(  
        'custom_meta_box', // $id  
        'Détails de l\'événement', // $title   
        'show_custom_meta_box', // $callback  
        'event', // $page  
        'normal', // $context  
        'high'); // $priority  
} 
add_action('add_meta_boxes', 'add_event_details_meta_box');  


// Field Array  
$prefix = 'eventDetail_';  
$event_details_fields = array(  
    array(  
        'label'=> 'Texte court',  
        'desc'  => 'Pour page d\'accueil, listes, résultats recherche',  
        'id'    => $prefix.'shortText',  
        'type'  => 'textarea'  
    ),
    array(  
        'label'=> 'Texte complémentaire',  
        'desc'  => 'Texte en bas des infos pratiques (dates, durée...)',  
        'id'    => $prefix.'text2',  
        'type'  => 'textarea'  
    ),  
    array(  
        'label'=> 'Distribution',  
        'desc'  => '',  
        'id'    => $prefix.'distribution',  
        'type'  => 'textarea'  
    ),  
    array(  
        'label'=> 'Mentions de production',  
        'desc'  => '',  
        'id'    => $prefix.'mentions',  
        'type'  => 'textarea'  
    ),  
    array(  
        'label'=> 'Durée',  
        'desc'  => '',  
        'id'    => $prefix.'duration',  
        'type'  => 'text'  
    ), 
    array(  
        'label'=> 'Dates',  
        'desc'  => 'Dates en texte plein. Exemple : Les 4 et 6 janvier 2014.',  
        'id'    => $prefix.'dates',  
        'type'  => 'text' 
    ),
    array(  
        'label' => 'Première date et Heure de représentation',  
        'desc'  => 'Renseigner la date et horaire au format 20.05.2014 20:00',  
        'id'    => $prefix.'first_date',  
        'type'  => 'text-date'  
    ),
    array(  
        'label' => 'Dernière date et Heure de représentation',  
        'desc'  => 'Laisser vide si une seule date (à la sauvegarde, cette date sera identique à la première date)',  
        'id'    => $prefix.'last_date',  
        'type'  => 'text-date'  
    ),
    array( 
	    'label' => 'Autres Dates et Horaires de représentation',  
	    'desc'  => 'Ajouter chaque date et horaire au format 20.05.2014 20:00',  
	    'id'    => $prefix.'otherdates',  
	    'type'  => 'repeatable'  
	),
    array(  
        'label'=> 'Lien revendeur',  
        'desc'  => 'Lien vers l\'achat billet, avec le http://....',  
        'id'    => $prefix.'dealer-link',  
        'type'  => 'text' 
    ),
    array(  
        'label'=> 'Nom revendeur',  
        'desc'  => 'Digitiket / FNAC / etc.',  
        'id'    => $prefix.'dealer-name',  
        'type'  => 'text' 
    ),
    array(  
        'name'  => 'Image Portrait',  
        'desc'  => 'Emplacement affiche dans la page de l\'événement',  
        'id'    => $prefix.'portraitMedia',  
        'type'  => 'image' 
    )
);  


// The Callback  
function show_custom_meta_box() {  
global $event_details_fields, $post;  
// Use nonce for verification  
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
      
    // Begin the field table and loop  
    echo '<table class="form-table">';  
    foreach ($event_details_fields as $field) {  
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

                    // text-date  
                    case 'text-date':
                        if ($meta) {
                            $clean_date = date("d.m.Y G:i", $meta );
                            echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$clean_date.'" size="30" /> 
                            <br /><span class="description">'.$field['desc'].'</span>'; 
                        } else {
                        echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="" size="30" /> 
                            <br /><span class="description">'.$field['desc'].'</span>';
                        }
                    break; 

                    // repeatable  
                    case 'repeatable':
                        echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';  
                        $i = 0; 
                        if ($meta) {  
                            foreach($meta as $row) {
                                $clean_date = date("d.m.Y G:i", $row );
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
                        echo '</ul>';
                        echo '<a class="repeatable-add button" href="#">+</a>  |  ';  
                        echo '<span class="description">'.$field['desc'].'</span>'; 

                    break; 




                    // textarea  
					case 'textarea':  
					    echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea> 
					        <br /><span class="description">'.$field['desc'].'</span>';  
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

                    // image  
                    case 'image':  
                        // $image = get_template_directory_uri().'/images/image.png';    
                        // echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';  
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
function save_custom_meta($post_id) {  
    global $event_details_fields;  
      
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
    foreach ($event_details_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']]; 
        if ($new && $new != $old) {
            if ( $field['id'] == 'eventDetail_first_date' ) {
                $updatefirstdate = strtotime( $new );
                update_post_meta($post_id, $field['id'], $updatefirstdate );
            }
            elseif( $field['id'] == 'eventDetail_last_date' ) {
                $updatelastdate = strtotime( $new );
                update_post_meta($post_id, $field['id'], $updatelastdate );
            }
            elseif( $field['id'] == 'eventDetail_otherdates' ) {
               update_post_meta($post_id, $field['id'], $new); 
            }
            else {
                update_post_meta($post_id, $field['id'], $new); 
            }
        } elseif ('' == $new && !$old ) {
            if( $field['id'] == 'eventDetail_last_date' ) {
                $firstdate = $_POST[ $event_details_fields[6]['id'] ];
                // exit( var_dump( $event_details_fields[6]['id'] ) );
                $updatefirstdate = strtotime( $firstdate );
                update_post_meta($post_id, $field['id'], $updatefirstdate );
            }
        } elseif ('' == $new && $old) { 
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_custom_meta');    










