<?php

/*
 +--------------------------------------------------------------------+
 | CiviCRM version 2.1                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2008                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007.                                       |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License along with this program; if not, contact CiviCRM LLC       |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*/

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2007
 * $Id$
 *
 */

require_once 'CRM/Core/Form.php';

/**
 * form to process actions on the field aspect of Custom
 */
class CRM_Custom_Form_Option extends CRM_Core_Form {
    /**
     * the custom group id saved to the session for an update
     *
     * @var int
     * @access protected
     */
    protected $_fid;

    /**
     * The option group ID 
     */
    protected $_optionGroupID = null;

    /**
     * The Option id, used when editing the Option
     *
     * @var int
     * @access protected
     */
    protected $_id;


    /**
     * Function to set variables up before form is built
     * 
     * @param null
     * 
     * @return void
     * @access public
     */
    public function preProcess()
    {
        $this->_fid = CRM_Utils_Request::retrieve('fid', 'Positive',
                                                  $this);
        if ( $this->_fid ) {
            $this->_optionGroupID = CRM_Core_DAO::getFieldValue( 'CRM_Core_DAO_CustomField',
                                                                 $this->_fid,
                                                                 'option_group_id' );
            
        }

        $this->_id  = CRM_Utils_Request::retrieve('id' , 'Positive',
                                                  $this);
    }

    /**
     * This function sets the default values for the form. Note that in edit/view mode
     * the default values are retrieved from the database
     * 
     * @param null
     * 
     * @return array   array of default values
     * @access public
     */
    function setDefaultValues()
    {
        $defaults = array();
        $fieldDefaults = array();
        if ( isset( $this->_id ) ) {
            $params = array('id' => $this->_id);
            CRM_Core_BAO_CustomOption::retrieve($params, $defaults);

            $paramsField = array('id' => $this->_fid);            
            CRM_Core_BAO_CustomField::retrieve($paramsField, $fieldDefaults);

            if ( $fieldDefaults['html_type'] == 'CheckBox' || $fieldDefaults['html_type'] == 'Multi-Select' ) {
                $defaultCheckValues = explode(CRM_Core_BAO_CustomOption::VALUE_SEPERATOR,
                                              substr( $fieldDefaults['default_value'], 1, -1 ) );
                if ( in_array($defaults['value'], $defaultCheckValues ) ) 
                    $defaults['default_value'] = 1;
            } else {
                if( CRM_Utils_Array::value( 'default_value', $fieldDefaults ) == CRM_Utils_Array::value( 'value', $defaults ) ) {
                    $defaults['default_value'] = 1;
                }               
            }
        } else {
            $defaults['is_active'] = 1;
        }
      
        require_once 'CRM/Core/DAO.php';
        if ($this->_action & CRM_Core_Action::ADD) {
            $fieldValues = array( 'option_group_id' => $this->_optionGroupID );
            $defaults['weight'] = CRM_Utils_Weight::getDefaultWeight('CRM_Core_DAO_OptionValue', $fieldValues);
        }

        return $defaults;
    }
    
    /**
     * Function to actually build the form
     * 
     * @param null
     * 
     * @return void
     * @access public
     */
    public function buildQuickForm()
    {
        if ($this->_action == CRM_Core_Action::DELETE) {
            $this->addButtons( array(
                                     array ( 'type'      => 'next',
                                             'name'      => ts('Delete'),
                                             'isDefault' => true   ),
                                     array ( 'type'      => 'cancel',
                                             'name'      => ts('Cancel') ),
                                     )
                               );
        } else {
            // lets trim all the whitespace
            $this->applyFilter('__ALL__', 'trim');
            
            // hidden Option Id for validation use
            $this->add('hidden', 'optionId', $this->_id);
            
            //hidden field ID for validation use
            $this->add('hidden', 'fieldId', $this->_fid); 
        
            
            // label
            $this->add('text', 'label', ts('Option Label'), CRM_Core_DAO::getAttribute('CRM_Core_DAO_OptionValue', 'label'), true);
            
            $this->add('text', 'value', ts('Option Value'), CRM_Core_DAO::getAttribute('CRM_Core_DAO_OptionValue', 'value'), true);
        
            // the above value is used directly by QF, so the value has to be have a rule
            // please check with Lobo before u comment this
            $this->addRule('value', ts('Please enter a valid value for this field. You may use a - z, A - Z, 1 - 9, spaces and underline ( _ ) characters. The length of the variable string should be less than 31 characters'), 'qfVariable');

            // weight
            $this->add('text', 'weight', ts('Weight'), CRM_Core_DAO::getAttribute('CRM_Core_DAO_OptionValue', 'weight'), true);
            $this->addRule('weight', ts('is a numeric field') , 'numeric');
        
            // is active ?
            $this->add('checkbox', 'is_active', ts('Active?'));
            
            // Set the default value for Custom Field
            $this->add('checkbox', 'default_value', ts('Default'));

            // add a custom form rule
            $this->addFormRule( array( 'CRM_Custom_Form_Option', 'formRule' ), $this );
            
            // add buttons
            $this->addButtons(array(
                                    array ('type'      => 'next',
                                           'name'      => ts('Save'),
                                           'isDefault' => true),
                                    array ('type'      => 'cancel',
                                           'name'      => ts('Cancel')),
                                    )
                              );
            
            
            // if view mode pls freeze it with the done button.
            if ($this->_action & CRM_Core_Action::VIEW) {
                $this->freeze();
                $this->addElement('button', 'done', ts('Done'), array('onclick' => "location.href='civicrm/admin/custom/group/field/option?reset=1&action=browse&fid=" . $this->_fid . "'"));
            }
        }
    }
        
