<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('about', function()
{
	return View::make('about')->with('nama', '-AIDA-');
});

Route::get('contact', 'PagesController@contact');

Route::resource('users', 'UserController');

Route::resource('nerds', 'NerdController');

Route::get('upload', function(){
	return View::make('home');
});

Route::get('view', function(){
	$judul = "lalalayeyeye";
	return View::make('test')
				->with('title', $judul);
});

Route::get('layout', function(){
	return View::make('layout');
});

Route::post('proses', 'TranskripController@read');

Route::get('/test', function() {
	$no=1;
	$tahap1=0;
	$tahap1_1=0;
	$tahap1_2=0;
	$tahap1_3=0;
	$tahap1_4=0;
	$tahap1_5=0;
	$tahap2=0;
	$tahap2_1=0;
	$tahap2_2=0;
	$tahap2_3=0;
	$tahap2_4=0;
	$tahap2_5=0;
	$dont=false;
	$sks=0;
	$ipk=0;

	$html = new Htmldom('./data/tr.xls');
	$data = $html->find('table td');
	
	if (strcmp(strtolower($data[0]->plaintext), strtolower("TRANSKRIP MATA KULIAH"))==0) {
	    foreach( $data as $element){
	    	//echo $no.'  |'.$element.'<br/>';
	    	$temp=explode(" : ", $element->plaintext);

	    	if(strcmp(strtolower($element->plaintext), strtolower("--- Tahap: Persiapan ---"))==0){
	    			$tahap1=$no;
	    			$tahap1_1=($tahap1+1)%5;
	    			$tahap1_2=($tahap1+2)%5;
	    			$tahap1_3=($tahap1+3)%5;
	    			$tahap1_4=($tahap1+4)%5;
	    			$tahap1_5=($tahap1+5)%5;
	    	}
	    	if(strcmp(strtolower($element->plaintext), strtolower("--- Tahap: Sarjana ---"))==0){
	    			$tahap2=$no;
	    			$tahap2_1=($tahap2+1)%5;
	    			$tahap2_2=($tahap2+2)%5;
	    			$tahap2_3=($tahap2+3)%5;
	    			$tahap2_4=($tahap2+4)%5;
	    			$tahap2_5=($tahap2+5)%5;	
	    	}

	    	if(strcmp(strtolower($temp[0]), strtolower("Total Sks Tahap Persiapan"))==0 ||
	    		strcmp(strtolower($temp[0]), strtolower("IP Tahap Persiapan"))==0 ||
	    		strcmp(strtolower($temp[0]), strtolower("Total Sks Tahap Sarjana"))==0 ||
	    		strcmp(strtolower($temp[0]), strtolower("IP Tahap Sarjana"))==0 ){
	    		$dont=true;
	    	}
	    	
			if(strcmp(strtolower($element->plaintext), strtolower("Total Sks"))==0){
	    		$sks=$data[$no]->plaintext;
	    		$dont=true;
	    	}
	    	elseif(strcmp(strtolower($element->plaintext), strtolower("IPK"))==0) {
	    		$ipk=$data[$no]->plaintext;
	    		$dont=true;
	    	}


	    	if($no==3) {
	    			$id = explode("/", $element);
	    			echo $id[1];
	    			echo "<br>";
	    			echo $id[0];
	    	}
	    	elseif ($no>($tahap1+5) && $tahap2==0 && $dont==false && $ipk==0 && $sks==0) {
	    			switch ($no%5) {
	    				case $tahap1_1:
	    					echo "------------------------<br/>";
	    					echo "KODE - ".$element.'<br/>';
	    					break;
	    				case $tahap1_2:
	    					echo "MK   - ".$element.'<br/>';
	    					break;
	    				case $tahap1_3:
	    					echo "SKS  - ".$element.'<br/>';
	    					break;
	    				case $tahap1_4:
	    					echo "HIST - ".$element.'<br/>';
	    					break;
	    				case $tahap1_5:
	    					echo "VAL  - ".$element.'<br/>';
	    					echo "------------------------<br/>";
	    					break;
	    				default:
	    					break;
	    			}
	    	}
	    	elseif ($no>($tahap2+5) && $tahap2>$tahap1 && $dont==false && $ipk==0 && $sks==0) {
	    		switch ($no%5) {
	    				case $tahap2_1:
	    					echo "************************<br/>";
	    					echo "KODE - ".$element.'<br/>';
	    					break;
	    				case $tahap2_2:
	    					echo "MK   - ".$element.'<br/>';
	    					break;
	    				case $tahap2_3:
	    					echo "SKS  - ".$element.'<br/>';
	    					break;
	    				case $tahap2_4:
	    					echo "HIST - ".$element.'<br/>';
	    					break;
	    				case $tahap2_5:
	    					echo "VAL  - ".$element.'<br/>';
	    					echo "************************<br/>";
	    					break;
	    				default:
	    					break;
	    			}
	    	}
	    	else{
	    		
	    	}

	    	$no++;
	    	$dont=false;
	    }

	    $tgl=explode(": ", $data[count($data)-1]);
	    $tgl_transkrip=$tgl[1];
	    echo $sks."<br/>";
	    echo $ipk."<br/>";
	    echo $tgl_transkrip."<br/>";
	}
	else {
	    echo 'File yang Anda Masukan Salah !!!<br/>';
	}
	
});

