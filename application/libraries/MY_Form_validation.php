<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2010, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Form Validation Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Validation
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/form_validation.html
 */
class MY_Form_validation extends CI_Form_validation{
	

/**
     * Get the value from a form
     *
     * Permits you to repopulate a form field with the value it was submitted
     * with, or, if that value doesn't exist, with the default
     *
     * @access    public
     * @param    string    the field name
     * @param    string
     * @return    void
     */    
	function set_value($field = '', $default = '') {
		if (!isset($this->_field_data[$field])) {
		    return $default;
		}
		$field = &$this->_field_data[$field]['postdata'];
		if(!isset($field)) {
		    return $default;
		}
		else if (is_array($field)) {
		    $current = each($field);
		    return $current['value'];
		}else {
		    return $field;
		}
	    }
    
    // --------------------------------------------------------------------
    
    /**
     * Set Select
     *
     * Enables pull-down lists to be set to the value the user
     * selected in the event of an error
     *
     * @access    public
     * @param    string
     * @param    string
     * @return    string
     */    
    function set_select($field = '', $value = '', $default = FALSE)
    {        
        return $this->set_value_array($field, $value, ' selected="selected"', $default);
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Set Radio
     *
     * Enables radio buttons to be set to the value the user
     * selected in the event of an error
     *
     * @access    public
     * @param    string
     * @param    string
     * @return    string
     */    
    function set_radio($field = '', $value = '', $default = FALSE)
    {
        return $this->set_value_array($field, $value, ' selected="selected"', $default);
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Set Checkbox
     *
     * Enables checkboxes to be set to the value the user
     * selected in the event of an error
     *
     * @access    public
     * @param    string
     * @param    string
     * @return    string
     */    
    function set_checkbox($field = '', $value = '', $default = FALSE)
    {
        return $this->set_value_array($field, $value, ' checked="checked"', $default);
    }
    
    function set_value_array($field = '', $value = '', $default_value = '' ,$default = FALSE){
        if ( ! isset($this->_field_data[$field]) OR ! isset($this->_field_data[$field]['postdata']))
        {
            if( ! ($this->CI->input->post($field) === FALSE))
            {
                $field = $this->CI->input->post($field);
            } 
            else 
            {
                if ($default === TRUE AND count($this->_field_data) === 0)
                {
                    return $default_value;
                }
                return '';
            }
        }
        else
        {
        $field = $this->_field_data[$field]['postdata'];
        }
        
        if (is_array($field))
        {
            if ( ! in_array($value, $field))
            {
                return '';
            }
        }
        else
        {
            if (($field == '' OR $value == '') OR ($field != $value))
            {
                return '';
            }
        }
            
        return $default_value;
    }
    
	/**
	 * Alpha
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
    
	function alpha_space($str)
	{
		$CI =& get_instance();
		$CI->form_validation->set_message('alpha_space',
            '%s field cannot contain numbers or special characters.');
		
		return ( ! preg_match("/^([a-z ])+$/i", $str)) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Alpha-numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	function alpha_sign($str)
	{
		$CI =& get_instance();
		$CI->form_validation->set_message('alpha_sign',
            '%s field can only contain alphabetical characters, plus(+) and minus(-) sign.');
		
		return ( ! preg_match("/^([a-z0-9\-+])+$/i", $str)) ? FALSE : TRUE;
	}

}
// END Form Validation Class

/* End of file Form_validation.php */
/* Location: ./system/libraries/Form_validation.php */