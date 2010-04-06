<?php

// Used for testing on non-i systems
if (!defined('I5_TYPE_SHORT')) {
	define('I5_TYPE_SHORT', 1);
	define('I5_TYPE_LONG', 2);
	define('I5_TYPE_DOUBLE', 4);
	define('I5_TYPE_BIN', 5);
	define('I5_TYPE_DATE', 8);
	define('I5_TYPE_TIME', 9);
	define('I5_TYPE_TIMESTP', 10);
	define('I5_TYPE_DBCS', 11);
	define('I5_TYPE_LONG8', 13);
	define('I5_TYPE_NUMERICCHAR', 14);
	define('I5_TYPE_BLOB', 15);
	define('I5_TYPE_CLOB', 16);
	define('I5_TYPE_UNICODE', 17);
	define('I5_TYPE_VARCHAR', 19);
	define('I5_TYPE_VARBIN', 20);
	define('I5_IN', 1);
	define('I5_OUT', 2);
	define('I5_INOUT', 3);
}


class Itk_Connection_Adapter_Mock extends Itk_Connection_AdapterAbstract
{
	private $_programDir;
	
	public function init()
	{
		$this->_programDir = $this->_connectionManager->getOption('programDir');
		if (!$this->_programDir) {
			throw new Itk_Connection_Exception('Missing "programDir" setting for the Mock adapter.  This is needed to retrieve the expected responses for a program');
		} else if (!file_exists($this->_programDir) || !is_dir($this->_programDir)) {
			throw new Itk_Connection_Exception('"programDir" setting must be a valid directory');
		}
	}
	
	/**
	 * @param Itk_PgmAbstract $program
	 */
	public function execute(Itk_PgmAbstract $program)
	{
		$name = get_class($program);
		$name = substr($name, strrpos($name, '_') + 1);
		$sXml = simplexml_load_file($this->_programDir . '/' . $name . '.xml');
		$nodes = $sXml->xpath(sprintf('/calls/call[@name="%s"]', $program->getProgramName()));
		
		foreach ($nodes as $node) {
			
			foreach ($node->params->param as $param) {
				$pName = (string)$param['name'];
				$param = (string)$param;
				if ($program->$pName != $param) {
					continue 2;
				}
			}
			$results = array();
			foreach ($node->returns->return as $return) {
				$results[(string)$return['name']] = (string)$return;
			}
			return new Itk_Pgm_Result($results);
		}
		
		throw new Itk_Connection_Adapter_Exception('Unable to find mock data result');
	}

	
}