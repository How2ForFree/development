<?php
/**
 * Class to create a control and set the position of an element.
 *
 * @since 1.0.0
 */
class Themify_Position_Control extends Themify_Control {

	/**
	 * Type of this control.
	 * @access public
	 * @var string
	 */
	public $type = 'themify_position';

	/**
	 * Render the control's content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {
		$v = $this->value();
		$values = json_decode( $v );
		wp_enqueue_script( 'json2' );

		// Units
		$units = array( 'px', '%', 'em' );

		// Positions
		$current_position = isset( $values->position ) ? $values->position : 'static';
		$positions = array(
			'static' => __( 'Static', 'themify' ),
			'relative' => __( 'Relative', 'themify' ),
			'fixed' => __( 'Fixed', 'themify' ),
			'absolute' => __( 'Absolute', 'themify' ),
		);

		// Coordinates
		$vertical_side = isset( $values->vertical->side ) ? $values->vertical->side : 'top';
		$vertical_value = isset( $values->vertical->width ) ? $values->vertical->width : '';
		$vertical_unit = isset( $values->vertical->unit ) ? $values->vertical->unit : 'px';
		$verticals = array(
			'top' => __( 'Top', 'themify' ),
			'bottom' => __( 'Bottom', 'themify' ),
		);
		$horizontal_side = isset( $values->horizontal->side ) ? $values->horizontal->side : 'left';
		$horizontal_value = isset( $values->horizontal->width ) ? $values->horizontal->width : '';
		$horizontal_unit = isset( $values->horizontal->unit ) ? $values->horizontal->unit : 'px';
		$horizontals = array(
			'left' => __( 'Left', 'themify' ),
			'right' => __( 'Right', 'themify' ),
		);
		?>

		<?php if ( $this->show_label && ! empty( $this->label ) ) : ?>
			<span class="customize-control-title themify-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<!-- Element Position -->
		<div class="themify-customizer-brick">

			<div class="custom-select">
				<select class="position">
					<option value=""></option>
					<?php foreach ( $positions as $position => $label ) : ?>
						<option value="<?php echo $position; ?>" <?php selected( $position, $current_position ); ?>><?php echo $label; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<label><?php _e( 'Position', 'themify' ); ?></label>

		</div>

		<!-- Vertical -->
		<div class="themify-customizer-brick position-wrap">

			<input type="text" class="dimension-width vertical-width" value="<?php echo $vertical_value; ?>" data-side="vertical" />

			<div class="custom-select">
				<select class="dimension-unit vertical-unit" data-side="vertical">
					<?php foreach ( $units as $unit ) : ?>
						<option value="<?php echo $unit; ?>" <?php selected( $unit, $vertical_unit ); ?>><?php echo $unit; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="custom-select">
				<select class="position-side vertical-side" data-side="vertical">
					<option value=""></option>
					<?php foreach ( $verticals as $vertical => $label ) : ?>
						<option value="<?php echo $vertical; ?>" <?php selected( $vertical, $vertical_side ); ?>><?php echo $label; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

		</div>

		<!-- Horizontal -->
		<div class="themify-customizer-brick position-wrap">

			<input type="text" class="dimension-width horizontal-width" value="<?php echo $horizontal_value; ?>" data-side="horizontal" />

			<div class="custom-select">
				<select class="dimension-unit horizontal-unit" data-side="horizontal">
					<?php foreach ( $units as $unit ) : ?>
						<option value="<?php echo $unit; ?>" <?php selected( $unit, $horizontal_unit ); ?>><?php echo $unit; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="custom-select">
				<select class="position-side horizontal-side" data-side="horizontal">
					<option value=""></option>
					<?php foreach ( $horizontals as $horizontal => $label ) : ?>
						<option value="<?php echo $horizontal; ?>" <?php selected( $horizontal, $horizontal_side ); ?>><?php echo $label; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

		</div>

		<input <?php $this->link(); ?> value='<?php echo esc_attr( $v ); ?>' type="hidden" class="<?php echo $this->type; ?>_control themify-customizer-value-field"/>
		<?php
	}
}