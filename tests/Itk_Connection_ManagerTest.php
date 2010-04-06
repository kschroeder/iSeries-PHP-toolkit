<?php

require_once 'library/Itk/Connection/Manager.php';
require_once 'library/Itk/Connection/AdapterAbstract.php';
require_once 'library/Itk/Connection/Adapter/Mock.php';
require_once 'library/Itk/PgmAbstract.php';
require_once 'library/Itk/Exception.php';
require_once 'library/Itk/Pgm/Exception.php';



require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Itk_Connection_Manager test case.
 */
class Itk_Connection_ManagerTest extends PHPUnit_Framework_TestCase
{
	
	public function testMockAdapter()
	{
		$mgr = new Itk_Connection_Manager(
			array(
				'adapter'		=> 'Mock',
				'programDir'	=> dirname(__FILE__).'/testdata/programs'
			)
		);
		$this->assertType('Itk_Connection_Adapter_Mock', $mgr->getAdapter());
	}

}

