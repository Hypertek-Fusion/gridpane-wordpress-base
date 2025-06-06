<?php
$search_text  = $settings['placeholder'] ?? esc_html__( 'Search ...', 'bricks' );
$button_text  = $settings['buttonText'] ?? '';
$aria_label   = $settings['buttonAriaLabel'] ?? '';
$icon         = ! empty( $settings['icon'] ) ? Bricks\Element::render_icon( $settings['icon'], [ 'overlay-trigger' ] ) : false;
$for          = isset( $element_id ) ? "search-input-{$element_id}" : 'search-input';
$input_name   = 's'; // NOTE: Allow setting custom name value (needed for SearchWP)?
$search_value = get_search_query();

// Check for custom label settings (@since 1.11.1)
$show_label = isset( $settings['showLabel'] );
$label_text = $settings['labelText'] ?? esc_html__( 'Search', 'bricks' );

/**
 * Use predefined search value (if get_search_query() is empty and pre_search_value is set)
 *
 * @since 1.9.5
 */
if ( ! empty( $pre_search_value ) && empty( $search_value ) ) {
	$search_value = $pre_search_value;
}

// https://academy.bricksbuilder.io/article/filter-bricks-search_form-home_url/
$action_url = apply_filters( 'bricks/search_form/home_url', home_url( '/' ) );

// Use user's defined action URL if set (@since 1.9.5)
if ( ! empty( $settings['actionURL'] ) ) {
	$action_url = trailingslashit( $settings['actionURL'] );
}
?>

<form role="search" method="get" class="bricks-search-form" action="<?php echo esc_url( $action_url ); ?>">
	<?php if ( $show_label ) { ?>
		<label for="<?php echo esc_attr( $for ); ?>"><?php echo esc_html( $label_text ); ?></label>
	<?php } else { ?>
		<label for="<?php echo esc_attr( $for ); ?>" class="screen-reader-text"><span><?php echo esc_html( $label_text ); ?></span></label>
	<?php } ?>
	<input type="search" placeholder="<?php echo esc_attr( $search_text ); ?>" value="<?php echo $search_value; ?>" name="s" id="<?php echo esc_attr( $for ); ?>" />

	<?php
	// Add additional hidden input paramaters (@since 1.9.5)
	if ( ! empty( $settings['additionalParams'] ) ) {
		foreach ( $settings['additionalParams'] as $key => $value ) {
			$input_html = sprintf(
				'<input type="hidden" name="%s" value="%s" />',
				esc_attr( $key ),
				esc_attr( $value )
			);

			echo $input_html;
		}
	}

	if ( $icon || $button_text ) {
		if ( $aria_label ) {
			echo '<button type="submit" aria-label="' . esc_attr( $aria_label ) . '">' . $icon . $button_text . '</button>';
		} else {
			echo '<button type="submit">' . $icon . $button_text . '</button>';
		}
	}
	?>
</form>
