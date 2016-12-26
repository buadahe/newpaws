<?php
/*
 * This file handles Options Panel Javascript
 * For Example Show/Hide stuff etc..
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	
	
	// Grid Offset @since MGM 1.6
	
   jQuery("#mgm_grid_offset_method").change(function() {
        var display = jQuery(this).val();
        if( display === 'manual') {
          jQuery('#section-mgm_grid_offset_manual').fadeIn(400);
        } else if (display === 'automatic') {
          jQuery('#section-mgm_grid_offset_manual').fadeOut(400);
        }
    });

	if (jQuery('#mgm_grid_offset_method').val() === 'manual') {
  		jQuery('#section-mgm_grid_offset_manual').show();
	}


	// Boxed/Unboxed
	
   jQuery("#mgm_boxed").change(function() {
        var display = jQuery(this).val();
        if( display === 'boxed') {
          jQuery('#section-mgm_boxed_bg, #section-mgm_boxed_shadow').fadeIn(400);
        } else if (display === 'free') {
          jQuery('#section-mgm_boxed_bg, #section-mgm_boxed_shadow').fadeOut(400);
        }
    });

	if (jQuery('#mgm_boxed').val() === 'boxed') {
  		jQuery('#section-mgm_boxed_bg, #section-mgm_boxed_shadow').show();
	}

	//Slider-2
		
	   $("#mgm_excerpt").change(function() {
        var display = $(this).val();
        if( display === 'autotrim') {
		  $('#section-mgm_excerpt_count').fadeIn(400);
		
        } else {
		  $('#section-mgm_excerpt_count').fadeOut(400);
        }
    });
		
	if ($('#mgm_excerpt').val() === 'autotrim') {
		$('#section-mgm_excerpt_count').show();
        }
		
// Tabs 1
   jQuery("#tab1_display").change(function() {
        var display = jQuery(this).val();
        if( display === 'category') {
          jQuery('#section-tab1_category').fadeIn(400);
          jQuery('#section-tab1_tag').fadeOut(400);
        } else if (display === 'tag') {
          jQuery('#section-tab1_category').fadeOut(400);
          jQuery('#section-tab1_tag').fadeIn(400);
        } else {
          jQuery('#section-tab1_category').fadeOut(400);
          jQuery('#section-tab1_tag').fadeOut(400);
           
        }
    });

	if (jQuery('#tab1_display').val() === 'category') {
  		jQuery('#section-tab1_category').show();
	} else if (jQuery('#tab1_display').val() === 'tag') {
  		jQuery('#section-tab1_tag').show();
        }
 
// Tabs 2
   jQuery("#tab2_display").change(function() {
        var display = jQuery(this).val();
        if( display === 'category') {
          jQuery('#section-tab2_category').fadeIn(400);
          jQuery('#section-tab2_tag').fadeOut(400);
        } else if (display === 'tag') {
          jQuery('#section-tab2_category').fadeOut(400);
          jQuery('#section-tab2_tag').fadeIn(400);
        } else {
          jQuery('#section-tab2_category').fadeOut(400);
          jQuery('#section-tab2_tag').fadeOut(400);
           
        }
    });

	if (jQuery('#tab2_display').val() === 'category') {
  		jQuery('#section-tab2_category').show();
	} else if (jQuery('#tab2_display').val() === 'tag') {
  		jQuery('#section-tab2_tag').show();
        }
 
// Tabs 3
   jQuery("#tab3_display").change(function() {
        var display = jQuery(this).val();
        if( display === 'category') {
          jQuery('#section-tab3_category').fadeIn(400);
          jQuery('#section-tab3_tag').fadeOut(400);
        } else if (display === 'tag') {
          jQuery('#section-tab3_category').fadeOut(400);
          jQuery('#section-tab3_tag').fadeIn(400);
        } else {
          jQuery('#section-tab3_category').fadeOut(400);
          jQuery('#section-tab3_tag').fadeOut(400);
           
        }
    });

	if (jQuery('#tab3_display').val() === 'category') {
  		jQuery('#section-tab3_category').show();
	} else if (jQuery('#tab3_display').val() === 'tag') {
  		jQuery('#section-tab3_tag').show();
        }
 
// Tabs 4
   jQuery("#tab4_display").change(function() {
        var display = jQuery(this).val();
        if( display === 'category') {
          jQuery('#section-tab4_category').fadeIn(400);
          jQuery('#section-tab4_tag').fadeOut(400);
        } else if (display === 'tag') {
          jQuery('#section-tab4_category').fadeOut(400);
          jQuery('#section-tab4_tag').fadeIn(400);
        } else {
          jQuery('#section-tab4_category').fadeOut(400);
          jQuery('#section-tab4_tag').fadeOut(400);
           
        }
    });

	if (jQuery('#tab4_display').val() === 'category') {
  		jQuery('#section-tab4_category').show();
	} else if (jQuery('#tab4_display').val() === 'tag') {
  		jQuery('#section-tab4_tag').show();
        }
 
// Tabs 5
   jQuery("#tab5_display").change(function() {
        var display = jQuery(this).val();
        if( display === 'category') {
          jQuery('#section-tab5_category').fadeIn(400);
          jQuery('#section-tab5_tag').fadeOut(400);
        } else if (display === 'tag') {
          jQuery('#section-tab5_category').fadeOut(400);
          jQuery('#section-tab5_tag').fadeIn(400);
        } else {
          jQuery('#section-tab5_category').fadeOut(400);
          jQuery('#section-tab5_tag').fadeOut(400);
           
        }
    });

	if (jQuery('#tab5_display').val() === 'category') {
  		jQuery('#section-tab5_category').show();
	} else if (jQuery('#tab5_display').val() === 'tag') {
  		jQuery('#section-tab5_tag').show();
        }
 
// Tabs 6
   jQuery("#tab6_display").change(function() {
        var display = jQuery(this).val();
        if( display === 'category') {
          jQuery('#section-tab6_category').fadeIn(400);
          jQuery('#section-tab6_tag').fadeOut(400);
        } else if (display === 'tag') {
          jQuery('#section-tab6_category').fadeOut(400);
          jQuery('#section-tab6_tag').fadeIn(400);
        } else {
          jQuery('#section-tab6_category').fadeOut(400);
          jQuery('#section-tab6_tag').fadeOut(400);
           
        }
    });

	if (jQuery('#tab6_display').val() === 'category') {
  		jQuery('#section-tab6_category').show();
	} else if (jQuery('#tab6_display').val() === 'tag') {
  		jQuery('#section-tab6_tag').show();
        }

// Tabs 7
   jQuery("#tab7_display").change(function() {
        var display = jQuery(this).val();
        if( display === 'category') {
          jQuery('#section-tab7_category').fadeIn(400);
          jQuery('#section-tab7_tag').fadeOut(400);
        } else if (display === 'tag') {
          jQuery('#section-tab7_category').fadeOut(400);
          jQuery('#section-tab7_tag').fadeIn(400);
        } else {
          jQuery('#section-tab7_category').fadeOut(400);
          jQuery('#section-tab7_tag').fadeOut(400);
           
        }
    });

	if (jQuery('#tab7_display').val() === 'category') {
  		jQuery('#section-tab7_category').show();
	} else if (jQuery('#tab7_display').val() === 'tag') {
  		jQuery('#section-tab7_tag').show();
        }
 
// Tabs 8
   jQuery("#tab8_display").change(function() {
        var display = jQuery(this).val();
        if( display === 'category') {
          jQuery('#section-tab8_category').fadeIn(400);
          jQuery('#section-tab8_tag').fadeOut(400);
        } else if (display === 'tag') {
          jQuery('#section-tab8_category').fadeOut(400);
          jQuery('#section-tab8_tag').fadeIn(400);
        } else {
          jQuery('#section-tab8_category').fadeOut(400);
          jQuery('#section-tab8_tag').fadeOut(400);
           
        }
    });

	if (jQuery('#tab8_display').val() === 'category') {
  		jQuery('#section-tab8_category').show();
	} else if (jQuery('#tab8_display').val() === 'tag') {
  		jQuery('#section-tab8_tag').show();
        }

  // Tabs Custom afrgun
   jQuery("#tab9_display").change(function() {
        var display = jQuery(this).val();
        if( display === 'category') {
          jQuery('#section-tab9_category').fadeIn(400);
          jQuery('#section-tab9_tag').fadeOut(400);
        } else if (display === 'tag') {
          jQuery('#section-tab9_category').fadeOut(400);
          jQuery('#section-tab9_tag').fadeIn(400);
        } else {
          jQuery('#section-tab9_category').fadeOut(400);
          jQuery('#section-tab9_tag').fadeOut(400);
           
        }
    });

  if (jQuery('#tab9_display').val() === 'category') {
      jQuery('#section-tab9_category').show();
  } else if (jQuery('#tab9_display').val() === 'tag') {
      jQuery('#section-tab9_tag').show();
        }
});

</script>

<?php
}