<?php

namespace App\Helper;


use App\Abstraction\Messages\Result;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SftpHelper
{

    /**
    * get file sftp
    * 2020-03-16
    *
    * @param string $sftpName
    * @param string $fileName
    * @param string $sftpPath
    * @param string $localPath
    *
    * @author ntdat <datnt@baokim.vn>
    * @return Result
    */
    public function getFile($sftpName, $fileName, $sftpPath, $localPath, $pathName) {
        $result = new Result();
        try {
            $sftpTPBank = Storage::disk($sftpName);
            if ($sftpTPBank->exists($sftpPath.$fileName)) {
                if (!Storage::disk('reconciled')->put($pathName.$fileName, $sftpTPBank->get($sftpPath.$fileName))) {
                    $result->code = Result::MESSAGE_CODE_ERROR;
                } else {
                    $result->code = Result::MESSAGE_CODE_SUCCESS;
                    $result->result = $localPath.$fileName;
                }
            } else {
                $result->code = Result::MESSAGE_CODE_ERROR;
            }
        } catch (\Exception $e){
            $result->code = Result::MESSAGE_CODE_ERROR;
            Log::info("GET FILE SFTP EXCEPTION: sftpName: $sftpName, sftpPath: $sftpPath");
            Telegram::sentException("[Get File SFTP]", $e->getMessage(), $e->getFile(), $e->getLine());
        }

        return $result;
    }

}
