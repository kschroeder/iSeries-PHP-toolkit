<?php

class Itk_Connection_Manager
{
	/**
	 * 
	 * @var Itk_Connection_AdapterAbstract
	 */
	
	protected $_adapter;
	protected $_options;
	
	public function __construct($options = array())
	{
		$type = isset($options['adapter'])?$options['adapter']:'Live';
		$prefix = isset($options['typePrefix'])?$options['typePrefix']:'Itk_Connection_Adapter_';
		
		$className = "{$prefix}{$type}";
		
		$this->_options = $options;
		$this->_adapter = new $className($this); 
	}
	
	public function getProgram($name)
	{
		return $this->_adapter->getProgram($name);
	}
	
	public function getOption($name)
	{
		if (isset($this->_options[$name])) {
			return $this->_options[$name];
		}
		return '';
	}
	
	/**
	 * @return Itk_Connection_AdapterAbstract
	 */
	
	public function getAdapter()
	{
		return $this->_adapter;
	}
	
}