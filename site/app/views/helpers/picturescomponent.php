<?php
//	Denovo Voucher Script
//	Copyright (c) 2007-2011 Computed Synergy, http://www.computedsynergy.com
//	Website: http://www.voucherscript.com
//	Support: http://talk.voucherscript.com
//	Email: support@voucherscript.com
//	The DVS License (http://www.voucherscript.com/license.html)
//
//*** THIS IS A COMMERCIAL PRODUCT ***
//*** FOR PERSONAL USE ONLY, REDISTRIBUTION PROHIBITED IN ANY FORM AND/OR MANNER ***
//
class PicturescomponentHelper extends AppHelper {

	function getPathToPicture($uuid, $tag, $extension = '.png')
	{
		$picture_name = $tag . '-' . $uuid . $extension;
		$picture_name = '/files/pictures/' . $picture_name;
		return $picture_name;
	}
	
	function getPathToPictureFromFileName($filename)
	{
		$picture_name = '/files/pictures/' . $filename;
		return $picture_name;
	}	

	function getFileExtension($filename)
	{
		$i = strrpos($filename,".");
		if (!$i) { return ""; }
		$l = strlen($filename) - $i;
		$ext = substr($filename,$i+1,$l);
		return $ext;
	}
}

?>
