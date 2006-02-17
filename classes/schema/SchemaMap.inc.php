<?php

/**
 * SchemaMap.inc.php
 *
 * Copyright (c) 2005-2006 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package schemas
 *
 * Provides methods for accessing the schema map.
 *
 * $Id$
 */

define('SCHEMA_MAP_REGISTRY_FILE', Config::getVar('general', 'registry_dir') . '/schemaMap.xml');

class SchemaMap {
	/**
	 * Constructor.
	 */
	function SchemaMap() {
	}

	function &_getSchemaMapCache() {
		static $cache;
		if (!isset($cache)) {
			import('cache.CacheManager');
			$cacheManager =& CacheManager::getManager();
			$cache =& $cacheManager->getFileCache(
				'schema', 'map',
				array('SchemaMap', '_schemaMapCacheMiss')
			);

			// Check to see if the data is outdated
			$cacheTime = $cache->getCacheTime();
			if ($cacheTime !== null && $cacheTime < filemtime(SCHEMA_MAP_REGISTRY_FILE)) {
				$cache->flush();
			}
		}
		return $cache;
	}

	function _schemaMapCacheMiss(&$cache, $id) {
		static $schemaMap;
		if (!isset($schemaMap)) {
			// Add a locale load to the debug notes.
			$notes =& Registry::get('system.debug.notes');
			$notes[] = array('debug.notes.schemaMapLoad', array('schemaMap' => SCHEMA_MAP_REGISTRY_FILE));

			// Reload schema map file
			$xmlDao = &new XMLDAO();
			$schemaMapHandler =& new SchemaMapHandler();
			$schemaMap =& $xmlDao->parseWithHandler(SCHEMA_MAP_REGISTRY_FILE, $schemaMapHandler);
			asort($schemaMap);
			$cache->setEntireCache($schemaMap);
		}
		return null;
	}

	/**
	 * Return the schema map.
	 * @return array
	 */
	function &getSchemaMap() {
		$cache =& SchemaMap::_getSchemaMapCache();
		return $cache->getContents();
	}

	/**
	 * Given a harvester plugin name and an alias, get the name
	 * of the associated schema plugin from the schema map.
	 * @param $harvesterPluginName string
	 * @param $schemaAlias string
	 * @return string
	 */
	function getSchemaPluginName($harvesterPluginName, $schemaAlias) {
		$schemaMap =& SchemaMap::getSchemaMap();
		foreach ($schemaMap as $entry) {
			if ($entry[1] === $harvesterPluginName && $entry[2] === $schemaAlias) return $entry[0];
		}
		return null;
	}

	function &getSchemaPlugin($harvesterPluginName, $schemaAlias) {
		$schemaPluginName = SchemaMap::getSchemaPluginName($harvesterPluginName, $schemaAlias);
		$plugins =& PluginRegistry::loadCategory('schemas');
		if (isset($plugins[$schemaPluginName])) {
			return $plugins[$schemaPluginName];
		}
		fatalError("Unknown schema plugin \"$schemaPluginName!\"\n");
	}
}

class SchemaMapHandler extends XMLParserHandler {
	var $result;
	var $currentSchemaPlugin;
	var $currentHarvesterPlugin;
	var $characterData;

	function SchemaMapHandler() {
		$this->result = array();
	}

	function startElement(&$parser, $tag, $attributes) {
		$this->characterData = '';
		switch ($tag) {
			case 'schema':
				$this->currentSchemaPlugin = $attributes['plugin'];
				break;
			case 'alias':
				$this->currentHarvesterPlugin = $attributes['harvester'];
		}
	}
	function endElement(&$parser, $tag) {
		switch ($tag) {
			case 'alias':
				$schemaPlugin = $this->currentSchemaPlugin;
				$harvesterPlugin = $this->currentHarvesterPlugin;
				$schemaAlias = $this->characterData;

				$this->result[] = array(
					$schemaPlugin,
					$harvesterPlugin,
					$schemaAlias
				);
				break;
		}
	}
	function characterData(&$parser, $data) {
		$this->characterData .= $data;
	}
	function &getResult() {
		return $this->result;
	}
}

?>
