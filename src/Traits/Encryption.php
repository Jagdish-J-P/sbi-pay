<?php

namespace JagdishJP\SBIPay\Traits;

use JagdishJP\SBIPay\Constant\Response;

trait Encryption
{

	/**
	 * Initialization Vector
	 */
	protected $iv;

	/**
	 * The cipher method
	 */
	protected $algo;

	public function __construct()
	{
		$this->iv   = substr($this->merchantKey, 0, 16);
		$this->algo = 'aes-128-cbc';
	}

	/**
	 * encrypts the request data
	 *
	 * @param string $data
	 * @return string
	 */
	public function encrypt($data): string
	{

		$cipherText = openssl_encrypt($data, $this->algo, $this->merchantKey, OPENSSL_RAW_DATA, $this->iv);
		$cipherText = base64_encode($cipherText);

		return $cipherText;
	}

	/**
	 * decrypts the response data
	 *
	 * @param string $data
	 * @return array
	 */
	public function decrypt($cipherText): array
	{

		$cipherText = base64_decode($cipherText);
		$plainText  = openssl_decrypt($cipherText, $this->algo, $this->merchantKey, OPENSSL_RAW_DATA, $this->iv);

		$response = explode('|',$plainText);
		foreach ($response as $key => $value) {
			$response[Response::RESPONSE_PARAMETERS[$key]]=$value;
			unset($response[$key]);
		}
		return $response;
	}
}
