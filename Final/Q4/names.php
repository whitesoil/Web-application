<?php

/*
* Name : 남궁 선
* 학번 : 2013042776
* 반 : 3학년 화요일 10시 30분
*/

if (isset($_GET["type"])){
	$type = $_GET["type"];
	if($type != "list"){
		header("HTTP/1.1 400 Invalid Request");
		die("HTTP/1.1 400 Invalid Request - you passed in a wrong type parameter.");
	}
	nameList();
} else {
	babyname();
}

function nameList(){
	$names = "";
	$lines = file("rank.txt", FILE_IGNORE_NEW_LINES);
	foreach ($lines as $line) {
		$names = $names.substr($line, 0, strpos($line, " "))." ";
	}
	if ($names) {
		/* Change the code in this if statement to produce XML data to be sent to the client as shown below.
	    * Do NOT embed XML syntax in print or string use PHP's DOM
		* <babynames>
		*	<name>Aaden</name>
		*	<name>Aaliyah</name>
		*	...
		*	<name>Zuri</name>
		* </babynames>
 		*
 		* 다음 if문 안에 있는 코드를 수정하여 클라이언트로 보내어지는 XML 데이터를 위와 같이 생성하도록 하시오.
		* XML Syntax를 바로 print 하거나 string에 넣는 방식 금지! PHP's DOM 사용만 허용!
 		*/
		header("Content-type: application/xml");
		$datas = explode(" ",$names);
		$xmldom = new DOMDocument();
		$baby_tag = $xmldom->createElement("babynames");
		$xmldom->appendChild($baby_tag);
		for($i = 0;$i < count($datas); $i++){
			$name_tag = $xmldom->createElement("name");
			$name_tag->appendChild($xmldom->createTextNode($datas[$i]));
			$baby_tag->appendChild($name_tag);
		}
		print $xmldom->saveXML();
	} else {
		header("HTTP/1.1 410 Gone");
		die("HTTP/1.1 410 Gone - There is no data!.");
	}
}


function babyname(){
	$name = get_parameter("name");
	$gender = get_parameter("gender");

	$baby_info = "";
	$lines = file("rank.txt", FILE_IGNORE_NEW_LINES);
	foreach ($lines as $line) {
		if (preg_match("/^$name $gender /", $line)) {
			$baby_info = $line;
			break;
		}
	}

	if ($baby_info) {
		/* Change the code in this if statement to produce JSON data to be sent to the client.
 		*  In this code, call the generate_json() function
		*
 		*  다음 if문 안에 있는 코드를 수정하여 클라이언트로 보내어지는 JSON 데이터를 생성하도록 하시오.
		*  다음 코드에서는 generate_json() function을 부르시오.
 		*/

		header("Content-type: application/json");
		print generate_json($line,$name,$gender);
		// print $baby_info;
	} else {
		header("HTTP/1.1 410 Gone");
		die("HTTP/1.1 410 Gone - There is no data for this name/gender.");
	}
}

/* Change the code in this function to produce and return JSON data.
 * Do NOT embed JSON syntax in print or string use associative arrays
 *
 * 다음 function안에 있는 코드를 수정하여 JSON 데이터를 생성하여 반환하도록 하시오.
 * JSON Syntax를 바로 print 하거나 string에 넣는 방식 금지! associative arrays 사용만 허용!
 */
function generate_json($line, $name, $gender) {
	$babies = array(
		"name" => $name,
		"gender" => $gender,
		"ranks" => array()
	);

	$year = 1890;
	$ranks = array_slice(explode(" ", $line), 2);
	foreach ($ranks as $rank) {
		$babies["ranks"][] = array(
			"year" => $year,
			"popularity" => $rank
		);
		$year += 10;
	}

	return json_encode($babies);
}

function get_parameter($name) {
	if (isset($_GET[$name])) {
		return $_GET[$name];
	} else {
		header("HTTP/1.1 400 Invalid Request");
		die("HTTP/1.1 400 Invalid Request - you forgot to pass a '$name' parameter.");
	}
}
?>
