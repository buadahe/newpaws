jQuery (function ($)
{
	$( '.rwmb-slider' ).each( function() {
		
		var $this = $( this ),
			$input = $this.siblings( 'input' ),
			$valueLabel = $this.siblings( '.rwmb-slider-value-label' ).find( 'span' ),
			value = $input.val(),
			options = $this.data( 'options' );

		if ( !value )
		{
			value = 0;
			$input.val( 0 );
			$valueLabel.text( '0' );
		}
		else
		{
			$valueLabel.text( value );
		}

		// Assign field value and callback function when slide
		options.value = value;
		options.slide = function( event, ui )
		{
			$input.val( ui.value );
			$valueLabel.text( ui.value );
			
		};
		
		
		// Calculate Average in text input
		options.change = function (event, ui) {
			var avg = 0;
			var div = 0;
			$('.rwmb-slider').each(function () {
				avg += ($(this).slider('value'));
				if($(this).slider('value')>0)div++
			})
			$('input[name=mgm_overall_score]').val(Math.floor(avg/div));
		};
		
		$this.slider( options );	
		
	});
	
});