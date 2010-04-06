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

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Test_Mock test case.
 */
class Test_MockTest extends PHPUnit_Framework_TestCase
{
	
	public function testExecuteProgram()
	{
		$mgr = new Itk_Connection_Manager(
			array(
				'adapter'		=> 'Mock',
				'programDir'	=> dirname(__FILE__).'/testdata/programs'
			)
		);
		$mockTest = $mgr->getProgram('Test_Mock');
		$mockTest->PROD_ID = 'xyz101';
		$mockTest->STORE_LOC = 'a1001';
		$mockTest->PRICE = 0;
		
		$res = $mockTest->execute();
		$this->assertType(
			'Itk_Pgm_Result',
			$res
		);
		$this->assertEquals(
			$res->AMOUNT,
			10.99
		);
	}
	
	public function testExecuteProgramWithDefaultAdapter()
	{
		$mgr = new Itk_Connection_Manager(
			array(
				'adapter'		=> 'Mock',
				'programDir'	=> dirname(__FILE__).'/testdata/programs'
			)
		);
		Itk_PgmAbstract::setDefaultAdapter($mgr->getAdapter());
		$mockTest =  new Test_Mock();
		$mockTest->PROD_ID = 'xyz101';
		$mockTest->STORE_LOC = 'a1001';
		$mockTest->PRICE = 0;
		
		$res = $mockTest->execute();
		$this->assertType(
			'Itk_Pgm_Result',
			$res
		);
		$this->assertEquals(
			$res->AMOUNT,
			10.99
		);
	}

}

