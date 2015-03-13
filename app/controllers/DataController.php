<?php
	/**
	* 
	*/
	class DataController extends BaseController
	{
		
		public function index()
		{
			$biblio = Biblio::where('gmd_id','=',44)->where('publish_year','>=',2013)->get();
			return View::make('rbtc.biblio')
						->with('data', $biblio);
		}

		public function full()
		{
			$biblio = Biblio::where('gmd_id','=',44)->where('publish_year','>=',2013)->get();
			$authors = array();			
			$count=0;
			foreach ($biblio as $key => $value) {
							//$author_id = BiblioAuthor::find($value->biblio_id);
							$author_id = BiblioAuthor::where('biblio_id','=', $value->biblio_id)->where('level','=',1)->get();
							$authors[$count] = (object) array("id"=>$value->biblio_id);
							if(count($author_id)>0) {
								$author = Author::find($author_id[0]->author_id);
								//$authors[$count]->namanrp = $author_id[0]->author_id;
								//$authors[$count]->nama = $author->author_name;
								//$authors[$count]->nrp = "null";
								$namanrp = explode("NRP", $author->author_name);
								//$authors[$count]->nama = count($namanrp);
								if(count($namanrp)>1) {
									$authors[$count]->nama = $namanrp[0];
									$authors[$count]->nrp = str_replace(' ', '', str_replace('.', '', $namanrp[1]));	
									//$authors[$count]->nrp = "null";
								}
								else{
									$authors[$count]->nama = $namanrp[0];
									$authors[$count]->nrp = "null";
								}	
								
							}
							else{
								$authors[$count]->nama = "null";
								$authors[$count]->nrp = "null";
							}
							
							
							
							$authors[$count]->tahun = $value->publish_year;
							$authors[$count]->judul = $value->title;
							$authors[$count]->abstraksi = $value->notes;
							$count++;
						}			
			return View::make('rbtc.ta')
						->with('data', $authors);
		}
	}
?>