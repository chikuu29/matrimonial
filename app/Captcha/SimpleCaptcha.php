<?php
namespace App\Captcha;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Crypt;
/**
 * Script para la generación de CAPTCHAS
 *
 * @author  Jose Rodriguez <jose.rodriguez@exec.cl>
 * @license GPLv3
 * @link    http://code.google.com/p/cool-php-captcha
 * @package captcha
 * @version 0.3
 *
 */


session_start();

// Image generation
//$captcha->CreateImage();
/**
 * SimpleCaptcha class
 *
 */
class SimpleCaptcha  {
	public $resourcesPath = 'resources';
	
	private function getRandomWord($len = 5) {
		$word = array_merge(range('0', '9'), range('A', 'Z'));
		shuffle($word);
		return substr(implode($word), 0, $len);
	}
	
	
	public function CreateImage()
	{
		$ranStr = $this->getRandomWord();
		session(['captcha' => $ranStr]);

		$height = 35; //CAPTCHA image height
		$width = 130; //CAPTCHA image width
		$font_size = 24; 

		$image_p = imagecreate($width, $height);
		$graybg = imagecolorallocate($image_p, 255, 255, 255);
		$textcolor = imagecolorallocate($image_p, 34, 34, 34);

		imagefttext($image_p, $font_size, -2, 15, 26, $textcolor, ROOT_URL.'public/'.$this->resourcesPath.'/fonts/mono.ttf', $ranStr);
		
		imagepng($image_p);
	}
	public function getBase64Code()
	{	 	
		
		$ranStr 	= $this->getRandomWord();
		$height 	= 35; //CAPTCHA image height
		$width 		= 130; //CAPTCHA image width
		$font_size 	= 24; 
		$image_p 	= imagecreate($width, $height);
		$graybg 	= imagecolorallocate($image_p, 255, 255, 255);
		$textcolor 	= imagecolorallocate($image_p, 34, 34, 34);
		$imgTxt 	= imagefttext($image_p, $font_size, -2, 15, 26, $textcolor, public_path().'/'.$this->resourcesPath.'/fonts/mono.ttf', $ranStr);
		$fileName = STORAGE_TEMP_UPLOAD_PATH.'captcha'.time().'.png';
		imagepng($image_p, $fileName);		
		$strCptchCode = (base64_encode(file_get_contents($fileName)));
		imagedestroy($image_p);
		unlink($fileName);
		return array('status'=>200,'imgBs64'=>$strCptchCode,'imgTxt'=>Crypt::encryptString($ranStr)); 

		

	}
}