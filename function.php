<?phpfunction trimExt($filename) {	return current(explode(".", $filename));}function createFile($filelist) {	// open this directory 	$myDirectory = opendir("../" . $filelist);	// get each entry	while($entryName = readdir($myDirectory)) {		$dirArray[] = $entryName;	}	// close directory	closedir($myDirectory);	//	count elements in array	$indexCount	= count($dirArray);	// sort 'em	sort($dirArray);	// loop through the array of files and print them all	$result = "";	for($index = 0; $index < $indexCount; $index++) {		if (substr($dirArray[$index], 0, 1) != "."){ // don't list hidden files			if ($filelist == "picture") {				$result .= '["' . trimExt(str_replace("_", " ", $dirArray[$index])) . '", "../picture/' . $dirArray[$index] . '"]';			} else {				$result .= '["' . trimExt(str_replace("_", " ", $dirArray[$index])) . '", "?' . trimExt($dirArray[$index]) . '"]';			}			$result .= ($index == $indexCount - 1) ? '' : ',';		}	}	$jsfilepath = $filelist . "_list.js";	$fd = fopen($jsfilepath, "w");	if ($filelist == "picture") {		$strpart = "Image";	} else {		$strpart = "Link";	}	$str = 'var tinyMCE' . $strpart . 'List = new Array(' . $result . ');';	fwrite($fd, $str . PHP_EOL);	fclose($fd);}function selectCategory($category) {	if ($category == "events") {		return "az eseményekbe";	} elseif ($category == "things") {		return "a dolgokba";	} elseif ($category == "workshop") {		return "a műhelybe";	}}function sendMail($commentCategory, $commentEntry, $commentText) {	$to = 'mng@magolcsay.hu';	$subject = '[magolcsay.hu] új hozzászólás!';	$message = 'Új hozzászólás érkezett ' . selectCategory($commentCategory) . ', a ' . $commentEntry . ' című bejegyzéshez.' . '\r\n' . $commentText;	return mail($to, $subject, $message);}function getFilePath($file) {	$pathWithFileName = str_replace($_SERVER["DOCUMENT_ROOT"], "", $_SERVER["SCRIPT_FILENAME"]);	return str_replace($file, "", $pathWithFileName);}function buildPath() {	/* Redirect to a different page in the current directory that was requested */	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";	$host = $_SERVER['HTTP_HOST'];	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');	$extra = "/";	$pathStr = "". $protocol . $host . $uri . $extra;	return $pathStr;}?>