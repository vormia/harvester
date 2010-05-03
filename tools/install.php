<?php

/**
 * @file tools/install.php
 *
 * Copyright (c) 2005-2010 Alec Smecher and John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class installTool
 * @ingroup tools
 *
 * @brief CLI tool for installing Harvester2.
 *
 */

// $Id$


require(dirname(__FILE__) . '/bootstrap.inc.php');

import('lib.pkp.classes.cliTool.InstallTool');

class HarvesterInstallTool extends InstallTool {
	/**
	 * Constructor.
	 * @param $argv array command-line arguments
	 */
	function HarvesterInstallTool($argv = array()) {
		parent::InstallTool($argv);
	}

	/**
	 * Read installation parameters from stdin.
	 * FIXME: May want to implement an abstract "CLIForm" class handling input/validation.
	 * FIXME: Use readline if available?
	 */
	function readParams() {
		Locale::requireComponents(array(LOCALE_COMPONENT_PKP_INSTALLER, LOCALE_COMPONENT_APPLICATION_COMMON));
		printf("%s\n", Locale::translate('installer.harvester2Installation'));

		parent::readParams();

		$this->readParamBoolean('install', 'installer.installHarvester2');

		return $this->params['install'];
	}

}

$tool = new HarvesterInstallTool(isset($argv) ? $argv : array());
$tool->execute();

?>
