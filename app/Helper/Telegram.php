<?php

namespace App\Helper;

use Illuminate\Support\Facades\Log;

class Telegram
{
    public static function sentException($title, $message = null, $file = null, $line = null)
    {
        $scream = self::getIcon('scream');
        $fire = self::getIcon('fire');
        $breakLine = "%0A";
        $message = self::replaceSpecialCharacter($message);
        $text = "$fire <b>Exception: $title </b> $fire $breakLine";
        if ($message) {
            $text .= "<b>- Message:</b>  $message $breakLine";
        }
        if ($file) {
            $text .= "<b>- File:</b> $file $breakLine";
        }
        if ($line) {
            $text .= "<b>- Line:</b> $line $breakLine ";
        }
        $text .= "Lỗi thế này là dở rồi $scream $scream $scream";
        self::sentTelegram($text);
    }

    public static function sentMessageCallApi($title, $request, $response)
    {
        $icon = self::getIcon('ocean');
        $breakLine = "%0A";
        $text = "$icon <b>$title </b>$icon $breakLine";
        $text .= "<b>- Request:</b>$breakLine" . json_encode($request, JSON_UNESCAPED_UNICODE) . $breakLine;
        $text .= "<b>- Response:</b>$breakLine" . json_encode($response, JSON_UNESCAPED_UNICODE);
        self::sentTelegram($text);
    }

    public static function sentMessage($title, $message)
    {
        $icon = self::getIcon('ocean');
        $breakLine = "%0A";
        $text = "$icon <b>$title </b>$icon $breakLine";
        $text .= "<b>- Message:</b>$breakLine". $message. $breakLine;
        self::sentTelegram($text);
    }

    public static function sentTelegram(string $text)
    {
        $botToken = config('services.telegram.bot_token');
        try {
            $request = [
                'chat_id' => config('services.telegram.channel_id'),
                'parse_mode' => 'HTML',
                'text' => $text
            ];
            $httpQuery = urldecode(http_build_query($request));
            $url = "https://api.telegram.org/bot$botToken/sendMessage?" . $httpQuery;
            self::curl($url);
        } catch (\Exception $e) {
            Log::info("Error sent telegram " . $e->getMessage());
        }
    }

    public static function replaceSpecialCharacter($message)
    {
        $message = str_replace("<", "lt", $message);
        return str_replace(">", "gt", $message);
    }

    public static function getIcon($icon): string
    {
        return [
                'grinning' => "\u{1f600}",
                'ocean' => "\u{1f30a}",
                'fire' => "\u{1f525}",
                'fearful' => "\u{1f628}",
                'scream' => "\u{1f631}",
                'anguished' => "\u{1f627}",
                'cry' => "\u{1f622}",
                'joy' => "\u{1f602}"
            ][$icon] ?? '';
    }


    public static function getInfoChannel($botToken)
    {
        $url = "https://api.telegram.org/bot$botToken/getUpdates";
        return self::curl($url);
    }

    public static function curl($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 6,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
