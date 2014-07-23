<?php
/**
 * Class to create a control to set a background on an element.
 *
 * @since 1.0.0
 */
class Themify_Background_Control extends Themify_Control {

	/**
	 * Type of this control.
	 * @access public
	 * @var string
	 */
	public $type = 'themify_background';

	/**
	 * Render the control's content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {
		$v = $this->value();
		$values = json_decode( $v );
		wp_enqueue_script( 'json2' );
		wp_enqueue_media();

		// Disable
		$noimage = isset( $values->noimage ) ? $values->noimage : '';

		// Style Dropdown
		$styles = array(
			'repeat' => __( 'Repeat All', 'themify' ),
			'repeat-x' => __( 'Repeat Horizontal', 'themify' ),
			'repeat-y' => __( 'Repeat Vertical', 'themify' ),
			'no-repeat' => __( 'No Repeat', 'themify' ),
			'fullcover' => __( 'Fullcover', 'themify' ),
		);
		$current_style = isset( $values->style ) ? $values->style : 'repeat';
		?>

		<?php if ( $this->show_label && ! empty( $this->label ) ) : ?>
			<span class="customize-control-title themify-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<div class="themify-customizer-brick">
			<!-- Background Image -->
			<?php $this->render_image( $values, array(
				'image_label' => __( 'Background Image', 'themify' ),
			) ); ?>

			<!-- Background Attachment or Size -->
			<div class="custom-select background-style">
				<select class="image-style">
					<?php foreach ( $styles as $style => $label ) : ?>
						<option value="<?php echo $style; ?>" <?php selected( $current_style, $style ); ?>><?php echo $label; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<!-- No Background Image-->

			<div class="no-image">
				<?php $noimage = $this->id . '_noimage'; ?>
				<input id="<?php echo $noimage; ?>" type="checkbox" class="disable-control" <?php checked( $noimage, 'disabled' ); ?> value="noimage"/>
				<label for="<?php echo $noimage; ?>">
					<?php _e( 'No Background Image', 'themify' ); ?>
				</label>
			</div>

		</div>

		<div class="themify-customizer-brick">
			<?php $this->render_color( $values, array(
				'side_label' => true,
				'color_label' => __( 'Background Color', 'themify' ),
			) ); ?>
		</div>

		<input <?php $this->link(); ?> value='<?php echo esc_attr( $v ); ?>' type="hidden" class="<?php echo $this->type; ?>_control themify-customizer-value-field"/>
		<?php
	}
}