<?php

require_once 'library/Itk/PgmAbstract.php';
require_once 'library/Itk/Connection/Manager.php';
require_once 'library/Itk/Connection/AdapterAbstract.php';
require_once 'library/Itk/Connection/Adapter/Mock.php';
require_once 'tests/testdata/classes/MockNoProgram.php';
require_once 'tests/testdata/classes/Mock.php';
require_once 'library/Itk/Exception.php';
require_once 'library/Itk/Pgm/Result.php';
require_once 'library/Itk/Connection/Exception.php';
require_once 'library/Itk/Connection/Adapter/Exception.php';
require_once 'library/Itk/Pgm/Exception.php';

require_once 'PHPUnit\Framework\TestCase.php';

class Itk_Connection_AdapterAbstractTest extends PHPUnit_Framework_TestCase
{

	/**
	 * 
	 * @var Itk_Connection_Manager
	 */
	
	private $_mgr;
	
	public function setup()
	{
		$this->_mgr = new Itk_Connection_Manager(
			array(
				'adapter'		=> 'Mock',
				'programDir'	=> dirname(__FILE__).'/testdata/programs'
			)
		);
		Itk_PgmAbstract::setDefaultAdapter($this->_mgr->getAdapter());
		parent::setup();
	}
	
	public function testGetProgram()
	{
		try {
			$this->_mgr->getProgram('Test_MockNoProgram');
			$this->assertTrue(false, 'A model without a programName defined must throw an exception');
		} catch (Itk_Exception $e) {}
		$mockTest = $this->_mgr->getProgram('Test_Mock');
		/* @var $mockTest Test_Mock */
		$this->assertType(
			'Test_Mock',
			$mockTest
		);
	}
	
	public function testFailUndefinedProperty()
	{
		$mockTest = $this->_mgr->getProgram('Test_Mock');
		
		try {
			$mockTest->TESTTEST = 'xyz101';
			$mockTest->execute();
			$this->assertTrue(false, 'A model that does not match ALL parameters should throw a Itk_Connection_Adapter_Exception with the Mock adapter');
		} catch (Itk_Pgm_Exception $e) {}
	
	}
	
	public function testExecuteProgramFail()
	{
		$mockTest = $this->_mgr->getProgram('Test_Mock');
		$mockTest->PROD_ID = 'xyz101';
		$mockTest->STORE_LOC = 'a1001';
		$mockTest->PRICE = 1; // This should fail for a mock adapter
		try {
			$mockTest->execute();
			$this->assertTrue(false, 'A model that does not match ALL parameters should throw a Itk_Connection_Adapter_Exception with the Mock adapter');
		} catch (Itk_Connection_Adapter_Exception $e) {}
	}
}

