<?php

class Test_Mock extends Itk_PgmAbstract
{
	protected $_programName = 'USERLIB/USERPGM';
	protected $_description = array(
		'PROD_ID' => array(
			self::DESC_TYPE 	=> I5_TYPE_VARCHAR,
			self::DESC_IO 		=> I5_IN,
			self::DESC_LENGTH 	=> 15
		),
		'STORE_LOC' => array(
			self::DESC_TYPE 	=> I5_TYPE_VARCHAR,
			self::DESC_IO 		=> I5_IN,
			self::DESC_LENGTH 	=> 15
		),
		'PRICE' 	=> array(
			self::DESC_TYPE 	=> I5_TYPE_PACKED,
			self::DESC_IO 		=> I5_INOUT,
			self::DESC_LENGTH 	=> "5.2"
		)
	);
	protected $_return = array(
		'PROD_ID'	=> 'PROD_ID',
	    'STORE_LOC'	=> 'STORE_LOC',
	    'PRICE'		=> 'AMOUNT'
	);
}