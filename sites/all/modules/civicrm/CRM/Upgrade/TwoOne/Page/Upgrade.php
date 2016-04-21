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
 * @copyright CiviCRM LLC (c) 2004-2008
 * $Id$
 *
 */

require_once 'CRM/Core/Page.php';
class CRM_Upgrade_TwoOne_Page_Upgrade extends CRM_Core_Page {

    function run( ) {
        for ( $i = 1; $i <= 4; $i++ ) {
            $this->runForm( $i );
        }
        
        echo "Upgrade Successful. \n";
        exit( );
    }

    function runForm( $stepID ) {
        require_once "CRM/Upgrade/TwoOne/Form/Step{$stepID}.php";
        $formName = "CRM_Upgrade_TwoOne_Form_Step{$stepID}";
        eval( "\$form = new $formName( );" );
        
        $error = null;
        if ( ! $form->verifyPreDBState( $error ) ) {
            if ( ! isset( $error ) ) {
                $error = 'pre-condition failed for current upgrade step $stepID';
            }
            CRM_Core_Error::fatal( $error );
        }

        if ( $stepID == 4 ) {
            return;
        }

        $form->upgrade( );

        if ( ! $form->verifyPostDBState( $error ) ) {
            if ( ! isset( $error ) ) {
                $error = 'post-condition failed for current upgrade step $stepID';
            }
            CRM_Core_Error::fatal( $error );
        }
    }

}
