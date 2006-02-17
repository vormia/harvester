<?php

/**
 * Record.inc.php
 *
 * Copyright (c) 2005-2006 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package record
 *
 * Record class.
 * Describes basic record properties.
 *
 * $Id$
 */

class Record extends DataObject {
	/**
	 * Constructor.
	 */
	function Record() {
		parent::DataObject();
	}
	
	//
	// Get/set methods
	//
	
	/**
	 * Get identifier for record
	 * @return string
	 */
	 function getIdentifier() {
	 	return $this->getData('identifier');
	}
	
	/**
	 * Set identifier for record
	 * @param $identifier string
	 */
	function setIdentifier($identifier) {
		return $this->setData('identifier',$identifier);
	}

	/**
	 * Get datestamp of record
	 * @return string
	 */
	 function getDatestamp() {
	 	return $this->getData('datestamp');
	}
	
	/**
	 * Set datestamp of record
	 * @param $datestamp string
	 */
	function setDatestamp($datestamp) {
		return $this->setData('datestamp',$datestamp);
	}

	/**
	 * Get ID of record.
	 * @return int
	 */
	function getRecordId() {
		return $this->getData('recordId');
	}
	
	/**
	 * Set ID of record.
	 * @param $recordId int
	 */
	function setRecordId($recordId) {
		return $this->setData('recordId', $recordId);
	}

	/**
	 * Get ID of archive.
	 * @return int
	 */
	function getArchiveId() {
		return $this->getData('archiveId');
	}
	
	/**
	 * Set ID of archive.
	 * @param $archiveId int
	 */
	function setArchiveId($archiveId) {
		return $this->setData('archiveId', $archiveId);
	}
}

?>
