<?php
// Copyright 2006-2017 Faisal Thaheem
// 
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
// 
//     http://www.apache.org/licenses/LICENSE-2.0
// 
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
class ImagesizerComponent extends Object
{
    var $controller;

    function startup( &$controller ) {
        $this->controller = &$controller;
    }



    function resizeCopy($imgname, $width, $height, $filename, $watermark = null)    {
        $filetype = $this->getFileExtension($imgname);
        $filetype = strtolower($filetype);

        switch($filetype) {
            case "jpeg":
            case "jpg":
            $img_src = ImageCreateFromjpeg ($imgname);
            break;
            case "gif":
            $img_src = imagecreatefromgif ($imgname);
            break;
            case "png":
            $img_src = imagecreatefrompng ($imgname);
            break;
        }

        $true_width = imagesx($img_src);
        $true_height = imagesy($img_src);


        if ($true_width > $true_height)
        {
            $height = (int) ($width * 0.77);
            //$height = ($width/$true_width)*$true_height;
        }
        else
        {
            //$width=$size;
            //$height = ($width/$true_width)*$true_height;
            $width = (int) ($height * 0.77);
        }


        $img_des = ImageCreateTrueColor($width,$height);
        imagecopyresampled ($img_des, $img_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

        $watermarkImg = null;
        if(null != $watermark){
        	$watermarkImg = imagecreatefrompng($watermark);
        	$wm_width = imagesx($watermarkImg);
        	$wm_height = imagesy($watermarkImg);

			imagecopymerge($img_des,
					$watermarkImg,
					$width-($wm_width+10),
					$height-($wm_height+10),
					0, 0,
					$wm_width, $wm_height,
					10
			);

//        	if(imagecopymerge($img_des, $watermarkImg, $width-($wm_width+10), $height-($wm_height+10), 0, 0, $wm_width, $wm_height, 20)){
//        		echo 'success: ' . $watermark;
//        	}else{
//        		echo 'failed: ' . $watermark;
//        	}
        }

        // Save the resized image
        switch($filetype)
        {
            case "jpeg":
            case "jpg":
             imagejpeg($img_des,$filename,80);
             break;
             case "gif":
             imagegif($img_des,$filename);
             break;
             case "png":
             imagepng($img_des,$filename,2);
             break;
        }

        imagedestroy($img_des);
	    imagedestroy($img_src);
	    if(null != $watermarkImg){
	    	imagedestroy($watermarkImg);
	    }


    }




    function getFileExtension($str) {

	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
    }


}
?>