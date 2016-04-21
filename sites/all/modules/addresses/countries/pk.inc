<?php
// $Id: pk.inc,v 1.7 2008/08/04 12:36:01 brmassa Exp $

/**
 * @file
 * "Pakistan" specific data
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
function addresses_province_list_pk() {
  return array(
    'B' => t('Balochistan'),
    'T' => t('Federally Administered Tribal Areas'),
    'I' => t('Islamabad Capital Territory'),
    'N' => t('North-West Frontier Province'),
    'P' => t('Punjab'),
    'S' => t('Sindh')
  );
}