    /**
     * global validation rules for the form
     *
     * @param array $fields posted values of the form
     *
     * @return array list of errors to be posted back to the form
     * @static
     * @access public
     */
    static function formRule( &$fields, &$files, &$form ) {

        $optionLabel   = CRM_Utils_Type::escape( $fields['label'], 'String' );
        $optionValue   = CRM_Utils_Type::escape( $fields['value'], 'String' );
        $fieldId       = $form->_fid;
        $optionGroupId = $form->_optionGroupID;

        $temp = array();
        if ( empty( $form->_id ) ) {
            $query = "
SELECT count(*) 
  FROM civicrm_option_value
 WHERE option_group_id = %1
   AND label = %2";
            $params = array( 1 => array( $optionGroupId, 'Integer' ),
                             2 => array( $optionLabel  , 'String'  ) );
            if ( CRM_Core_DAO::singleValueQuery( $query, $params ) > 0 ) {   
                $errors['label'] = ts('There is an entry with the same label.');
            }
            
            $query = "
SELECT count(*) 
  FROM civicrm_option_value
 WHERE option_group_id = %1
   AND value = %2";
            $params = array( 1 => array( $optionGroupId, 'Integer' ),
                             2 => array( $optionValue  , 'String'  ) );
            if ( CRM_Core_DAO::singleValueQuery( $query, $params ) > 0 ) {   
                $errors['value'] = ts('There is an entry with the same value.');
            }
                
        } else {
            //capture duplicate entries while updating Custom Options
            $optionId = CRM_Utils_Type::escape( $fields['optionId'], 'Integer' );

            //check label duplicates within a custom field
            $query = "
SELECT count(*) 
  FROM civicrm_option_value
 WHERE option_group_id = %1
   AND id != %2
   AND label = %3";
            $params = array( 1 => array( $optionGroupId, 'Integer' ),
                             2 => array( $optionId     , 'Integer' ),
                             3 => array( $optionLabel  , 'String'  ) );
            if ( CRM_Core_DAO::singleValueQuery( $query, $params ) > 0 ) {   
                $errors['label'] = ts('There is an entry with the same label.');
            }
            
            //check value duplicates within a custom field
            $query = "
SELECT count(*) 
  FROM civicrm_option_value
 WHERE option_group_id = %1
   AND id != %2
   AND value = %3";
            $params = array( 1 => array( $optionGroupId, 'Integer' ),
                             2 => array( $optionId     , 'Integer' ),
                             3 => array( $optionValue  , 'String'  ) );
            if ( CRM_Core_DAO::singleValueQuery( $query, $params ) > 0 ) {   
                $errors['value'] = ts('There is an entry with the same value.');
            }
        }

        $query = "
SELECT data_type 
  FROM civicrm_custom_field
 WHERE id = %1";
        $params = array( 1 => array( $fieldId, 'Integer' ) );
        $dao =& CRM_Core_DAO::executeQuery( $query, $params );
        if ( $dao->fetch( ) ) {
            switch ( $dao->data_type ) {
            case 'Int':
                if ( ! CRM_Utils_Rule::integer( $fields["value"] ) ) {
                    $errors['value'] = ts( 'Please enter a valid integer value.' );
                }
                break;

            case 'Float':
                //     case 'Money':
                if ( ! CRM_Utils_Rule::numeric( $fields["value"] ) ) {
                    $errors['value'] = ts( 'Please enter a valid number value.' );
                }
                break;
            case 'Money':
                if ( ! CRM_Utils_Rule::money( $fields["value"] ) ) {
                    $errors['value'] = ts( 'Please enter a valid value.' );
                }
                break;
                    
            case 'Date':
                if ( ! CRM_Utils_Rule::date( $fields["value"] ) ) {
                    $errors['value'] = ts ( 'Please enter a valid date using YYYY-MM-DD format. Example: 2004-12-31.' );
                }
                break;

            case 'Boolean':
                if ( ! CRM_Utils_Rule::integer( $fields["value"] ) &&
                     ( $fields["value"] != '1' || $fields["value"] != '0' ) ) {
                    $errors['value'] = ts( 'Please enter 1 or 0 as value.' );
                }
                break;

            case 'Country':
                if( !empty($fields["value"]) ) {
                    $fieldCountry = addslashes( $fields['value'] );
                    $query = "SELECT count(*) FROM civicrm_country WHERE name = '$fieldCountry' OR iso_code = '$fieldCountry'";
                    if ( CRM_Core_DAO::singleValueQuery( $query,$temp ) <= 0 ) {
                        $errors['value'] = ts( 'Invalid default value for country.' );
                    }
                }
                break;

            case 'StateProvince':
                if( !empty($fields["value"]) ) {
                    $fieldStateProvince = addslashes( $fields['value'] );
                    $query = "SELECT count(*) FROM civicrm_state_province WHERE name = '$fieldStateProvince' OR abbreviation = '$fieldStateProvince'";
            
                    if ( CRM_Core_DAO::singleValueQuery( $query ,$temp) <= 0 ) {
                        $errors['value'] = ts( 'The invalid value for State/Province data type' );
                    }
                }
                break;
            }
        }

        return empty($errors) ? true : $errors;
    }

