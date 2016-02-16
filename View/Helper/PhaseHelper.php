<?php

/**
 * Phase Helper
 * Helps with all Phase related view tasks
 */
App::uses('AppHelper', 'View/Helper');

class PhaseHelper extends AppHelper
{

  public function getPhaseIcons() {
    return array("fa-graduation-cap", "fa-flag", "fa-fighter-jet", "fa-eye", "fa-flash");
  }
}
