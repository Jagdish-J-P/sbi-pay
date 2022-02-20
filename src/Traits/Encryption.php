<?php

namespace JagdishJP\SBIPay\Traits;

use Illuminate\Support\Facades\Config;
use JagdishJP\SBIPay\Constant\Response;

trait Encryption
{
    /** Initialization Vector */
    protected $iv;

    /** The cipher method */
    protected $algo;

    public function init()
    {
        $this->iv   = substr($this->merchantKey, 0, 16);
        $this->algo = 'AES-128-CBC';
    }

    /**
     * encrypts the request data.
     *
     * @param string $data
     *
     * @return string
     */
    public function encrypt($data): string
    {
        $cipherText = openssl_encrypt($data, $this->algo, $this->merchantKey, OPENSSL_RAW_DATA, $this->iv);

        return base64_encode($cipherText);
    }

    /**
     * decrypts the response data.
     *
     * @param string $data
     * @param mixed $cipherText
     *
     * @return array
     */
    public function decrypt($cipherText): array
    {
        $cipherText = base64_decode($cipherText);
        $plainText  = openssl_decrypt($cipherText, $this->algo, $this->merchantKey, OPENSSL_RAW_DATA, $this->iv);

        $response = explode('|', $plainText);
        foreach ($response as $key => $value) {
            $response[Response::RESPONSE_PARAMETERS[$key]] = $value;
            unset($response[$key]);
        }

        return $response;
    }
}
