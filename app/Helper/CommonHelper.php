<?php

namespace App\Helper;

use Abstraction\Entities\ResponseQrEntity;
use Abstraction\Helper\Constant;
use Abstraction\Messages\Message;
use App\Abstraction\Entities\EmailEntity;
use App\Models\FirmBankingEmail;
use App\Models\TblMessageNoVpbank;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use stdClass;
use App\Models\RequestLog;

class CommonHelper {

    /**
     * @param $responseCode
     * Return Message of ReturnCode
     * @author Thuan Truong
     */
    public static function getMessages($responseCode) {
        $messages = array(
            200 => 'Success',
            99  => 'Transaction pending',
            11  => 'Transaction fail',
            101 => 'BaoKim system error',
            102 => 'RequestId and RequestTime are invalid',
            103 => 'Signature not verified',
            104 => 'Token is not verified',
            110 => 'The PartnerCode does not exist',
            111 => 'The PartnerCode has been deleted',
            112 => 'The PartnerCode not activated',
            113 => 'The Operation is required',
            114 => 'The Operation is invalid',
            115 => 'The BankNo is required',
            116 => 'The BankNo is invalid',
            117 => 'The AccNo length must be between 6 and 20 characters',
            118 => 'The AccNo is invalid',
            119 => 'System not found account number',
            120 => 'The AccType is invalid',
            121 => 'The ReferenceId is required',
            122 => 'The ReferenceId is invalid',
            123 => 'The ReferenceId does not exist',
            124 => 'The Request Amount is required',
            125 => 'The Request Amount is invalid',
            126 => 'Errors in processing from The Bank and BaoKim',
            127 => 'Bank system is offline',
            128 => 'Bank system faults that lead to bank transfer errors',
            129 => 'Not enough balance',
            131 => 'AccName not matching',
            150 => 'The AppId is invalid',

            201 => 'Cancel pending transaction success',
            202 => 'Cannot cancel pending transaction',
            203 => 'AccName is invalid',
            204 => 'ClientIdNo is invalid',
            205 => 'IssuedPlace is invalid',
            206 => 'IssuedDate is invalid',
            207 => 'ContractId is invalid',
            208 => 'RequestAmount is invalid',
            209 => 'ExpiredDate is invalid',
            210 => 'Phone number is invalid',
            211 => 'Email is invalid',
            212 => 'ClientIdNo and ContractId are existed',
            213 => 'Memo is invalid',

            /*Update contract:*/
            214	=> 'Update contract success',
            215	=> 'Update contract fail',
            216	=> 'Exceeded edit number',
            217	=> 'Input data is not different',
            218	=> 'AccName has change a lot',
            219	=> 'Contract can not be edit',
            132 => 'AppId is invalid',
            133 => 'Contract is invalid',
        );

        return $messages[$responseCode];
    }

    public static function utf8Convert($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        $str = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        return $str;
    }

    public static function reMoveSpecialChars($string){

        //return preg_replace('/[!@#$%^&*(),?":{}|<>]/', '', $string);
        return preg_replace('/[!@#$%.~_+^&*(),?":{}|<>]/', '', $string);
    }

    /**
     * Remove special character
     * 2020-02-05
     *
     * @param $excepts
     * @param $string
     *
     * @author huanvv <huan.hvnh@gmail.com>
     * @return boolean
     */
    public static function reMoveAllSpecialCharacter($string, $excepts = []){

        $pattern = '/[-_<>+=~!@#$%^&*().,?":{}|\[\]<>\`"\'\/]/';
        if(!empty($excepts) && is_array($excepts)) {
            foreach($excepts as $key => $except) {
                if($except == '[') {
                    $except = "\[";
                } else if($except == ']') {
                    $except = "\]";
                } else if($except == '`') {
                    $except = "\`";
                }
                $pattern = str_replace($except, '', $pattern);
            }
        }
        return preg_replace($pattern, '', $string);
    }

