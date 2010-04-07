<?php

class Model_CommonPgm extends Itk_PgmAbstract
{
	protected $_programName = 'ZENDSVR/COMMONPGM';
	protected $_description = array(
		'CODE'	=> array(
			self::DESC_IO		=> I5_INOUT,
			self::DESC_TYPE		=> I5_TYPE_CHAR,
			self::DESC_LENGTH	=> "10"
		),
		'DESC'	=> array(
			self::DESC_IO		=> I5_INOUT,
			self::DESC_TYPE		=> I5_TYPE_CHAR,
			self::DESC_LENGTH	=> "10"
		)
	);
}