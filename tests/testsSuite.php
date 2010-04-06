<?php

require_once 'PHPUnit\Framework\TestSuite.php';

require_once 'tests\Itk_Connection_AdapterAbstractTest.php';

require_once 'tests\Itk_Connection_ManagerTest.php';

require_once 'tests\Test_MockTest.php';
require_once 'tests\Test_CommonPgmTest.php';

/**
 * Static test suite.
 */
class testsSuite extends PHPUnit_Framework_TestSuite {
	
	/**
	 * Constructs the test suite handler.
	 */
	public function __construct() {
		$this->setName ( 'testsSuite' );
		
		$this->addTestSuite ( 'Itk_Connection_AdapterAbstractTest' );
		
		$this->addTestSuite ( 'Itk_Connection_ManagerTest' );
		
		$this->addTestSuite ( 'Test_MockTest' );
		
		$this->addTestSuite ( 'Test_CommonPgmTest' );
	
	}
	
	/**
	 * Creates the suite.
	 */
	public static function suite() {
		return new self ();
	}
}

