/**
 *
 * Page appointment
 *
*/
jQuery(document).ready(function($) {
	$( 'select[name="guests-num"]' ).on( 'change', function( e ) {
		var value = parseInt( $( this ).val(), 10 );
		for (var i = 0; i < 3; i++ ) {
			if ( i == 0 ) {
				continue;
			}
			if ( i > value ) {
				$( '#customer-' + i ).fadeOut( 500 );
				$( '#is-selected-' + i ).val( 'false' );
			} else {
				$( '#customer-' + i ).fadeIn( 500 );
				$( '#is-selected-' + i ).val( 'true' );
			}

		};
	});

	$( '.product-id-select' ).on( 'change', function( e ){
		console.log( 'check it' );
		if ( $( this ).val() == '' ) {
			return;
		}
		var product_select_data = {
			action: 'mb45_appointment_form',
			product_id: $( this ).val()
		};
		var guest_num = $( this ).attr( 'data-num');
		var ajax = $.ajax({
			url: odin.ajaxurl,
			type: 'GET',
			data: product_select_data
		});
		ajax.done( function( data, textStatus, request ){
			wc_appointment_form_params = JSON.parse( request.getResponseHeader( 'json-string' ) );
			$( '#appointment-fields-' + guest_num ).html( data );
			var cf_html = $( '#appointment-fields-' + guest_num ).find( '.custom-fields-temp').html();
			$( '#appointment-fields-' + guest_num ).find( '.custom-fields-temp').remove();
			$( '#appointment-custom-fields-' + guest_num ).html( cf_html );

	var startDate,
		endDate,
		duration = wc_appointment_form_params.appointment_duration,
		days_needed = ( duration < 1 ) ? 1 : duration,
		days_highlighted = days_needed,
		days_array = [],
		wc_appointments_date_picker = {
			init: function() {
				$( 'body' ).on( 'change', '#wc_appointments_field_staff', this.date_picker_init );
				$( '.wc-appointments-date-picker legend small.wc-appointments-date-picker-choose-date' ).show();
				$( '.wc-appointments-date-picker' ).each( function() {
					var form     = $( this ).closest( 'form' ),
						picker   = form.find( '.picker' ),
						fieldset = $( this ).closest( 'fieldset' );

					wc_appointments_date_picker.date_picker_init( picker );

					$( '.wc-appointments-date-picker-date-fields', fieldset ).hide();
					$( '.wc-appointments-date-picker-choose-date', fieldset ).hide();
				} );
			},
			date_picker_init: function( element ) {
				var $picker = $( element );
				if ( $( element ).is( '.picker' ) ) {
					$picker = $( element );
				} else {
					$picker = $( this ).closest('form').find( '.picker:eq(0)' );
				}
				console.log( $.datepicker.ISO_8601 );
				var datepicker_cfg = {
					dateFormat: $.datepicker.ISO_8601,
					showWeek: false,
					showOn: false,
					beforeShowDay: wc_appointments_date_picker.is_appointable,
					onSelect: wc_appointments_date_picker.select_date_trigger,
					minDate: $picker.data( 'min_date' ),
					maxDate: $picker.data( 'max_date' ),
					defaultDate: $picker.data( 'default_date'),
					numberOfMonths: 1,
					showButtonPanel: false,
					showOtherMonths: false,
					selectOtherMonths: false,
					closeText: wc_appointment_form_params.closeText,
					currentText: wc_appointment_form_params.currentText,
					prevText: wc_appointment_form_params.prevText,
					nextText: wc_appointment_form_params.nextText,
					monthNames: wc_appointment_form_params.monthNames,
					monthNamesShort: wc_appointment_form_params.monthNamesShort,
					dayNames: wc_appointment_form_params.dayNames,
					dayNamesMin: wc_appointment_form_params.dayNamesShort,
					firstDay: wc_appointment_form_params.firstDay,
					gotoCurrent: true
				};
				$picker.empty().removeClass('hasDatepicker').datepicker( datepicker_cfg );
				if ( wc_appointment_form_params.is_autoselect === 'yes' && element.type !== 'change' ) {
					var curr_day = $picker.find( '.ui-datepicker-current-day' );

					if ( curr_day.hasClass( 'ui-datepicker-unselectable' ) ) {
						curr_day.next().click();
					} else {
						curr_day.click();
					}
				} else {
					$( '.ui-datepicker-current-day' ).removeClass( 'ui-datepicker-current-day' );
				}

				var form  = $picker.closest( 'form' ),
					year  = parseInt( form.find( 'input.appointment_date_year' ).val(), 10 ),
					month = parseInt( form.find( 'input.appointment_date_month' ).val(), 10 ),
					day   = parseInt( form.find( 'input.appointment_date_day' ).val(), 10 );

				if ( year && month && day ) {
					var date = new Date( year, month - 1, day );
					$picker.datepicker( 'setDate', date );
				}
			},
			select_date_trigger: function( date ) {
				var fieldset		= $( this ).closest( 'fieldset' ),
					parsed_date		= date.split( '-' ),
					year  			= parseInt( parsed_date[0], 10 ),
					month 			= parseInt( parsed_date[1], 10 ),
					day   			= parseInt( parsed_date[2], 10 );

				startDate = new Date( year, month - 1, day );
				endDate = new Date( year, month - 1, day + ( parseInt( days_highlighted, 10 ) - 1 ) );

				fieldset.find( 'input.appointment_to_date_year' ).val( '' );
				fieldset.find( 'input.appointment_to_date_month' ).val( '' );
				fieldset.find( 'input.appointment_to_date_day' ).val( '' );

				fieldset.find( 'input.appointment_date_year' ).val( parsed_date[0] );
				fieldset.find( 'input.appointment_date_month' ).val( parsed_date[1] );
				fieldset.find( 'input.appointment_date_day' ).val( parsed_date[2] ).change();

				fieldset.trigger( 'date-selected', date );
			},
			is_appointable: function( date ) {
				var $form                      = $( this ).closest('form'),
					availability               = $( this ).data( 'availability' ),
					default_availability       = $( this ).data( 'default-availability' ),
					fully_scheduled_days       = $( this ).data( 'fully-scheduled-days' ),
					partially_scheduled_days   = $( this ).data( 'partially-scheduled-days' ),
					remaining_scheduled_days   = $( this ).data( 'remaining-scheduled-days' ),
					padding_days               = $( this ).data( 'padding-days' ),
					discounted_days            = $( this ).data( 'discounted-days' ),
					availability_span		   = wc_appointment_form_params.availability_span,
					has_staff                  = wc_appointment_form_params.has_staff,
					staff_assignment           = wc_appointment_form_params.staff_assignment,
					staff_id 				   = 0,
					css_classes                = '',
					title                      = '',
					discounted_title           = '';
				if ( $form.find('select#wc_appointments_field_staff').val() > 0 ) {
					staff_id = $form.find('select#wc_appointments_field_staff').val();
				}

				var the_date 	= new Date( date ),
					curr_date 	= new Date(),
					year     	= the_date.getFullYear(),
					month    	= the_date.getMonth() + 1,
					day      	= the_date.getDate();

				if ( fully_scheduled_days[ year + '-' + month + '-' + day ] ) {
					if ( fully_scheduled_days[ year + '-' + month + '-' + day ][0] || fully_scheduled_days[ year + '-' + month + '-' + day ][ staff_id ] ) {
						return [ false, 'fully_scheduled', wc_appointment_form_params.i18n_date_fully_scheduled ];
					}
				}
				// Padding days?
				if ( 'undefined' !== typeof padding_days && padding_days[ year + '-' + month + '-' + day ] ) {
					return [ false, 'not_appointable', wc_appointment_form_params.i18n_date_unavailable ];
				}

				if ( '' + year + month + day < wc_appointment_form_params.current_time ) {
					return [ false, 'not_appointable', wc_appointment_form_params.i18n_date_unavailable ];
				}


				if ( partially_scheduled_days && partially_scheduled_days[ year + '-' + month + '-' + day ] ) {
					if ( partially_scheduled_days[ year + '-' + month + '-' + day ][0] || partially_scheduled_days[ year + '-' + month + '-' + day ][ staff_id ] ) {
						css_classes = css_classes + 'partial_scheduled ';
					}
					if ( remaining_scheduled_days[ year + '-' + month + '-' + day ][0] ) {
						css_classes = css_classes + 'remaining_scheduled_' + remaining_scheduled_days[ year + '-' + month + '-' + day ][0] + ' ';
					}
					else if ( remaining_scheduled_days[ year + '-' + month + '-' + day ][ staff_id ] ) {
						css_classes = css_classes + 'remaining_scheduled_' + remaining_scheduled_days[ year + '-' + month + '-' + day ][ staff_id ] + ' ';
					}
				}

				if ( date >= startDate && date <= endDate ) {
					css_classes = 'ui-datepicker-selected-day';
				}

				if ( the_date < curr_date ) {
					css_classes = css_classes + ' past_day';
				}

				if ( 'undefined' !== typeof discounted_days && discounted_days[ year + '-' + month + '-' + day ] ) {
					css_classes = css_classes + ' discounted_day';
					discounted_title = discounted_title + discounted_days[ year + '-' + month + '-' + day ];
				}

				if ( availability_span === 'start' ) {
					days_needed = 1;
				}

				var slot_args = {
					start_date				: date,
					number_of_days			: 1,
					fully_scheduled_days	: fully_scheduled_days,
					availability			: availability,
					default_availability	: default_availability,
					has_staff				: has_staff,
					staff_id				: staff_id,
					staff_assignment		: staff_assignment
				};

				var appointable = wc_appointments_date_picker.is_slot_appointable( slot_args );
				if ( appointable && days_needed > 1 && ( css_classes.indexOf( 'past_day' ) === -1 ) ) {
					for ( var i = 0; i < days_needed; i++ ) {
						var next_date 	= new Date( date );
						next_date.setDate(the_date.getDate() + i);
						var n_year     	= next_date.getFullYear(),
							n_month    	= next_date.getMonth() + 1,
							n_day      	= next_date.getDate();

						if ( next_date.getDate() !== the_date.getDate() ) {
							days_array[i] = n_year + '-' + n_month + '-' + n_day;
						}
					}
				}

				if ( ! appointable ) {
					if ( $.inArray( year + '-' + month + '-' + day, days_array ) > -1 ) {
						return [ appointable, css_classes + ' not_appointable in_range', wc_appointment_form_params.i18n_date_available ];
					}
					return [ appointable, css_classes + ' not_appointable', wc_appointment_form_params.i18n_date_unavailable ];
				} else {
					if ( css_classes.indexOf( 'partial_scheduled' ) > -1 ) {
						title = wc_appointment_form_params.i18n_date_partially_scheduled;
					} else if ( css_classes.indexOf( 'discounted_day' ) > -1 ) {
						title = discounted_title;
					} else if ( css_classes.indexOf( 'past_day' ) > -1 ) {
						title = wc_appointment_form_params.i18n_date_unavailable;
					} else {
						title = wc_appointment_form_params.i18n_date_available;
					}
					return [ appointable, css_classes + ' appointable', title ];
				}
			},
			is_slot_appointable: function( args ) {
				var appointable = args.default_availability;

				for ( var i = 0; i < args.number_of_days; i++ ) {
					var the_date     = new Date( args.start_date );
					the_date.setDate( the_date.getDate() + i );

					var year        = the_date.getFullYear(),
						month       = the_date.getMonth() + 1,
						day         = the_date.getDate(),
						day_of_week = the_date.getDay();

					if ( day_of_week === 0 ) {
						day_of_week = 7;
					}

					var staff_args = {
						staff_rules: args.availability[ args.staff_id ],
						date: the_date,
						default_availability: args.default_availability
					};
					appointable = wc_appointments_date_picker.is_staff_available( staff_args );
					if ( ( 'automatic' === args.staff_assignment && args.has_staff ) || ( 0 === args.staff_id && args.has_staff ) ) {
						var automatic_staff_args = $.extend(
							{
								availability: args.availability,
								fully_scheduled_days: args.fully_scheduled_days
							},
							staff_args
						);

						appointable = wc_appointments_date_picker.has_available_staff( automatic_staff_args );
					}

					if ( args.fully_scheduled_days[ year + '-' + month + '-' + day ] ) {
						if ( args.fully_scheduled_days[ year + '-' + month + '-' + day ][0] || args.fully_scheduled_days[ year + '-' + month + '-' + day ][ args.staff_id ] ) {
							appointable = false;
						}
					}

					if ( ! appointable ) {
						break;
					}
				}

				return appointable;
			},
			is_staff_available: function( args ) {
				var availability = args.default_availability,
					year         = args.date.getFullYear(),
					month        = args.date.getMonth() + 1,
					day          = args.date.getDate(),
					day_of_week  = args.date.getDay(),
					week         = $.datepicker.iso8601Week( args.date );

				if ( day_of_week === 0 ) {
					day_of_week = 7;
				}

				if ( args.fully_scheduled_days && args.fully_scheduled_days[ year + '-' + month + '-' + day ] && args.fully_scheduled_days[ year + '-' + month + '-' + day ][ args.staff_id ] ) {
					return false;
				}

				$.each( args.staff_rules, function( index, rule ) {
					var type  = rule[0];
					var rules = rule[1];
					try {
						switch ( type ) {
							case 'months':
								if ( typeof rules[ month ] !== 'undefined' ) {
									availability = rules[ month ] || availability;
									return false;
								}
							break;
							case 'weeks':
								if ( typeof rules[ week ] !== 'undefined' ) {
									availability = rules[ week ] || availability;
									return false;
								}
							break;
							case 'days':
								if ( typeof rules[ day_of_week ] !== 'undefined' ) {
									availability = rules[ day_of_week ] || availability;
									return false;
								}
							break;
							case 'custom':
								if ( typeof rules[ year ][ month ][ day ] !== 'undefined' ) {
									availability = rules[ year ][ month ][ day ] || availability;
									return false;
								}
							break;

							case 'time:range':
								if ( false === args.default_availability && ( typeof rules[ year ][ month ][ day ] !== 'undefined' ) ) {
									availability = rules[ year ][ month ][ day ].rule || availability;
									return false;
								}
							break;

						}

					} catch( err ) {}

					return true;
				});

				return availability;
			},
			has_available_staff: function( args ) {
				for ( var staff_id in args.availability ) {
					staff_id = parseInt( staff_id, 10 );

					// Skip staff_id '0' that has been performed before.
					if ( 0 === staff_id ) {
						continue;
					}

					args.staff_rules = args.availability[ staff_id ];
					args.staff_id = staff_id;
					if ( wc_appointments_date_picker.is_staff_available( args ) ) {
						return true;
					}
				}

				return false;
			}
		};

	wc_appointments_date_picker.init();


		} );

	/*
	if ( ! window.console ) {
		window.console = {
			log : function(str) {
				alert(str);
			}
		};
	}
	*/

	var xhr;

	var wc_appointments_time_picker = {
		init: function() {

			$( 'body' ).on( 'click', '.slot-picker a', this.time_picker_init );
			$( '#wc_appointments_field_staff' ).on( 'change', this.show_available_time_slots );
			$( 'body' ).on( 'date-selected', this.show_available_time_slots );
		},
		time_picker_init: function() {
			var value  = $(this).data('value');
			var target = $(this).parents('.form-field').find('input');

			target.val( value ).change();
			$(this).parents('.form-field').find('li').removeClass('selected');
			$(this).parents('li').addClass('selected');

			return false;
		},
		show_available_time_slots: function( e ) {
			var cart_form		= $( '#appointment-fields-' + guest_num );
			var slot_picker     = cart_form.find('.slot-picker');
			var fieldset        = cart_form.find('fieldset');
			var year  = parseInt( fieldset.find( 'input.appointment_date_year' ).val(), 10 );
			var month = parseInt( fieldset.find( 'input.appointment_date_month' ).val(), 10 );
			var day   = parseInt( fieldset.find( 'input.appointment_date_day' ).val(), 10 );
			if ( cart_form.find( 'input[name="add-to-cart"]' ).length < 1 ) {
				cart_form.append( '<input type="hidden" name="add-to-cart" value="' + product_select_data.product_id + '">');
			}
			if ( ! year || ! month || ! day ) {
				return;
			}

			// clear slots
			slot_picker.closest('div').find('input').val( '' ).change();
			slot_picker.closest('div').block({message: null, overlayCSS: {background: '#fff', backgroundSize: '16px 16px', opacity: 0.6}}).show();

			// Get slots via ajax
			if ( xhr ) {
				xhr.abort();
			}

			xhr = $.ajax({
				type: 'POST',
				url: wc_appointment_form_params.ajax_url,
				data: {
					action: 'wc_appointments_get_slots',
					form: cart_form.find( 'input, textarea, select' ).serialize(),
					timezone: jstz.determine().name()
				},
				success: function( code ) {
					slot_picker.html( code );
					slot_picker.closest('div').unblock();
				},
				dataType: 'html'
			});
		}
	};

	wc_appointments_time_picker.init();


	});

	$( '#page-appointment' ).on( 'submit', function( e ){
		$( '.each-customer' ).each( function(){
			$each_customer = $( this );
			var customer_num = $each_customer.data( 'customer' );
			var field_selector = '#appointment-fields-' + customer_num;
			var selector = field_selector + ' select, '
				+ field_selector + ' input, '
				+ field_selector + ' textarea, '
				+ field_selector + ' radio, '
				+ field_selector + ' checkbox, '
				+ field_selector + ' color, '
				+ field_selector + ' file, '
				+ field_selector + ' range';
			$( selector ).each( function() {
				var name = $( this ).attr( 'name' ) + '[' + customer_num + ']';
				$( this ).attr( 'name', name );
				console.log( $( this ).attr( 'name' ) );
			});
		});
	});
	$( 'body' ).on( 'click', '.show-options-btn', function(e){
		e.preventDefault();

		var $element = $( $( this ).attr( 'data-id') );
		var open = $( this ).attr( 'data-show' );
		if ( open == 'false' ) {
			$element.fadeIn( 'slow' );
			$( this ).attr( 'data-show', 'true' );
		} else {
			$element.fadeOut( 'slow' );
			$( this ).attr( 'data-show', false );
		}
	});
});
