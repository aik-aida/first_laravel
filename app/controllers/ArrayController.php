<?php
	/**
	* 
	*/
	class ArrayController extends BaseController
	{
		
		public function index()
		{
			$array = (object) array( "nama",
									 "nrp",
									 "makanan"=>array(),
									 "minuman"=>array()
									);
			$array->nama= "Aida Muflichah";
			$array->nrp="5111100020";
			array_push($array->makanan, "kentang");
			array_push($array->makanan, "mie");
			array_push($array->makanan, "telor");
			array_push($array->minuman, "susu");
			array_push($array->minuman, "air");
			array_push($array->minuman, "jeruk");
			return View::make('array')
					->with('data', $array);
		}
	}
?>