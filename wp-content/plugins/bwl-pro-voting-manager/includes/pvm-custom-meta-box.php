<?php

 /*------------------------------  Custom Meta Box Section ---------------------------------*/

class PVM_Meta_Box {
    
    function __construct( $custom_fields ) {
        
        $this->custom_fields  = $custom_fields; //Set custom field data as global value.

        add_action( 'add_meta_boxes', array( &$this, 'pvm_metaboxes' ) );
        
        add_action( 'save_post', array( &$this, 'save_pvm_meta_box_data' ) ); 
        
    }
            
    
    //Custom Meta Box.
    
    function pvm_metaboxes() {
        
        $bwl_cmb_custom_fields = $this->custom_fields;

        // First parameter is meta box ID.
        // Second parameter is meta box title.
        // Third parameter is callback function.
        // Last paramenter must be same as post_type_name
        
        add_meta_box(
            $bwl_cmb_custom_fields['meta_box_id'],
            $bwl_cmb_custom_fields['meta_box_heading'],
            array( &$this, 'show_meta_box' ),
            $bwl_cmb_custom_fields['post_type'],            
            $bwl_cmb_custom_fields['context'], 
            $bwl_cmb_custom_fields['priority']
        );

    }

    function show_meta_box( $post ) {
        
        $bwl_cmb_custom_fields = $this->custom_fields;
        
        foreach( $bwl_cmb_custom_fields['fields'] as $custom_field ) :

            $field_value = get_post_meta($post->ID, $custom_field['id'], true);
       
        ?>

            <?php if( $custom_field['type'] == 'text' ) : ?>

            <p>
                <label for="<?php echo $custom_field['id']?>"><?php echo $custom_field['title']?>: </label>
                <input type="<?php echo $custom_field['type']?>" id="<?php echo $custom_field['id']?>" name="<?php echo $custom_field['name']?>" class="<?php echo $custom_field['class']?>" value="<?php echo esc_attr($field_value); ?>"/>
            </p>
            
            <?php endif; ?>
            
            <?php if( $custom_field['type'] == 'select' ) : ?>
            
                <?php 
                
                    $values = get_post_custom( $post->ID );
                    
                    $selected = isset( $values[$custom_field['name']] ) ? esc_attr( $values[$custom_field['name']][0] ) : $custom_field['default_value'];
 
                ?>
            
                <p> 
                    <label for="<?php echo $custom_field['id']?>"><?php echo $custom_field['title']?>: </label> 
                    <select name="<?php echo $custom_field['name']?>" id="<?php echo $custom_field['id']?>"> 
                        
                        <option value="" selected="selected">- Select -</option>
                        
                        <?php foreach( $custom_field['value'] as $key => $value ) : ?>
                            <option value="<?php echo $key ?>" <?php selected( $selected, $key ); ?> ><?php echo $value; ?></option> 
                        <?php endforeach; ?>
                        
                    </select> 
                </p> 

            <?php endif; ?>
            
            <?php if( $custom_field['type'] == 'checkbox' ) : ?>
            
                <p> 
                    <input type="checkbox" id="my_meta_box_check" name="my_meta_box_check" <?php checked($check, 'on'); ?> />  
                    <label for="my_meta_box_check">Do not check this</label>  
                </p>  
            
             <?php endif; ?>
                
                
             <?php if( $custom_field['type'] == 'pvm_custom' ) : ?>
            
                <p> 
                   <label for="<?php echo $custom_field['title']?>"><?php echo $custom_field['title']?>: </label> 
                   
                   <?php 
                   
                    global $post;
                   
                    $pvm_feedback_message_unique_id = 'pvm_feedback_list_'.$post->ID; // so idea is we are going to add post id after vairable name
         
                    $prev_pvm_feedback_message = get_post_meta( $post->ID, $pvm_feedback_message_unique_id );


                    if( isset($prev_pvm_feedback_message[0]) ) {

                       $prev_pvm_feedback_message_counter = sizeof($prev_pvm_feedback_message[0]);

                    } else {

                       $prev_pvm_feedback_message_counter = 0; 

                    }
                   
                   ?>
                   
                   <?php if( $prev_pvm_feedback_message_counter != 0 ) : ?>
                   
                   <ol>
                       <?php foreach ( $prev_pvm_feedback_message[0] as $feedback_message ) :?>
                       
                       <li><?php echo $feedback_message; ?></li>                        
                       
                       <?php endforeach;?>
                   </ol>
                
                    <?php else: ?>
                        <p>No Feedback Message Found!</p>
                    <?php endif; ?>
                </p>  
            
             <?php endif; ?>   

        <?php
        
            endforeach;
            
    }        

    function save_pvm_meta_box_data( $id ) {
        
        global $post;
        
         if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){   
            
             return $post_id;  
             
         } else {
        
            $tbd_testimonials_custom_fields = $this->custom_fields;

            foreach( $tbd_testimonials_custom_fields['fields'] as $custom_field ) {

                if ( isset( $_POST[$custom_field['name']] ) ) {
                    
                    update_post_meta($id, $custom_field['name'], strip_tags( $_POST[$custom_field['name']] ));

                }

            }
         }
        
    }
     
}

