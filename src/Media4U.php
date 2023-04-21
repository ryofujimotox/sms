<?php
namespace Sms;

use FrUtility\Other\Request;
use FrUtility\Other\Url;

// https://www.sms-console.jp/api3/?

/**
 *
 * Media4Uを利用してSMSを送信する
 *
 */
class Media4U
{
    /**
     * @var string $username 認証時のユーザーネーム
     */
    public $username;

    /**
     * @var string $password 認証時のパスワード
     */
    public $password;

    /**
     * API用のusername/passwordを登録する
     *
     * @param string $username 認証時のユーザーネーム
     * @param string $password 認証時のパスワード
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * CSV一括送信を使いやすくしたもの。
     * ユーザー設定を　「一括送信(CSVで設定)」　に変更する必要がある。
     *
     * @param array $data [ ["tel" => "080xxxxXXXX", "text" => "hello"],,,, ]
     * @return string 返却値はマニュアルを参照 200は成功
     */
    public function send(array $data)
    {
        // 一括送信用のCSVフォーマットに合わせる。
        $csv = array_map(function ($row) {
            return [
                $row['tel'], // 電話番号
                '', // info1
                '', // info2
                '', // info3
                '', // info4
                '', // memo
                '', // クリック数
                '', // テキストID
                '', // SMSタイトル
                $row['text'], // SMS本文
            ];
        }, $data);
        return $this->send_csv($csv);
    }

    /**
     * SMSを送る
     *
     * @param string $mobilenumber 電話番号 080xxxxyyyy
     * @param string $smstext 普通の文字列
     */
    public function send_one(string $mobilenumber, string $smstext)
    {
        $params = compact('mobilenumber', 'smstext');
        $result = $this->requestGetAPI('api', $params);
        return $result;
    }

    /**
     * SMS一括送信を行う。
     * ユーザー設定を　「一括送信(CSVで設定)」　に変更する必要がある。
     *
     * @param array $data 配列フォーマットはマニュアルを参照
     * @return string 返却値はマニュアルを参照 200は成功
     */
    public function send_csv(array $data)
    {
        $url = $this->makeApiUrl('api3', ['encode' => 'utf8', 'smstexttype' => 'csv']);
        $result = Request::postCsvByArray($url, $data);
        return $result;
    }

    /**
     * APIをGETでリクエストする
     *
     * @param string $api_key api1 ~ api3
     * @param array $params GETパラメーター　["key" => "value"]
     */
    private function requestGetAPI(string $api_key, array $params = [])
    {
        $url = $this->makeApiUrl($api_key, $params);
        return Request::get($url);
    }

     /**
     * Media4UのAPI用URLを作成する
     * @param string $api_key APIキー api ~ api3
     * @param array $params URLパラメータ
     *
     * @return string URL
     */
    private function makeApiUrl(string $api_key, array $params = []): string
    {
        $base = "https://{$this->username}:{$this->password}@www.sms-console.jp/{$api_key}/";
        $url = Url::modifyParams($base, $params);
        return $url;
    }
}
