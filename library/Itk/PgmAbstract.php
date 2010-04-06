<?php

abstract class Itk_PgmAbstract
{
	const DESC_IO 			= 'IO';
	const DESC_TYPE 		= 'Type';
	const DESC_LENGTH 		= 'Length';
	const DESC_COUNT 		= 'Count';
	const DESC_COUNTREF 	= 'CountRef';
	
	protected $_programName;
	protected $_resultType;
	protected $_data 		= array();
	protected $_description = array();
	protected $_return 		= array();
	
	/**
	 * 
	 * @var Itk_Connection_Manager
	 */
	
	protected $_connectionManager;
	
	/**
	 * 
	 * @var Itk_Connection_AdapterAbstract
	 */
	
	protected $_adapter;
	
	/**
	 * 
	 * @var Itk_Connection_AdapterAbstract
	 */
	
	private static $_defaultAdapter;
	
	public static function setDefaultAdapter(Itk_Connection_AdapterAbstract $adapter)
	{
		self::$_defaultAdapter = $adapter;
	}
	
	public function __get($name)
	{
		if (isset($this->_data[$name])) {
			return $this->_data[$name];
		}
		
		return '';
	}
	
	public function __set($key, $value)
	{
		if (!isset($this->_description[$key])) {
			throw new Itk_Pgm_Exception(sprintf('Missing property defintion for parameter "%s"', $key));
		}
		$this->_data[$key] = $value;
	}
	
	public function getProgramName()
	{
		if (!$this->_programName) {
			throw new Itk_Pgm_Exception('The program name must be specified');
		}
		return $this->_programName;
	}
	
	/**
	 * @return Itk_Connection_AdapterAbstract
	 */
	
	public function getDefaultAdapter()
	{
		return self::$_defaultAdapter;
	}
	
	public final function __construct(Itk_Connection_AdapterAbstract  $adapter = null)
	{
		if ($adapter === null && self::$_defaultAdapter === null) {
			throw new Itk_Exception('No adapter found');
		} else if ($adapter === null) {
			$adapter = self::$_defaultAdapter;
		}
		
		$this->_adapter = $adapter;
		$this->init();
	}
	
	public function init()
	{
	}
	
	public function setAdapter(Itk_Connection_AdapterAbstract $adapter)
	{
		$this->_adapter = $adapter;
	}
	
	/**
	 * @return Itk_Pgm_Result
	 */
	
	public function execute()
	{
		if (!$this->_adapter instanceof Itk_Connection_AdapterAbstract) {
			throw new Itk_Connection_Exception('Program object must be called from $adapter->getProgram("PGMNAM")');
		}
		$result = $this->_adapter->execute($this);
		if (!$result instanceof Itk_Pgm_Result) {
			throw new Itk_Pgm_Exception('Invalid result type');
		}
		return $result;
	}
	
	public function getParameterNames()
	{
		return array_keys($this->_data);
	}
	
	public function getDescription($name = null)
	{
		if ($name === null) {
			return $this->_description;
		}
		return $this->_description[$name];
	}
	
	public function getReturn()
	{
		if (!$this->_return) {
			$return = array_keys($this->_description);
			$this->_return = array_combine(
				$return,
				$return
			);
		}
		return $this->_return;
	}
}