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
App::import('Vendor', 'phpcaptcha/php-captcha');

class CaptchaComponent extends Object
{
    var $controller;

    function startup( &$controller ) {
        $this->controller = &$controller;
    }

    function image(){

        $imagesPath = realpath(APP . 'vendors/phpcaptcha').'/fonts/';

        $aFonts = array(
            $imagesPath.'VeraBd.ttf',
            $imagesPath.'VeraIt.ttf',
            $imagesPath.'Vera.ttf'
        );

        $oVisualCaptcha = new PhpCaptcha($aFonts, 200, 60);
        $oVisualCaptcha->UseColour(true);
        //$oVisualCaptcha->SetOwnerText('Source: '.FULL_BASE_URL);
        //$oVisualCaptcha->SetOwnerText('Media Guru');
        $oVisualCaptcha->SetNumChars(6);
        $oVisualCaptcha->Create();
    }

    function audio(){
        $oAudioCaptcha = new AudioPhpCaptcha('/usr/bin/flite', '/tmp/');
        $oAudioCaptcha->Create();
    }

    function check($userCode, $caseInsensitive = true){
        if ($caseInsensitive) {
            $userCode = strtoupper($userCode);
        }

        if (!empty($_SESSION[CAPTCHA_SESSION_ID]) && $userCode == $_SESSION[CAPTCHA_SESSION_ID]) {
            // clear to prevent re-use
            unset($_SESSION[CAPTCHA_SESSION_ID]);

            return true;
        }
        else return false;

    }
}
?>