Route::get('/stemmer', function() {
	require_once base_path().'\vendor\autoload.php';
	$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
	$stopwordRemoval= new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
	$stemmer  = $stemmerFactory->createStemmer();
	$removal  = $stopwordRemoval->createStopWordRemover( );
	$sentence = 'Perekonomian 123 Indonesia5 sedang dalam8 pertumbuhan yang membanggakan';
	$output   = $stemmer->stem($sentence);
	$clean	  = $removal->remove($output);
	echo $output . "<br/>";
	echo $clean . "<br/>";

});

Route::get('/token', function(){
	require_once base_path(). '/vendor/autoload.php';

	$tokenizerFactory  = new \Sastrawi\Tokenizer\TokenizerFactory();
	$tokenizer = $tokenizerFactory->createDefaultTokenizer();

	$tokens = $tokenizer->tokenize('Saya. membeli. barang. seharga. Rp 5.000 di Jl. Prof. Soepomo no. 67.');

	foreach ($tokens as $key => $value) {
		# code...
	}

	var_dump($tokens);
});

Route::get('/array', 'ArrayController@index');

Route::get('/rbtc', 'DataController@index');
Route::get('/rbtc/full', 'DataController@full');

Route::get('preexample', function()
{
	$text ="Bila suatu negara ingin bersaing di dunia global yang persaingannya semakin ketat sekarang ini, maka penelitian dan pengembangan harus menjadi perhatian utama. Peluang penelitian dimasa depan akan menjadi peluang bagi kemajuan suatu bangsa. Informasi mengenai peta kerjasama peneliti menjadi penting bagi para peneliti untuk memprediksi peluang kerjasama dengan peneliti lain. Sistem Repositori PenelitiInstitut Teknologi Sepuluh Nopember (ITS) merupakan sistem informasi yang secara khusus memberikan informasi kepada para peneliti, mahasiswa maupun masyarakat umum seputar dunia penelitian di ITS. Aplikasi ini memiliki salah satu fitur yang memberikan informasi kepada pengguna mengenai peta kerjasama peneliti di ITS. Pengguna dapat melihat kedekatan kerjasama peneliti berdasarkan topik penelitiannya. Peta kerjasama peneliti ini divisualisasikan menggunakan pemodelan graf, sehingga pengguna akan mudah melihat kedekatan-kedekatan para peneliti. Setiap peneliti direpresentasikan dengan lingkaran (node) pada graf, sedangkan hubungan kedekatan antar peneliti direpresentasikan dengan garis (edge). Semakin besar node, berarti semakin banyak penelitian yang telah dilakukan oleh peneliti tersebut, dan sebaliknya. Selain itu, warna node menunjukkan area penelitian peneliti. Semakin tebal edge, berarti semakin dekat hubungan kerjasama antar node (peneliti). Fitur visualisasi peta kerjasama peneliti berdasarkan topik penelitian ini dapat menyediakan informasi peta kerjasama penelitidi ITS yang dibutuhkan pengguna. Informasi peta kerjasama peneliti yang ditampilkan dapat membantu pengguna untuk mengetahui perkembangan penelitian yang ada di ITS.";
	$angka = 123;
	return View::make('preexample')
				->with('teks', 'aida');
});