    /**
     * Process the form
     * 
     * @param null
     * 
     * @return void
     * @access public
     */

    public function postProcess()
    {
        // store the submitted values in an array
        $params = $this->controller->exportValues('Option');

        // set values for custom field properties and save
        require_once 'CRM/Core/DAO/OptionValue.php';
        $customOption                =& new CRM_Core_DAO_OptionValue();
        $customOption->label         = $params['label'];
        $customOption->weight        = $params['weight'];
        $customOption->value         = $params['value'];
        $customOption->is_active     = CRM_Utils_Array::value( 'is_active', $params, false );
       
        if ($this->_action == CRM_Core_Action::DELETE) {
            $fieldValues = array( 'option_group_id' => $this->_optionGroupID );
            $wt = CRM_Utils_Weight::delWeight('CRM_Core_DAO_OptionValue', $this->_id, $fieldValues);
            CRM_Core_BAO_CustomOption::del($this->_id);
            CRM_Core_Session::setStatus(ts('Your multiple choice option has been deleted', array(1 => $customOption->label)));
            return;
        }

        if ($this->_action & CRM_Core_Action::UPDATE) {
            $customOption->id = $this->_id;
            CRM_Core_BAO_CustomOption::updateCustomValues($params);
        }
        if ($this->_id) {
            $oldWeight = CRM_Core_DAO::getFieldValue( 'CRM_Core_DAO_OptionValue', $this->_id, 'weight', 'id' );
        }

        $fieldValues = array( 'option_group_id' => $this->_optionGroupID );
        $customOption->weight = 
            CRM_Utils_Weight::updateOtherWeights('CRM_Core_DAO_OptionValue', $oldWeight, $params['weight'], $fieldValues);
        
        $customOption->option_group_id = $this->_optionGroupID;
        
        $customField =& new CRM_Core_DAO_CustomField();
        $customField->id = $this->_fid;
        if ( $customField->find( true ) &&
             ( $customField->html_type == 'CheckBox' ||
               $customField->html_type == 'Multi-Select' ) ) {
            $defVal = explode(CRM_Core_BAO_CustomOption::VALUE_SEPERATOR,
                              substr( $customField->default_value, 1, -1 ) );
            if ( CRM_Utils_Array::value( 'default_value', $params ) ) {
                if ( !in_array($customOption->value, $defVal) ) {
                    if ( empty( $defVal[0] ) ) {
                        $defVal = array( $customOption->value );
                    } else {
                        $defVal[] = $customOption->value;
                    }
                    $customField->default_value =
                        CRM_Core_BAO_CustomOption::VALUE_SEPERATOR . 
                        implode(CRM_Core_BAO_CustomOption::VALUE_SEPERATOR, $defVal) .
                        CRM_Core_BAO_CustomOption::VALUE_SEPERATOR;
                    $customField->save();
                }
            } else if ( in_array($customOption->value, $defVal) ) {
                $tempVal = array();
                foreach ($defVal as $v ) {
                    if ($v != $customOption->value) {
                        $tempVal[] = $v;
                    }
                }

                $customField->default_value =
                    CRM_Core_BAO_CustomOption::VALUE_SEPERATOR . 
                    implode(CRM_Core_BAO_CustomOption::VALUE_SEPERATOR, $tempVal) .
                    CRM_Core_BAO_CustomOption::VALUE_SEPERATOR;
                $customField->save(); 
            }           
        } else {            
            if ( CRM_Utils_Array::value( 'default_value', $params ) ) {
                $customField->default_value = $customOption->value;
                $customField->save();
            } else if ( $customField->find( true ) && $customField->default_value == $customOption->value ) {
                // this is the case where this option is the current default value and we have been reset
                $customField->default_value = 'null';
                $customField->save(); 
            }
        }

        $customOption->save();
        
        
        CRM_Core_Session::setStatus(ts('Your multiple choice option \'%1\' has been saved', array(1 => $customOption->label)));
    }
}
