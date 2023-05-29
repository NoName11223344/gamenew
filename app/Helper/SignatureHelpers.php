<?php

namespace App\Helper;

use Illuminate\Support\Facades\Log;

class SignatureHelpers
{
    /**
     * Sign data
     * 2020-01-03
     *
     * @param string $plainText
     * @param string $bkPrivateKey
     * @param string $signatureAlg
     *
     * @author huanvv <huan.hvnh@gmail.com>
     * @return base64 signature
     */
    public static function sign($plainText, $bkPrivateKey, $signatureAlg = OPENSSL_ALGO_SHA256) {
        try {
            openssl_sign($plainText, $signature, $bkPrivateKey, $signatureAlg);
            return base64_encode($signature);
        } catch(\Exception $e) {
            Log::info($e->getMessage().' - '.$e->getFile().' - '.$e->getLine());
            return null;
        }
    }

    /**
     * Check sign
     * 2020-01-03
     *
     * @param string $plainText
     * @param string $signature
     * @param string $partnerPublicKey
     * @param string $signatureAlg
     *
     * @author huanvv <huan.hvnh@gmail.com>
     * @return
     */
    public static function checkSign($plainText, $partnerPublicKey, $signature, $signatureAlg = OPENSSL_ALGO_SHA256) {
        try {
            return openssl_verify($plainText, $signature, $partnerPublicKey, $signatureAlg);
        } catch(\Exception $e) {
            Log::info($e->getMessage().' - '.$e->getFile().' - '.$e->getLine());
            return null;
        }
    }

    /**
     * Get public rsa key from partner code
     * @param $partner
     * @return bool|string
     *
     * @since 2018-12-02
     * @author Thuan Truong
     */
    public static function getRSAPublicKey($partner) {
        return file_get_contents(storage_path('KeyRSA/'.$partner.'/public.pem'));
    }


    /**
     * Get private rsa key from partner code
     * @param $partner
     * @return bool|string
     *
     * @since 2018-12-02
     * @author Thuan Truong
     */
    public static function getRSAPrivateKey($partner) {
        return file_get_contents(storage_path('KeyRSA/'.$partner.'/private.pem'));
    }

    /**
     * Get public rsa key from partner code
     * @param $partner
     * @return bool|string
     *
     * @since 2018-12-02
     * @author Thuan Truong
     */
    public static function getRSAPublicKeyGateway($partner) {
        try {
            return file_get_contents(storage_path('KeyRSAGateway/BK_'.$partner.'/public.pem'));
        } catch(\Exception $e) {
            return null;
        }
    }


    /**
     * Get private rsa key from partner code
     * @param $partner
     * @return bool|string
     *
     * @since 2018-12-02
     * @author Thuan Truong
     */
    public static function getRSAPrivateKeyGateway($partner) {
        try {
            return file_get_contents(storage_path('KeyRSAGateway/BK_'.$partner.'/private.pem'));
        } catch(\Exception $e) {
            return null;
        }
    }

}