    /**
     * Check special character, except some character
     * 2020-01-06
     *
     * @param string text
     * @param array excepts
     *
     * @author huanvv <huan.hvnh@gmail.com>
     * @return boolean
     */
    public static function checkSpecialCharacter($text, $excepts = []) {
        $pattern = '/[-_<>+=~!@#$%^&*().,?":{}|\[\]<>\`"\'\/]/';
        if(!empty($excepts) && is_array($excepts)) {
            foreach($excepts as $key => $except) {
                if($except == '[') {
                    $except = "\[";
                } else if($except == ']') {
                    $except = "\]";
                } else if($except == '`') {
                    $except = "\`";
                } else if($except == '/') {
                    $except = "\/";
                }
                $pattern = str_replace($except, '', $pattern);
            }
        }
        return preg_match($pattern, $text);
    }

    public static function checkSpecialChars($string){

        return preg_match('/[!@#$%^&*(),?":{}|<>]/', $string);
    }

    public static function gennerateUniqueString($prefix = 'BK', $accNo = ''){
        $string = strtoupper(uniqid($prefix));

        return $string.CommonHelper::generateRandomString(2);
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateIdByTime()
    {
        /*check duplicate*/
        /*
        $m = explode(' ',microtime());
        $basicTime = $m[1];
        $extraTime = substr((string)($m[0]*1000), 0, 3);
        if(strpos($extraTime,'.')){
            $extraTime = substr("0".$extraTime, 0 ,3);
        }

        return date("YmdHis", $basicTime) . $extraTime;
        */

        $m = explode(' ',microtime());
        $basicTime = $m[1];
        $extraTime = substr($m[0], 2, 3);
        $msg = date("YmdHis", $basicTime) . $extraTime;

        return $msg;

    }

    public static function generateIdByTimeSacom()
    {

        $m = explode(' ',microtime());
        $basicTime = $m[1];
        $extraTime = substr($m[0], 2, 3);
        $msg = date("ymdHis", $basicTime) . $extraTime.CommonHelper::generateRandomStringSacom(2);

        return $msg;

    }
    public static function generateRandomStringSacom($length = 10) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param $accNo
     * @return $msg
     *
     * Hàm gen messageNo của VPBank
     * @author Huanvv
     * @since 2020-10-02
     * */
    public static function generateIdByTimeVPBank($accNo = '')
    {

        $m = explode(' ',microtime());
        $basicTime = $m[1];
        $extraTime = substr($m[0], 2, 3);
        $string = strtoupper(uniqid(substr($accNo, -4)));
        //        $msg = date("ymdHis", $basicTime).$string.$extraTime.rand(100, 990);
        $msg = $string.date("ymdHis", $basicTime).$extraTime.rand(100, 990);
        return $msg;

    }

    /**
     * @param $accNo
     * @return $msg
     *
     * Hàm gen messageNo của VPBank
     * @author Huanvv
     * @since 2020-10-02
     * */
    public static function generateIdByTimeVPBankV2($accNo = '')
    {

        $m = explode(' ',microtime());
        $extraTime = substr($m[0], 2, 3);
        $string = strtoupper(uniqid('BK')) . substr($accNo, -3);
        $traceNumber = rand(800000, 999999);
        DB::beginTransaction();
        try {
            $getOne = TblMessageNoVpbank::whereDate('date','!=',date('Y-m-d'))->first();
            if($getOne){
                $update = TblMessageNoVpbank::
                where('msg_no',$getOne->msg_no)->
                where('date', $getOne->date)->
                update(['date' => date('Y-m-d H:i:s')]);
                if($update){
                    $traceNumber = $getOne->msg_no;
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            Log::info("Exception rollback transaction: " . $e->getMessage().' Dòng: '.$e->getLine().' File: '.$e->getFile());
            DB::rollBack();
        }
        return $string.$extraTime.$traceNumber;

    }


    /**
     * Check is lock or not. If file is locked then increase content of lock
     * @return boolean true if process is locked
     */
    public static function checkRequestId($requestId) {
        $year = date('Y');
        $month = date('m');
        $date = date('d');
        $url_file = public_path()."/RequestId/$year/$month/$date.txt";
        if (file_exists($url_file)) {
            $lock_content = file_get_contents($url_file);
            $idArray = explode(' ',$lock_content);
            if(in_array($requestId,$idArray)){
                return 102;
            } else {
                file_put_contents($url_file,$requestId.' ', FILE_APPEND | LOCK_EX);
                return 200;
            }
        } else {
            CommonHelper::mkdir_r(public_path()."/RequestId/$year/$month");
            $fp = fopen($url_file, "w");
            fwrite($fp, $requestId.' ');
            fclose($fp);
            return 200;
        }
    }

    /**
     * @author : Rome
     * @purpose : Tạo thư mục
     * @busines:
     * @param     $dirName
     * @param int $rights
     */
    public static function mkdir_r($dirName, $rights=0777){
        $dirs = explode('/', $dirName);
        $dir='';
        foreach ($dirs as $part) {
            $dir.= $part.'/';
            if (!is_dir($dir) && strlen($dir)>0)
                mkdir($dir, $rights);
        }
    }

    public static function insertExceptionEmail($content){
        $emailModel = new FirmBankingEmail();
        $emailObj = new EmailEntity();
        $emailObj->content = $content;
        $emailObj->emailTo = config('setting.EMAIL_SEND_DEFAULT');
        $emailObj->emailCc = config('setting.EMAIL_SEND_DEFAULT_CC');
        $emailObj->subject = 'Firmbanking Core Excepion';
        $emailObj->status = EmailEntity::STATUS_NOT_YET;
        $emailObj->failNumber = 0;
        $insertEmail = $emailModel->addNew($emailObj);
    }

    public static function insertNotifyEmail($subject, $content){
        try {
            $emailModel = new FirmBankingEmail();
            $emailObj = new EmailEntity();
            $emailObj->content = $content;
            $emailObj->emailTo = config('setting.EMAIL_SEND_DEFAULT');
            $emailObj->emailCc = config('setting.EMAIL_SEND_DEFAULT_CC');
            $emailObj->subject = $subject;
            $emailObj->status = EmailEntity::STATUS_NOT_YET;
            $emailObj->failNumber = 0;
            $emailModel->addNew($emailObj);
        } catch (\Exception $e) {
            Log::info("- $subject : Insert email notify fail: " . $e->getMessage().' Dòng: '.$e->getLine().' File: '.$e->getFile());
        }
    }

    /**
     * date: 2019-07-01
     *
     * check all special character
     * @param String str
     *
     * @author ntdat <datnt@baokim.vn>
     * @return String result
     */
    public static function checkAllSpecialChars($string){
        return preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $string);
    }

    /**
     * Convert Vi to En
     * date: 2019-07-01
     *
     * @param String str
     *
     * @author ntdat <datnt@baokim.vn>
     * @return String result
     */
    public static function convertViToEn($string) {
        $string = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $string);
        $string = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $string);
        $string = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $string);
        $string = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $string);
        $string = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $string);
        $string = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $string);
        $string = preg_replace("/(đ)/", 'd', $string);
        $string = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $string);
        $string = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $string);
        $string = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $string);
        $string = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $string);
        $string = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $string);
        $string = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $string);
        $string = preg_replace("/(Đ)/", 'D', $string);
        //$string = str_replace(" ", "-", str_replace("&*#39;","",$string));
        return $string;
    }

    /**
     * remove all special characters
     * date: 2019-07-01
     *
     * @param String str
     *
     * @author ntdat <datnt@baokim.vn>
     * @return String result
     */
    public static function removeAllSpecialChars($string) {
        return preg_replace("/[^A-Za-z0-9 ]/", '', $string);
    }

    /**
     * generate secret code unique with contract_no, client_id_no
     * date: 2019-07-05
     *
     * @param
     *
     * @author ntdat <datnt@baokim.vn>
     * @return Array [3DES seccode, seccode];
     */
    public static function generateSecretCode($contractNo, $clientIdNo) {
        $cipherSecretCode = null;
        $count = 0;
        try {
            do {
                $count++;
                $secretCode = str_pad(rand(100000, 999999), 6, 0, STR_PAD_LEFT);
                $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('DES-ECB'));
                $cipherSecretCode = openssl_encrypt($secretCode,"DES-ECB", config('setting.KEY_EN_DECODE'), 0, $iv);
                $dchContract = new DchContract();
                $select = ['contract_no', 'client_id_no', 'sec_code'];
                $filters = ['contract_no' => $contractNo, 'client_id_no' => $clientIdNo, 'sec_code' => $cipherSecretCode];
                $getOneContract = $dchContract->getOne($select, $filters);
            } while($getOneContract->messageCode == Result::MESSAGE_CODE_SUCCESS && $count < config('setting.MAX_LOOP_DO_WHITE'));
        } catch(\Exception $e) {
            Log::info('[LOI] Khong tao duoc sec_code: '.$e->getMessages());
            $cipherSecretCode = null;
        }

        return ['cipher_secret_code' => $cipherSecretCode, 'secret_code' => $secretCode];
    }

    /*Check the link is working or not?*/
    public static function checkUrl($url) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $headers = curl_getinfo($ch);
        curl_close($ch);

        return $headers['http_code'];
    }

    /*Check the link is working or not?*/
    public static function checkMailAddr($email, $record = 'MX'){
        list($user, $domain) = split('@', $email);
        if($domain)
            return checkdnsrr($domain, $record);
    }

    public static function generateRandomStringBanViet($length = 12) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomStringVietcomBank($accNo = '') {
        $m = explode(' ',microtime());
        $basicTime = $m[1];
        $extraTime = substr($m[0], 2, 3);
        $string = strtoupper(uniqid(substr($accNo, -4)));
        //        $msg = date("ymdHis", $basicTime).$string.$extraTime.rand(100, 990);
        $msg = $string.date("ymdHis", $basicTime).$extraTime.rand(100, 990);
        return $msg;

    }

    public static function generateRandomStringTechcomBank($accNo = '') {
        $m = explode(' ',microtime());
        $basicTime = $m[1];
        $extraTime = substr($m[0], 2, 3);
        $string = strtoupper(uniqid(substr($accNo, -4)));
        //        $msg = date("ymdHis", $basicTime).$string.$extraTime.rand(100, 990);
        $msg = $string.date("ymdHis", $basicTime).$extraTime.rand(100, 990);
        return $msg;

    }

    public static function generateTransId($accNo = '') {
        $m = explode(' ',microtime());
        $basicTime = $m[1];
        $msg = date("ymdHis", $basicTime);

        return $msg;
    }

    public static function generateRandomStringMBBank()
    {
        $chanel = "QL";
        $service = "CH";
        $uniqueString = CommonHelper::generateRandomString(8);
        $msNo = $chanel . $service . $uniqueString;

        return $msNo;
    }

    public static function checkTimeSendSms($gateway = 'VPBANK'){
        $time = strtotime(date("Y-m-d H:i"));
        $flagSms = DB::table('tbl_option')->where('key', 'FLAG_CHECK_TIME_SEND_SMS')->first();
        $flagTime = strtotime($flagSms->updated_at);

        if ($flagSms->value) {
            if ($flagSms->value == $gateway) {
                if(($time - $flagTime) / 60 > 30){
                    DB::table('tbl_option')->where('key', 'FLAG_CHECK_TIME_SEND_SMS')->update([
                        'value' => $gateway,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                    return true;
                } else {
                    return false;
                }
            } else {
                DB::table('tbl_option')->where('key', 'FLAG_CHECK_TIME_SEND_SMS')->update([
                    'value' => $gateway,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                return true;
            }
        } else {
            return false;
        }
    }

    public static function generateMemo($request, $memoCustomize){
        $memo = $memoCustomize.''.$request->partnerCode.'.'.$request->transactionId;
        if(in_array($request->partnerCode, config('setting.UNCHECK_PARTNER_LIST', ''))){
            $memo = 'Home Credit giai ngan hop dong so '.$request->contractNo /*.' '.$request->partnerCode.'.'.$request->transactionId*/;
        }
        if (in_array($request->partnerCode, ['AIDONGTHUONGNGUYEN'])) {
            $memo = $request->memoOrigin.'.' .$request->transactionId;
        }
        if (in_array($request->partnerCode, ['SOUTHASIA'])) {
            $memo = $request->memoOrigin . ' SOUTH.' .$request->transactionId;
        }

        return $memo;
    }

    /**
     * Return error message
     * 2020-06-19
     *
     * @param string
     *
     * @author phunt <phunt@vatgia.com>
     * @return bool
     */
    public static function checkPhone($phone) {
        $pattern = '/^((09|03|07|08|05|[?+]849|[?+]843|[?+]847|[?+]848|[?+]845)+([0-9]{8})\b)$/';
        preg_match($pattern, $phone, $result);
        return !empty($result);
    }

    public static function dump_die($data)
    {
        array_map(function($x) {  echo '<pre>' . var_export($x, true) . '</pre>'; }, func_get_args());
    }

    /**
     * Check text length less than length
     * 2020-01-06
     *
     * @param string text
     * @param integer length
     *
     * @author ntdat <datnt@baokim.vn>
     * @return boolean
     */
    public static function checkLength($text, $length)
    {
        return (strlen($text) <= $length);
    }

    /**
     * return diff of time pass to function in minutes
     * 2020-07-10
     *
     * @param string text
     *
     * @author <phunt@vatgia.vn>
     * @return  string text
     */
    public static function getDiffTime($requestTime) {
        $now = strtotime(now());
        $requestTime = strtotime($requestTime);
        return intval(round(abs($now  - $requestTime) / 60));
    }

    public static function isContainsNumber($text)
    {
        return preg_match('/\d/', $text);
    }

    public static function checkIsDigit($text)
    {
        return preg_match('/^\d+$/', $text);
    }

    /**
     * check string has vietnamese character
     * 2020-04-21
     *
     * @param string $string
     *
     * @author ntdat <datnt@baokim.vn>
     * @return  boolean
     */
    public static function hasVietnamese($string)
    {
        if (preg_match("/[ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]/u", $string)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Lấy danh sách tất cả bank
     * 2020-04-21
     *
     * @param string $bankShortName
     *
     * @author huanvv <huanvv@baokim.vn>
     */
    public static function getBanks($bankShortName = null)
    {
        $redisConnection = Redis::connection();
        $getBankList = $redisConnection->get('firm_bank_list');
        if (!$getBankList) {
//        if (true) {
            $getBankList = DB::table('frm_bank')
                ->select(["bank_short_name", "bank_no", "transfer_via_account_no", "transfer_via_card_no", "status", "is_deleted"])
                ->get()
                ->keyBy("bank_no");
            if (!count($getBankList)) {
                return null;
            }
            $redisConnection->set('firm_bank_list', $getBankList, 'EX', 3600);
            $getBankList = (array)json_decode($getBankList);
        } else {
            $getBankList = (array)json_decode($getBankList);
        }

        if ($bankShortName) {
            return array_key_exists($bankShortName, $getBankList) ? $getBankList[$bankShortName] : null;
        } else {
            return $getBankList;
        }
    }

    /**
     * Lấy danh sách bank head no
     * 2020-04-21
     *
     * @param string $headNo
     *
     * @author huanvv <huanvv@baokim.vn>
     *
     */
    public static function getBanksHeadNo($headNo = null)
    {
        $redisConnection = Redis::connection();
        $getBankHeadNo = $redisConnection->get('firm_bank_head_no');

        if (!$getBankHeadNo) {
//        if (true) {
            $getBankHeadNo = DB::table('frm_bank_head_no')
                ->select(["bank_no", "head_no", "status", "is_credit_card"])
                ->get()
                ->keyBy("head_no");
            if (!count($getBankHeadNo)) {
                return null;
            }
            $redisConnection->set('firm_bank_head_no', $getBankHeadNo, 'EX', 3600);
            $getBankHeadNo = (array)json_decode($getBankHeadNo);
        } else {
            $getBankHeadNo = (array)json_decode($getBankHeadNo);
        }

        if ($headNo) {
            return array_key_exists($headNo, $getBankHeadNo) ? $getBankHeadNo[$headNo] : null;
        } else {
            return $getBankHeadNo;
        }
    }


}
