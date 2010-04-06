<?php

abstract class Itk_Connection_AdapterAbstract
{
	
	/**
	 * 
	 * @var Itk_Connection_Manager
	 */
	protected $_connectionManager;
	
	public function __construct(Itk_Connection_Manager $mgr)
	{
		$this->_connectionManager = $mgr;
		$this->init();
	}
	
	public function init()
	{
	}
	
	/**
	 * 
	 * @param Itk_PgmAbstract|string $class
	 * @return Itk_PgmAbstract
	 */
	
	public function getProgram($class)
	{
		if (is_string($class)) {
			$class = new $class($this);
		}
		
		if ($class instanceof Itk_PgmAbstract) {
			$class->getProgramName(); // Validation check
		} else {
			throw new Itk_Pgm_Exception(sprintf('Unable to find program "%s"', $class));
		}
		return $class;
	}
	
	/**
     * @return Itk_Connection_Manager
	 */
	
	public function getConnectionManager()
	{
		return $this->_connectionManager;
	}
	
	public abstract function execute(Itk_PgmAbstract $program);
}