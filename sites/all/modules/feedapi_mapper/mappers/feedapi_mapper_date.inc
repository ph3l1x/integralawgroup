<?php
// $Id: feedapi_mapper_date.inc,v 1.1.2.2 2008/02/28 22:04:44 alexb Exp $

/**
 * Implementation of hook_feedapi_mapper for date field from content.module (CCK),
 *
 * @param string $op
 * @param Drupal node $node
 * @param string $field_name
 * @param string, number or array of string or number $feed_element
 * @param string or number as id $sub_field
 * 
 */
function date_feedapi_mapper($op, $node, $field_name, $feed_element = array(), $sub_field = '') {
  if (!$field = feedapi_mapper_content_is_cck_type($field_name, array('date', 'datestamp', 'datetime'))) {
    // if not a date just return
    return;
  }

  switch ($op) {
    case 'describe':
      // Describe what we are doing in this mapper. This shows up as help text on the mapping page. 
      return t('Maps a date to a date CCK field.');
    
    case 'list':
      return array(
        'single' => t('Simple date'),
        'from' => t('From date'),
        'to' => t('To date'),
        // 'ical' => 'iCal array of dates', // maybe?
      );
    
    case 'map':
      include_once(drupal_get_path('module', 'date_api') .'/date_api_ical.inc');
      $feed_element = unserialize($feed_element);
      $date = date_ical_date($feed_element);
      $timezone = $feed_element['tz'];
      $db_tz = date_get_timezone_db($field['tz_handling'], $timezone);
      $to_tz = date_get_timezone($field['tz_handling'], $timezone);
      date_timezone_set($date, timezone_open($db_tz));
      
      switch ($field['type']) {
        case DATE_ISO:
          $format = DATE_FORMAT_ISO;
          break;
        case DATE_UNIX:
          $format = DATE_FORMAT_UNIX;
          break;
        case DATE_DATETIME:
          $format = DATE_FORMAT_DATETIME;
          break;
      }
      
      if ($formatted = date_format($date, $format)) {
        if ($sub_field == 'to') {
          $value_field = 'value2';
          $offset_field = 'offset2';
        }
        else {
          $value_field = 'value';
          $offset_field = 'offset';
        }
        // Create node field information.
        $items = isset($node->$field_name) ? $node->$field_name : array();
        $items[0][$value_field] = $formatted;
        if ($field['tz_handling'] == 'date') {
          $items[0]['timezone'] = $to_tz;
          date_timezone_set($date, timezone_open($to_tz));
          $items[0][$offset_field] = date_offset_get($date);
        }
        $node->$field_name = $items;
      }
      return $node;
  }
}
