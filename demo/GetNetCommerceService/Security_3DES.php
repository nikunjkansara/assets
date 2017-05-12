<?php
class Security_3DES {
	public static function encrypt($input, $key, $iv) {
		$size = mcrypt_get_block_size(MCRYPT_3DES, MCRYPT_MODE_CBC); 
		$input = Security_3DES::pkcs5_pad($input, $size); 
		$td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_CBC, $iv);
		mcrypt_generic_init($td, $key, $iv); 
		$data = mcrypt_generic($td, $input); 
		mcrypt_generic_deinit($td); 
		mcrypt_module_close($td); 
		$data = base64_encode($data); 
		return $data; 
	}

	public static function decrypt($sStr, $sKey, $sIv) {
		$decrypted= mcrypt_decrypt(
			MCRYPT_3DES,
			$sKey, 
			base64_decode($sStr), 
			MCRYPT_MODE_CBC,
			$sIv
		);
		$dec_s = strlen($decrypted); 
		$padding = ord($decrypted[$dec_s-1]); 
		$decrypted = substr($decrypted, 0, -$padding);
		return $decrypted;
	}

	private static function pkcs5_pad ($text, $blocksize) { 
		$pad = $blocksize - (strlen($text) % $blocksize); 
		return $text . str_repeat(chr($pad), $pad); 
	}
}
?>