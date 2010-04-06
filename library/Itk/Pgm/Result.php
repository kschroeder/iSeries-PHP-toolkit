<?php

class Itk_Pgm_Result
{
	protected $_results;
	
	public function __construct(array $results = array())
	{
		$this->_results = $results;	
	}
	
	public function __get($name)
	{
		if (isset($this->_results[$name])) {
			return $this->_results[$name];
		}
		return '';
	}
}