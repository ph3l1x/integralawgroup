<?php
// $Id: sb.inc,v 1.7 2008/08/04 12:36:01 brmassa Exp $

/**
 * @file
 * "Solomon Islands" specific data
 */

/**
 * Implementation of hook_province_list().
 *
 * Its a hook from Addresses module to list all
 * states/provinces/teritories of a given country
 *
 * @return
 *   Array. states where the keys are the state
 *   code and the value is the state name
 */
function addresses_province_list_sb() {
  return array(
    'CE' => t('Central'),
    'CH' => t('Choiseul'),
    'GC' => t('Guadalcanal'),
    'HO' => t('Honiara'),
    'IS' => t('Isabel'),
    'MK' => t('Makira'),
    'ML' => t('Malaita'),
    'RB' => t('Rennell and Bellona'),
    'TM' => t('Temotu'),
    'WE' => t('Western')
  );
}
