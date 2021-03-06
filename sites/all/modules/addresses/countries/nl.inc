<?php
// $Id: nl.inc,v 1.7 2008/08/04 12:36:01 brmassa Exp $

/**
 * @file
 * "Netherlands" specific data
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
function addresses_province_list_nl() {
  return array(
    'DR' => t('Drenthe'),
    'FL' => t('Flevoland'),
    'FR' => t('Friesland'),
    'GE' => t('Gelderland'),
    'GR' => t('Groningen'),
    'LI' => t('Limburg'),
    'NB' => t('Noord Brabant'),
    'NH' => t('Noord Holland'),
    'OV' => t('Overijssel'),
    'UT' => t('Utrecht'),
    'ZE' => t('Zeeland'),
    'ZH' => t('Zuid Holland')
  );
}
