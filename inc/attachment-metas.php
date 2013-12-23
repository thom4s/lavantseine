<?php 
/**
 * Add custom media metadata fields
 *
 * Be sure to sanitize your data before saving it
 * http://codex.wordpress.org/Data_Validation
 *
 * @param $form_fields An array of fields included in the attachment form
 * @param $post The attachment record in the database
 * @return $form_fields The final array of form fields to use
 */
function add_image_attachment_fields_to_edit( $form_fields, $post ) {
    
    // Remove the "Description" field, we're not using it
    unset( $form_fields['post_content'] ); 
    
    // Add description text (helps) to the "Title" field
    $form_fields['post_title']['helps'] = 'Use a descriptive title for the image. This will make it easy to find the image in the future and will improve SEO.';
        
    // Re-order the "Caption" field by removing it and re-adding it later
    $form_fields['post_excerpt']['helps'] = 'Describe the significants of the image pertaining to the site.';
    $caption_field = $form_fields['post_excerpt'];
    unset($form_fields['post_excerpt']);
    
    // Re-order the "File URL" field
    $image_url_field = $form_fields['image_url'];
    unset($form_fields['image_url']);
  
 
    // Add a Credit field
    $form_fields["media_tag"] = array(
        "label" => __("media tag"),
        "input" => "text", // this is default if "input" is omitted
        "value" => get_post_meta($post->ID, "_media_tag", true) ,
        "helps" => __("pour slide ou diaporama"),
    );
    
    // Add Caption before Credit field 
    $form_fields['image_url'] = $image_url_field;
    
    return $form_fields;
}
add_filter("attachment_fields_to_edit", "add_image_attachment_fields_to_edit", 10, 2);







/**
 * Save custom media metadata fields
 *
 * Be sure to validate your data before saving it
 * http://codex.wordpress.org/Data_Validation
 *
 * @param $post The $post data for the attachment
 * @param $attachment The $attachment part of the form $_POST ($_POST[attachments][postID])
 * @return $post
 */
function add_image_attachment_fields_to_save( $post, $attachment ) {
    if ( isset( $attachment['media_tag'] ) )
        update_post_meta( $post['ID'], '_media_tag', esc_attr($attachment['media_tag']) );
        
    return $post;
}
add_filter("attachment_fields_to_save", "add_image_attachment_fields_to_save", 10 , 2);







