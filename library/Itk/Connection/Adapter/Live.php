<?php

class Itk_Connection_Adapter_Live extends Itk_Connection_AdapterAbstract
{
	private $_res;
	
	public function init()
	{
		$this->_res = i5_connect(
			$this->_connectionManager->getOption('host'),
			$this->_connectionManager->getOption('username'),
			$this->_connectionManager->getOption('password')
		);
	}
	
	/**
	 * @param Itk_PgmAbstract $program
	 * @return Itk_Pgm_Result
	 */
	public function execute(Itk_PgmAbstract $program)
	{
		
		$prog = i5_program_prepare(
			$program->getProgramName(),
			$program->getDescription()
		);
		if ($prog === false) {
			throw new Itk_Connection_Adapter_Exception('Unable to prepare program: ' . i5_errormsg());
		}
		$returnValues = $program->getReturn();
		
		if (!i5_program_call($prog, $program->toArray(), $returnValues)) {
			throw new Itk_Connection_Adapter_Exception('Unable to execute program: ' . i5_errormsg());
		}
		$results = array();
		foreach ($returnValues as $var) {
			$results[$var] = $$var;
		}
		return new Itk_Pgm_Result($results);
	}

	
}