// Register Custom Meta Box For BWL Pro Related Post Manager

function bwl_pvm_custom_meta_init() {
    
     
    $bpvm_custom_post_types = bpvm_get_all_post_types();
 
    foreach ($bpvm_custom_post_types as $bpvm_custom_post_types_key => $bpvm_custom_post_types_value ) {

        $custom_fields= array(

            'meta_box_id'           => 'cmb_bwl_pvm', // Unique id of meta box.
            'meta_box_heading'  => 'BWL Pro Voting Manager Settings', // That text will be show in meta box head section.
            'post_type'               => $bpvm_custom_post_types_value, // define post type. go to register_post_type method to view post_type name.        
            'context'                   => 'normal',
            'priority'                    => 'high',
            'fields'                       => array(
                                                        'bwl_pvm_display_status'  => array(
                                                                                    'title'      => __( 'Display Voting Box: ', 'bwl-pro-voting-manager'),
                                                                                    'id'         => 'bwl_pvm_display_status',
                                                                                    'name'    => 'bwl_pvm_display_status',
                                                                                    'type'      => 'select',
                                                                                    'value'     => array(
                                                                                                            '0' => __('Hide', 'bwl-pro-voting-manager'),
                                                                                                            '1' => __('Show', 'bwl-pro-voting-manager'),
                                                                                                            '2' => __('Voting Closed', 'bwl-pro-voting-manager'),
                                                                                                        ),
                                                                                    'default_value' => 1,
                                                                                    'class'      => 'widefat'
                                                                                ),
                
                                                           'bwl_pvm_voting_bar_type'  => array(
                                                                                    'title'      => __( 'Voting Bar Type: ', 'bwl-pro-voting-manager'),
                                                                                    'id'         => 'bwl_pvm_voting_bar_type',
                                                                                    'name'    => 'bwl_pvm_voting_bar_type',
                                                                                    'type'      => 'select',
                                                                                    'value'     => array(
                                                                                                            '0' => __('Static', 'bwl-pro-voting-manager'),
                                                                                                            '1' => __('Animated', 'bwl-pro-voting-manager')
                                                                                                        ),
                                                                                    'default_value' => 0,
                                                                                    'class'      => 'widefat'
                                                                                ),    
                
                                                            'bwl_pvm_like_bar_theme'  => array(
                                                                                    'title'      => __( 'Like Bar Theme: ', 'bwl-pro-voting-manager'),
                                                                                    'id'         => 'bwl_pvm_like_bar_theme',
                                                                                    'name'    => 'bwl_pvm_like_bar_theme',
                                                                                    'type'      => 'select',
                                                                                    'value'     => array(
                                                                                                            'animated_red_theme' => __('Red Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_blue_theme' => __('Blue Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_green_theme' => __('Green Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_orange_theme' => __('Orange Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_pink_theme' => __('Pink Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_yellow_theme' => __('Yellow Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_yellow_green_theme' => __('Yellow Green Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_brown_theme' => __('brown Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_chocolate_theme' => __('Chocolate Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_crimson_theme' => __('Crimson Theme', 'bwl-pro-voting-manager'),
                                                                                                        ),
                                                                                    'default_value' => 'animated_green_theme',
                                                                                    'class'      => 'widefat'
                                                                                ),     
                
                                                             'bwl_pvm_dislike_bar_theme'  => array(
                                                                                    'title'      => __( 'Dislike Bar Theme: ', 'bwl-pro-voting-manager'),
                                                                                    'id'         => 'bwl_pvm_dislike_bar_theme',
                                                                                    'name'    => 'bwl_pvm_dislike_bar_theme',
                                                                                    'type'      => 'select',
                                                                                    'value'     => array(
                                                                                                            'animated_red_theme' => __('Red Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_blue_theme' => __('Blue Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_green_theme' => __('Green Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_orange_theme' => __('Orange Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_pink_theme' => __('Pink Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_yellow_theme' => __('Yellow Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_yellow_green_theme' => __('Yellow Green Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_brown_theme' => __('brown Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_chocolate_theme' => __('Chocolate Theme', 'bwl-pro-voting-manager'),
                                                                                                            'animated_crimson_theme' => __('Crimson Theme', 'bwl-pro-voting-manager'),
                                                                                                        ),
                                                                                    'default_value' => 'animated_red_theme',
                                                                                    'class'      => 'widefat'
                                                                                ),
                                                            'bwl_pvm_display_feedbacks'  => array(
                                                               'title'      => __( 'Voting Feedbacks', 'bwl-pro-voting-manager'),
                                                               'id'         => 'bwl_pvm_display_feedbacks',
                                                               'name'    => 'bwl_pvm_display_feedbacks',
                                                               'type'      => 'pvm_custom'
                                                           )

                                                    )
        );


        new PVM_Meta_Box( $custom_fields );     
    
            
    }
    
}


// META BOX START EXECUTION FROM HERE.

add_action('admin_init', 'bwl_pvm_custom_meta_init');

?>