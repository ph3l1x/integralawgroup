<?php
// $Id: sj.inc,v 1.7 2008/08/04 12:36:01 brmassa Exp $

/**
 * @file
 * "Svalbard and Jan Mayen" specific data
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
function addresses_province_list_sj() {
  return array(
  );
}