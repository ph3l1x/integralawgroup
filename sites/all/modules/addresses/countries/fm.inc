<?php
// $Id: fm.inc,v 1.7 2008/08/04 12:36:01 brmassa Exp $

/**
 * @file
 * "Micronesia, Federated States of" specific data
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
function addresses_province_list_fm() {
  return array(
    'C' => t('Chuuk'),
    'K' => t('Kosrae'),
    'P' => t('Pohnpei'),
    'Y' => t('Yap')
  );
}
