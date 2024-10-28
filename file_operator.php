<?php
function pre($obj, $exit = 0){
	echo "<pre>";
	echo "<br>";
	print_r($obj);
	echo "<br>";
	if($exit == '1'){
		exit;
	} 
}
$php_files = array();
$dir = __DIR__.DIRECTORY_SEPARATOR.'107';
$cit_online_date = 'December 20, 2020';
$year = '2020';
pre("Processing Directory => ".$dir);  
if ($handle = opendir('107')) {
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'php')
        {
            @$thelist .= '<li><a href="'.$file.'">'.$file.'</a></li>';
            $php_files[] = $file;
        }
    }
    closedir($handle);
}
if(empty($php_files)) exit;

$doi_line = '<meta name="dc.identifier" content=" 10.29321/MAJ.2018.000091 ">';
$citation_doi = '<meta name="citation_doi" content=" 10.29321/MAJ.2018.000091  " />';

$citation_online_date = '<meta name="citation_online_date" content=" March 25, 2018 " />';
$citation_date = '<meta name="citation_date" content="2018" />';
$citation_publication_date = '<meta name="citation_publication_date" content=" March 25, 2018 " />';
$citation_author = '<meta name="citation_author" content=" R. Vijay* " />';
$citation_author_institution = '<meta name="citation_author_institution" content="Tamil Nadu Agricultural University  " />';
$citation_author_email = '<meta name="citation_author_email" content=" vijayaruna24@yahoo.com  " />';
$citation_author1 = '<meta name="citation_author" content="  V. Ravichandran " />';
$citation_author_institution1 = '<meta name="citation_author_institution" content="  Tamil Nadu Agricultural University" />';
$citation_author2 = '<meta name="citation_author" content=" P. Boominathan " />';
$citation_author_institution2 = '<meta name="citation_author_institution" content=" Tamil Nadu Agricultural University  " />';

foreach($php_files as $index => $php_file){
	$file_path = $dir.DIRECTORY_SEPARATOR.$php_file;
	pre("Processing File => ".$file_path);
	$handle = fopen($file_path, "r+") or die("Could not open $file_path" . PHP_EOL);

	$line = array();
	$keep = array();
	$line_number = 0;
	$doi_replace_line = '';
	$citation_doi_replace_line = '';
	$doi_line_number = 0;
	$citation_doi_line_number = 0;
	$citation_online_date_number = 0;
	$citation_date_number = 0;
	$citation_publication_date_number = 0;
	$citation_author_number = 0;
	$authors_list = array();

	while(!feof($handle)) {
		
		$line = fgets($handle);
	    $lines[$line_number] = $line;
	    $current_line = trim($line);
	    if($current_line == $doi_line){

	    	$doi_line_number = $line_number;

	    } else if($current_line == $citation_doi){

	    	$citation_doi_line_number = $line_number;

	    } else if($current_line == $citation_online_date){

	    	$citation_online_date_number = $line_number;

	    } else if($current_line == $citation_date){

	    	$citation_date_number = $line_number;

	    } else if($current_line == $citation_publication_date){

	    	$citation_publication_date_number = $line_number;

	    } else if($current_line == $citation_author){

	    	$citation_author_number = $line_number;

	    } else if($current_line == $citation_author_institution){
	    	continue;
	    } else if($current_line == $citation_author_email){
	    	continue;
	    } else if($current_line == $citation_author1){
	    	continue;
	    } else if($current_line == $citation_author_institution1){
	    	continue;
	    } else if($current_line == $citation_author2){
	    	continue;
	    } else if($current_line == $citation_author_institution2){
	    	continue;
	    }

	    //DOI Section
	    preg_match("'<span><b>DOI</b>(.*?)</span>'si", $line, $matches);
	    if(!empty($matches[1])){

	    	$doi = ltrim($matches[1],":");
	    	$doi_replace_line = '<meta name="dc.identifier" content=" '.$doi.' ">';
	    	$citation_doi_replace_line = '<meta name="citation_doi" content=" '.$doi.'  " />';
	    }

	    //Authors Section
	    preg_match("'<p><b>Author</b>(.*?)</p>'si", $line, $m_authors);
	    if(!empty($m_authors[1])){

	    	$authors = ltrim($m_authors[1],":");
	    	//Edit Authors
			$authors_name = preg_replace('/\d+/u', '', $authors);
			$authors_name = preg_replace('/\sand\s/u', ',', $authors_name);
			$authors_name = rtrim(trim($authors_name), '.');
			$authors_list = explode(",",$authors_name);
	    } else {
	    	preg_match("'<p><b>Authors</b>(.*?)</p>'si", $line, $m_authors);
		    if(!empty($m_authors[1])){

		    	$authors = ltrim($m_authors[1],":");
		    	//Edit Authors
				$authors_name = preg_replace('/\d+/u', '', $authors);
				$authors_name = preg_replace('/\sand\s/u', ',', $authors_name);
				$authors_name = rtrim(trim($authors_name), '.');
				$authors_list = explode(",",$authors_name);
		    }
	    }

	    $line_number++;
	}
	$change_flag = false;
	if(!empty($doi_replace_line) && !empty($doi_line_number)){
		$lines[$doi_line_number] = $doi_replace_line.PHP_EOL;
		$change_flag = true;
	}
	if(!empty($citation_doi_replace_line) && !empty($citation_doi_line_number)){
		$lines[$citation_doi_line_number] = $citation_doi_replace_line.PHP_EOL;
		$change_flag = true;
	}
	if(!empty($citation_online_date_number)){
		$lines[$citation_online_date_number] = '<meta name="citation_online_date" content=" '.$cit_online_date.' " />'.PHP_EOL;
		$change_flag = true;
	}
	if(!empty($citation_date_number)){
		$lines[$citation_date_number] = '<meta name="citation_date" content="'.$year.'" />'.PHP_EOL;
		$change_flag = true;
	}
	if(!empty($citation_publication_date_number)){
		$lines[$citation_publication_date_number] = '<meta name="citation_publication_date" content=" '.$cit_online_date.' " />'.PHP_EOL;
		$change_flag = true;
	}
	if(!empty($authors_list) && !empty($citation_author_number)){
		$temp = '';
		foreach($authors_list as $atr){
			$temp .= '<meta name="citation_author" content=" '.$atr.' " />'.PHP_EOL.'<meta name="citation_author_institution" content="  Tamil Nadu Agricultural University" />'.PHP_EOL;
		}
		$lines[$citation_author_number] = $temp;
		$change_flag = true;
	}

	if($change_flag){
		if(file_exists('temp.php')){
			unlink('temp.php');
		}

		$temp_file_name = 'temp.php';
		$myfile = fopen($temp_file_name, "x") or die("Unable to open file!");
		fwrite($myfile, implode('', $lines));
		fclose($myfile);
		fclose($handle);
		
		unlink($file_path);
		rename($temp_file_name, $file_path);
		
		pre('Processed File => '.$file_path);
	} else {
		fclose($handle);
		pre('No Changes In => '.$file_path);
	}
}