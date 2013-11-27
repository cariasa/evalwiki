<?php
App::uses('AppModel', 'Model');
/**
 * Page Model
 *
 */
class Page extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'page';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'page_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'page_title';

}
