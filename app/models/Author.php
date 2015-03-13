<?php
	/**
	* 
	*/
	class Author extends Eloquent
	{
		
		protected $table = 'mst_author';
		public $timestamps = false;
		protected $primaryKey = 'author_id';
	}
?>