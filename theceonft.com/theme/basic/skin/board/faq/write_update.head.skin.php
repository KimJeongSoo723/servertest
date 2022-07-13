<?
/****************************************************************************************************
*     프로그램명		:	그누보드 게시판 플러그인 - 게시판 글쓰기시 외부링크 이미지 모두 저장
*     Version			:	1.30
*     제작일			:	2009-11-12 오전 00:00
*     최근 수정일		:	2009-12-19 오전 09:00
*     업데이트 내역
         1. 특정 사이트 지정 및 지정한 사이트에 대한 동작 기능 추가 (1.1버전)
		 2. 외부링크 이미지가 있을 경우에만 동작하고 없을 경우 그누보드 코드를 따름 (1.11버전)
		 3. CURL 모듈 이용 이미지 저장 방식 추가 (1.2버전)
		 4. referer 추가 (1.30버전)
****************************************************************************************************/
$imgSave[max]	= 0;			// 저장가능한 최대사이즈, max 보다 작아야만 저장한다. byte 단위, 0이면 무제한, 1MB 지정하려면 (1024*1024)
$imgSave[min]		= 0;			// 저장가능한 최소사이즈, min 보다 커야만 저장한다. byte 단위, 0이면 무제한
$imgSave[site]		= "*";		// 사이트 지정, 쉼표로 구분, *는 전체사이트를 말함
$imgSave[mode]	= 1;			// 지정한 사이트의 대한 동작, 1이면 site 저장, 0이면 site 제외
$imgSave[type] = "fsockopen";	// 이미지를 읽어오는 방식, sock : fsockopen함수 이용,     curl : CURL 모듈 이용

if ($imgSave[type] == "curl" && !function_exists("curl_init")) alert("CURL 모듈이 설치되어 있지 않습니다. imgSave[type]을 sock 으로 변경해주세요.");

$img_content = image_save_run();
if ($img_content)	$_POST[wr_content] = addslashes($img_content);
$wr_content = $_POST[wr_content];

function remote_read_curl($urlstr) {	
	$url = parse_url2($urlstr);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $urlstr); 
	curl_setopt($ch, CURLOPT_REFERER, "http://$url[domain]");
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER,  1);
	$body = curl_exec ($ch);
	$header = curl_getinfo($ch);
    curl_close($ch);

	return array("data"=>implode(";", $header)."\r\n\r\n".$body, "domain"=>$url[domain], "file"=>$url[file], "basename"=>$url[basename], "extension"=>$url[extension], "url"=>$urlstr, "header"=>$header, "body"=>$body, "filesize"=>$header[size_download]);
}

function remote_read_sock($urlstr) {
	$url = parse_url2($urlstr);
	$data = "";
	$res	= fsockopen($url[domain], 80, $strErrorNo, $strErrStr, 2);
	if($res) {
		$headerstr = "GET $urlstr HTTP/1.0\r\n"; 
		$headerstr.= "Host:{$url[domain]}:80\r\n"; 
		$headerstr.= "referer:http://$url[domain]\r\n";
		$headerstr.= "\r\n";
		fputs($res, $headerstr);
		while (!feof($res)) {
			$data.= fgets($res, 1024); 
		} 
		fclose($res);
		if (stristr($data, "Not Found") || stristr($data, "Bad Request") || stristr($data, "Forbidden"))
			return false;
	} else return false;

	$patten = "/Content\\-Length:\\s+([0-9]*)\\r\\n/i";
	preg_match($patten, $data, $match);
	if ($match) $filesize = $match[1];
	else $filesize = 0;

	$dataset = explode("\r\n\r\n", $data);

	return array("data"=>$data, "domain"=>$url[domain], "file"=>$url[file], "basename"=>$url[basename], "extension"=>$url[extension], "url"=>$urlstr, "header"=>$dataset[0], "body"=>$dataset[1], "filesize"=>$filesize);
}

function parse_url2($urlstr) 
{
	$url				= parse_url($urlstr);
	$domain		= str_replace("www.", "", $url[host]);									// 도메인
	$file				= substr($url[path], strrpos($url[path], "/")+1);					// 파일명
	$basename	= str_replace("%", "", substr($file, 0, strrpos($file, ".")));	// 파일명 (확장자 제외)
	if (empty($basename)) {
		$basename = $file;
		$extension = "";
	} else	$extension	= substr($file, strrpos($file,".") + 1);						// 확장자
	
	return array("url"=>$urlstr, "domain"=>$domain, "file"=>$file, "basename"=>$basename, "extension"=>$extension);
}

