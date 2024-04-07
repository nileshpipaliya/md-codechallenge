/**
 * All of the JS for your public-facing functionality should be
 * included in this file.
 *
 * @since 1.0.0
 * @package Wp_Profile_Listing
 */

(function ($) {
	'use strict'
	// Initialize Select2 for skills dropdown.
	$( '.skills-control' ).select2(
		{
			placeholder: 'Select skills'
		}
	);
	// Initialize Select2 for educations dropdown.
	$( '.education-control' ).select2(
		{
			placeholder: 'Select educations'
		}
	);
	// Select the age range slider element.
	const $ageRange      = $( "#profile-age-range" );
	const $profileAgeMin = $( "#profile-age-min" );
	const $profileAgeMax = $( "#profile-age-max" );
	// Initialize the slider using jQuery UI's slider() method.
	$ageRange.slider(
		{
			range: true,
			min: $ageRange.data( "min" ),
			max: $ageRange.data( "max" ),
			step: $ageRange.data( "step" ),
			values: [$ageRange.data( "min" ), $ageRange.data( "max" )],
			slide: function ( event, ui ) {
				$profileAgeMin.val( ui.values[0] );
				$profileAgeMax.val( ui.values[1] );
			}
		}
	);

	const $profilesTable = $( '#profiles-table' );
	const $profileFilter = $( '#profile-filter' );
	const dataTable      = $profilesTable.DataTable(
		{
			processing: true,
			serverSide: true,
			searching: false,
			ajax: {
				url: ajax_obj.url,
				type: 'POST',
				dataType: 'json',
				data: function ( param ) {
					// Serialize form data only once.
					const formdata = $profileFilter.serializeArray();

					$.each(
						formdata,
						function ( i, input ) {
							if ( param.hasOwnProperty( input.name ) ) {
								if ( ! Array.isArray( d[input.name] ) ) {
									param[input.name] = [d[input.name]];
								}
								param[input.name].push( input.value );
							} else {
								param[input.name] = input.value;
							}
						}
					);
					param.action = 'get_profile_data';
					param.nonce  = ajax_obj.nonce;
				}
			},
			bLengthChange : false,
			pageLength: 5,
			bInfo : false,
			order: [[1, 'asc']],
			columnDefs: [{
				"targets": [0, 2, 3, 4, 5],
				"orderable": false
			}],
			columns: [
			{ data: 'ID' },
			{ data: 'name' },
			{ data: 'age' },
			{ data: 'years_of_experience',width:'18%' },
			{ data: 'no_jobs_completed',width:'18%' },
			{ data: 'ratings' }
			]
		}
	);

	// Add submit event listener to the profile filter form.
	$profileFilter.on(
		'submit',
		function (event) {
			// Prevent default form submission.
			event.preventDefault();
			// Reload DataTable with updated filters.
			dataTable.ajax.reload();
		}
	);

})( jQuery )
