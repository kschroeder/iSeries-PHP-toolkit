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
require_once 'tests\testdata\classes\CommonPgm.php';

require_once 'PHPUnit\Framework\TestCase.php';

/**
 * Test_CommonPgm test case.
 */
class Test_CommonPgmTest extends PHPUnit_Framework_TestCase
{
	public function testCommonPgm()
	{
		
		if (!function_exists('i5_connect')) {
			$this->markTestIncomplete('This test must be run on an i5 system');
			return;
		}
		$mgr = new Itk_Connection_Manager(
			array(
				'adapter'		=> 'Live',
				'username'		=> '',
				'password'		=> '',
				'host'			=> '127.0.0.1'			
			)
		);
		Itk_PgmAbstract::setDefaultAdapter($mgr->getAdapter());
		
		$m = new Test_CommonPgm();
		$m->CODE = 2;
		$res = $m->execute();
		$this->assertEquals(
			'Zend',
			$res->DESC
		);
		
	}
}

