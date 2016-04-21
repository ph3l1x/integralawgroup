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
require_once 'CRM/Core/DAO.php';
require_once 'CRM/Utils/Type.php';
class CRM_Activity_DAO_Activity extends CRM_Core_DAO
{
    /**
     * static instance to hold the table name
     *
     * @var string
     * @static
     */
    static $_tableName = 'civicrm_activity';
    /**
     * static instance to hold the field values
     *
     * @var array
     * @static
     */
    static $_fields = null;
    /**
     * static instance to hold the FK relationships
     *
     * @var string
     * @static
     */
    static $_links = null;
    /**
     * static instance to hold the values that can
     * be imported / apu
     *
     * @var array
     * @static
     */
    static $_import = null;
    /**
     * static instance to hold the values that can
     * be exported / apu
     *
     * @var array
     * @static
     */
    static $_export = null;
    /**
     * static value to see if we should log any modifications to
     * this table in the civicrm_log table
     *
     * @var boolean
     * @static
     */
    static $_log = false;
    /**
     * Unique  Other Activity ID
     *
     * @var int unsigned
     */
    public $id;
    /**
     * Contact ID of the person scheduling or logging this Activity. Usually the authenticated user.
     *
     * @var int unsigned
     */
    public $source_contact_id;
    /**
     * Artificial FK to original transaction (e.g. contribution) IF it is not an Activity. Table can be figured out through activity_type_id, and further through component registry.
     *
     * @var int unsigned
     */
    public $source_record_id;
    /**
     * FK to civicrm_option_value.id, that has to be valid, registered activity type.
     *
     * @var int unsigned
     */
    public $activity_type_id;
    /**
     * The subject/purpose/short description of the activity.
     *
     * @var string
     */
    public $subject;
    /**
     * Date and time this activity is scheduled to occur. Formerly named scheduled_date_time.
     *
     * @var datetime
     */
    public $activity_date_time;
    /**
     * Date and time this activity is due.
     *
     * @var datetime
     */
    public $due_date_time;
    /**
     * Planned or actual duration of activity expressed in minutes. Conglomerate of former duration_hours and duration_minutes.
     *
     * @var int unsigned
     */
    public $duration;
    /**
     * Location of the activity (optional, open text).
     *
     * @var string
     */
    public $location;
    /**
     * Phone ID of the number called (optional - used if an existing phone number is selected).
     *
     * @var int unsigned
     */
    public $phone_id;
    /**
     * Phone number in case the number does not exist in the civicrm_phone table.
     *
     * @var string
     */
    public $phone_number;
    /**
     * Details about the activity (agenda, notes, etc).
     *
     * @var text
     */
    public $details;
    /**
     * ID of the status this activity is currently in. Foreign key to civicrm_option_value.
     *
     * @var int unsigned
     */
    public $status_id;
    /**
     * ID of the priority given to this activity. Foreign key to civicrm_option_value.
     *
     * @var int unsigned
     */
    public $priority_id;
    /**
     * Parent meeting ID (if this is a follow-up item). This is not currently implemented
     *
     * @var int unsigned
     */
    public $parent_id;
    /**
     *
     * @var boolean
     */
    public $is_test;
    /**
     * class constructor
     *
     * @access public
     * @return civicrm_activity
     */
    function __construct() 
    {
        parent::__construct();
    }
    /**
     * return foreign links
     *
     * @access public
     * @return array
     */
    function &links() 
    {
        if (!(self::$_links)) {
            self::$_links = array(
                'source_contact_id' => 'civicrm_contact:id',
                'phone_id' => 'civicrm_phone:id',
                'parent_id' => 'civicrm_activity:id',
            );
        }
        return self::$_links;
    }
    /**
     * returns all the column names of this table
     *
     * @access public
     * @return array
     */
    function &fields() 
    {
        if (!(self::$_fields)) {
            self::$_fields = array(
                'id' => array(
                    'name' => 'id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Activity ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'civicrm_activity.id',
                    'headerPattern' => '',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'source_contact_id' => array(
                    'name' => 'source_contact_id',
                    'type' => CRM_Utils_Type::T_INT,
                    'required' => true,
                ) ,
                'source_record_id' => array(
                    'name' => 'source_record_id',
                    'type' => CRM_Utils_Type::T_INT,
                ) ,
                'activity_type_id' => array(
                    'name' => 'activity_type_id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Activity Type ID') ,
                    'required' => true,
                    'import' => true,
                    'where' => 'civicrm_activity.activity_type_id',
                    'headerPattern' => '',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'subject' => array(
                    'name' => 'subject',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Subject') ,
                    'maxlength' => 255,
                    'size' => CRM_Utils_Type::HUGE,
                    'import' => true,
                    'where' => 'civicrm_activity.subject',
                    'headerPattern' => '',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'activity_date_time' => array(
                    'name' => 'activity_date_time',
                    'type' => CRM_Utils_Type::T_DATE+CRM_Utils_Type::T_TIME,
                    'title' => ts('Activity Date Time') ,
                    'import' => true,
                    'where' => 'civicrm_activity.activity_date_time',
                    'headerPattern' => '',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'due_date_time' => array(
                    'name' => 'due_date_time',
                    'type' => CRM_Utils_Type::T_DATE+CRM_Utils_Type::T_TIME,
                    'title' => ts('Due Date Time') ,
                ) ,
                'duration' => array(
                    'name' => 'duration',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Duration') ,
                    'import' => true,
                    'where' => 'civicrm_activity.duration',
                    'headerPattern' => '',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'location' => array(
                    'name' => 'location',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Location') ,
                    'maxlength' => 255,
                    'size' => CRM_Utils_Type::HUGE,
                    'import' => true,
                    'where' => 'civicrm_activity.location',
                    'headerPattern' => '',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'phone_id' => array(
                    'name' => 'phone_id',
                    'type' => CRM_Utils_Type::T_INT,
                ) ,
                'phone_number' => array(
                    'name' => 'phone_number',
                    'type' => CRM_Utils_Type::T_STRING,
                    'title' => ts('Phone Number') ,
                    'maxlength' => 64,
                    'size' => CRM_Utils_Type::BIG,
                ) ,
                'details' => array(
                    'name' => 'details',
                    'type' => CRM_Utils_Type::T_TEXT,
                    'title' => ts('Details') ,
                    'import' => true,
                    'where' => 'civicrm_activity.details',
                    'headerPattern' => '',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'status_id' => array(
                    'name' => 'status_id',
                    'type' => CRM_Utils_Type::T_INT,
                    'title' => ts('Activity Status Label') ,
                    'import' => true,
                    'where' => 'civicrm_activity.status_id',
                    'headerPattern' => '',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
                'priority_id' => array(
                    'name' => 'priority_id',
                    'type' => CRM_Utils_Type::T_INT,
                ) ,
                'parent_id' => array(
                    'name' => 'parent_id',
                    'type' => CRM_Utils_Type::T_INT,
                ) ,
                'is_test' => array(
                    'name' => 'is_test',
                    'type' => CRM_Utils_Type::T_BOOLEAN,
                    'title' => ts('Test') ,
                    'import' => true,
                    'where' => 'civicrm_activity.is_test',
                    'headerPattern' => '',
                    'dataPattern' => '',
                    'export' => true,
                ) ,
            );
        }
        return self::$_fields;
    }
    /**
     * returns the names of this table
     *
     * @access public
     * @return string
     */
    function getTableName() 
    {
        return self::$_tableName;
    }
    /**
     * returns if this table needs to be logged
     *
     * @access public
     * @return boolean
     */
    function getLog() 
    {
        return self::$_log;
    }
    /**
     * returns the list of fields that can be imported
     *
     * @access public
     * return array
     */
    function &import($prefix = false) 
    {
        if (!(self::$_import)) {
            self::$_import = array();
            $fields = &self::fields();
            foreach($fields as $name => $field) {
                if (CRM_Utils_Array::value('import', $field)) {
                    if ($prefix) {
                        self::$_import['activity'] = &$fields[$name];
                    } else {
                        self::$_import[$name] = &$fields[$name];
                    }
                }
            }
        }
        return self::$_import;
    }
    /**
     * returns the list of fields that can be exported
     *
     * @access public
     * return array
     */
    function &export($prefix = false) 
    {
        if (!(self::$_export)) {
            self::$_export = array();
            $fields = &self::fields();
            foreach($fields as $name => $field) {
                if (CRM_Utils_Array::value('export', $field)) {
                    if ($prefix) {
                        self::$_export['activity'] = &$fields[$name];
                    } else {
                        self::$_export[$name] = &$fields[$name];
                    }
                }
            }
        }
        return self::$_export;
    }
}