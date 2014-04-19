<?php

function deleteDir($dirPath) {
   getcwd().$dirPath;
    if (!is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath moet een map zijn!");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

function createDir($dir, $file) {    
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
        touch($dir."/".$file);
		$fpath = $dir.'/'.$file;
		$owner = "tnijborg";
		chmod($dir, 0777);
		chmod($fpath, 0777);
    } else {
        echo $goed = "Map bestaat al.";
    }
}

?>