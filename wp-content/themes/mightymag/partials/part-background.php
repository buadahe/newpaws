<?php $background = of_get_option('mgm_bg');
            if ( ($background) AND of_get_option('mgm_full_bg') == NULL ) {
                if ($background['image']) {
                    echo 'style="background-image:url('. $background['image']. '); background-repeat:' . $background['repeat'] . '; background-position:' . $background['position'] . ';background-attachment:' . $background['attachment'] . ';background-color:' . $background['color'] . '"';
               
                } else {
                    echo 'style="background:'.$background['color']. '"';
                }
			};
			if (of_get_option('mgm_full_bg')) {
				echo 'style="background:url(' . of_get_option('mgm_full_bg'). ') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"';	
				};
?>