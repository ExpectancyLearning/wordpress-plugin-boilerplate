<?php
/**
 * display form in the admin widget area
 */
defined('ABSPATH') or die(__('You shall not pass!', 'my-plugin-text'));
?>

<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'my-plugin-text' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'setting1' ); ?>"><?php _e( 'Enter a number from 1 to 9:', 'my-plugin-text' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'setting1' ); ?>" name="<?php echo $this->get_field_name( 'setting1' ); ?>" type="text" value="<?php echo esc_attr( $setting1 ); ?>" />
</p>