function image_save($link, $filename) {
	echo $link;
	$g4[path] = G5_PATH;
	$g4[cheditor4] = "outimg";
	$tmp_name = $file["tmp_name"];

	@mkdir("$g4[path]/data/$g4[cheditor4]/", 0707);
	@chmod("$g4[path]/data/$g4[cheditor4]/", 0707);

	$ym = date("ym", $g4[server_time]);
	define('SAVE_AS_DIRECTORY', 	"$g4[path]/data/$g4[cheditor4]/$ym/");
	@mkdir(SAVE_AS_DIRECTORY, 0707);
	@chmod(SAVE_AS_DIRECTORY, 0707);

	//echo "fil==".$link;
	
	$img_link = iconv('utf-8','euc-kr',$link);

	// 확장자 가져오기
	$ext = strtolower(pathinfo($img_link, PATHINFO_EXTENSION));

	// 저장할 이미지명을 정한다.
	$img = $filename;
	echo $filename;


	$fp = fopen(SAVE_AS_DIRECTORY.$img,'w'); // 저장할 이미지 위치 및 파일명

	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $img_link );
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec($ch);
	curl_close($ch);

	// fwrite($fp,file_get_contents($img_link)); // 가져올 외부이미지 주소

	fwrite($fp,$contents); // 가져올 외부이미지 주소

	fclose($fp);

	//echo $contents;

	
	return true;
}

function image_save_run() {
	global $imgSave;
	$g4[path] = G5_PATH;
	$g4[cheditor4] = "outimg";

	$img_content = stripslashes($_POST[wr_content]);
	$img_content = str_replace("&lt;", "<", $img_content);
	$img_content = str_replace("&gt;", ">", $img_content);
	$patten = "/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i";
	preg_match_all($patten, $img_content, $match); 
	$dest_file = "data/$g4[cheditor4]/".date("ym", $g4[server_time])."/";		//저장경로
	
	if ($match[1]) {
		
	
		foreach ($match[1] as $link) {
			$link_ori = $link;
			if(strpos($link, "data:image") !== false) {  

				list($type, $link) = explode(';', $link);
				list(, $link)      = explode(',', $link);
				$data = base64_decode($link);
				

				@mkdir("$g4[path]/data/$g4[cheditor4]/", 0777);
				@chmod("$g4[path]/data/$g4[cheditor4]/", 0777);

				$ym = date("ym", $g4[server_time]);
				define('SAVE_AS_DIRECTORY', 	"$g4[path]/data/$g4[cheditor4]/$ym/");
				@mkdir(SAVE_AS_DIRECTORY, 0777);
				@chmod(SAVE_AS_DIRECTORY, 0777);
				$saveFileName = random_generator(8, 15).".png";

				file_put_contents(SAVE_AS_DIRECTORY.$saveFileName, $data);

				$img_content = str_replace($link_ori, (G5_URL."/data/$g4[cheditor4]/$ym/".$saveFileName), $img_content);


			}else{
				$url = parse_url($link);
				if ($url[host] && $url[host] != $_SERVER['HTTP_HOST']) {
					
					$image = $imgSave[type]=="sock"?remote_read_sock($link):remote_read_curl($link);
					if ($image) {
						if ($imgSave[min] && $imgSave[min] > $image[filesize]) continue; // 이미지가 최소크기보다 작으면 저장안함
						if ($imgSave[max] && $imgSave[max] < $image[filesize]) continue; // 이미지가 최대크기보다 크면 저장안함
					
						$siteList = explode(",", trim($imgSave[site]));
						$siteListCnt = count($siteList);
						$site_exists = false; // 지정한 도메인에 포함이 되어 있는지 여부
						
						for($c=0; $c<$siteListCnt; $c++) {
							if (stristr($image[domain], $siteList[$c])) { // 지정한 도메인에 포함이 되어 있다면
								$site_exists = true;
								break;
							}
						}

						if ($imgSave[mode]) { // action이 저장일 경우
							if ($site_exists || $imgSave[site] == "*") { ; } // 사이트 목록에 있거나 전체사이트에 적용이라면
							else continue;
						}
						else { // action이 제외일 경우
							if ($site_exists || $imgSave[site] == "*") continue; // 사이트 목록에 있거나 전체사이트에 적용이라면
							else { ; } // 사이트 목록에 없다면 통과
						}
						$saveFileName_ori = random_generator(8, 15) . ($image[extension]?".".$image[extension]:"");
						$saveFileName = $dest_file.$saveFileName_ori;
						if (image_save($link, $saveFileName_ori))
							$img_content = str_replace($link, (G5_URL."/".$saveFileName), $img_content);					
					}
				}

			}
		}
			
		return $img_content;
		
	}else{
		return false;
	}
}

function random_generator ($min=8, $max=32, $special=NULL, $chararray=NULL) { 
    $random_chars = array(); 
    
    if ($chararray == NULL) { 
        $str = "abcdefghijklmnopqrstuvwxyz"; 
        $str .= strtoupper($str); 
        $str .= "1234567890"; 

        if ($special) { 
            $str .= "!@#$%"; 
        } 
    } 
    else { 
        $str = $charray; 
    } 

    for ($i=0; $i<strlen($str)-1; $i++) { 
        $random_chars[$i] = $str[$i]; 
    } 

    srand((float)microtime()*1000000); 
    shuffle($random_chars); 

    $length = rand($min, $max); 
    $rdata = ''; 
    
    for ($i=0; $i<$length; $i++) { 
        $char = rand(0, count($random_chars) - 1); 
        $rdata .= $random_chars[$char]; 
    } 
    return $rdata; 
} 

?>