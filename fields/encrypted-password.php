<?php

namespace Log1x\Acf\EncryptedPassword\Fields;

if (class_exists('EncryptedPassword')) {
    return;
}

/**
 * Encrypted Password Field
 */
class EncryptedPassword extends \acf_field
{
    /**
     * Constructor
     */
    public function __construct($settings)
    {
        $this->name     = 'encrypted_password';
        $this->label    = __('Encrypted Password', 'acf-encrypted-password');
        $this->category = 'basic';
        $this->defaults = [
            'placeholder' => ''
        ];
        $this->settings = $settings;

        parent::__construct();
    }

    /**
     *  Render Field Settings
     *
     *  Create extra settings for your field. These are visible when editing a field.
     *
     *  @param	array $field
     *  @return	void
     */
    public function render_field_settings($field) {
        acf_render_field_setting($field, [
            'label'        => __('Placeholder Text', 'acf-encrypted-password'),
            'instructions' => __('Appears within the input', 'acf-encrypted-password'),
            'type'         => 'text',
            'name'         => 'placeholder',
        ]);
    }

    /**
     *  render_field()
     *
     *  Create the HTML interface for your field
     *
     *  @param	array $field
     *  @return	void
     */
    public function render_field($field)
    {
        echo '<input type="password" name="' . esc_attr($field['name']) . '" value="' . esc_attr($field['value']) . '" placeholder="' . esc_attr($field['placeholder']) . '" />';
    }

    /**
     *  load_value()
     *
     *  This filter is applied to the $value after it is loaded from the db
     *
     *
     *  @param	mixed $value
     *  @param	mixed $post_id
     *  @param	array $field
     *  @return	$value
     */
    public function load_value($value, $post_id, $field)
    {
        return $value;
    }

    /**
     *  update_value()
     *
     *  This filter is applied to the $value before it is saved in the database.
     *
     *  @param	mixed $value
     *  @param	mixed $post_id
     *  @param	array $field
     *  @return	$value
     */
    public function update_value($value, $post_id, $field)
    {
        $prefix = '$2y';

        // Do nothing is the value is already our hash.
        if (strpos($value, $prefix) === 0) {
            return $value;
        }

        // Allow empty values to be stored.
        if (trim($value) == '') {
            return '';
        }

        return password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     *  format_value()
     *
     *  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
     *
     *  @param	mixed $value
     *  @param	mixed $post_id
     *  @param	array $field
     *  @return	mixed
     */
    public function format_value($value, $post_id, $field)
    {
        return $value;
    }

    /*
    *  validate_value()
    *
    *  This filter is used to perform validation on the value prior to saving.
    *  All values are validated regardless of the field's required setting. This allows you to validate and return
    *  messages to the user if the value is not correct
    *
    *  @param	boolean $valid
    *  @param	mixed   $value
    *  @param	array   $field
    *  @param	array   $input
    *  @return	boolean
    */
    public function validate_value($valid, $value, $field, $input)
    {
        return true;
    }

    /**
     *  load_field()
     *
     *  This filter is applied to the $field after it is loaded from the database
     *
     *  @param	array $field
     *  @return	array
     */
    public function load_field($field)
    {
        return $field;
    }

    /**
     *  update_field()
     *
     *  This filter is applied to the $field before it is saved to the database
     *
     *  @param	array $field
     *  @return	array
     */
    public function update_field($field)
    {
        return $field;
    }
}

new EncryptedPassword($this->settings);
