<?php

use PHPUnit\Framework\TestCase;
use Sms\Media4U;

// env読み込み
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Media4UTest extends TestCase
{
    /**
     *
     * デフォルト送信を行う。　CSV一括送信を使いやすくしたもの。
     * ユーザー設定を　「一括送信(CSVで設定)」　に変更する必要がある。
     *
     */
    public function testMediaSent()
    {
        $username = $_ENV['username'];
        $password = $_ENV['password'];
        $mobilenumber_sample1 = $_ENV['mobilenumber_sample1'];
        $mobilenumber_sample2 = $_ENV['mobilenumber_sample2'];

        //
        $data = [
            [
                'tel' => $mobilenumber_sample1, // 電話番号
                'text' => 'testMediaSent', // SMS本文
            ],
            [
                'tel' => $mobilenumber_sample2, // 電話番号
                'text' => 'testMediaSent', // SMS本文
            ],
        ];

        //
        $Media4u = new Media4U($username, $password);
        $result = $Media4u->send($data);
        $this->assertSame('200', $result);
    }

    /**
     *
     * 一人宛に送信するテスト
     *
     */
    public function testMediaSentOne()
    {
        $username = $_ENV['username'];
        $password = $_ENV['password'];
        $mobilenumber_sample1 = $_ENV['mobilenumber_sample1'];

        // /
        $smstext = 'おめでとうございます。';

        //
        $Media4u = new Media4U($username, $password);
        $result = $Media4u->send_one($mobilenumber_sample1, $smstext);
        $this->assertSame(200, $result);
    }

    /**
     *
     * CSVで送信するテスト
     * ユーザー設定を　「一括送信(CSVで設定)」　に変更する必要がある。
     *
     */
    public function testMediaSentCsv()
    {
        $username = $_ENV['username'];
        $password = $_ENV['password'];
        $mobilenumber_sample1 = $_ENV['mobilenumber_sample1'];
        $mobilenumber_sample2 = $_ENV['mobilenumber_sample2'];

        $csv = [
            [
                $mobilenumber_sample1, // 電話番号
                '', // info1
                '', // info2
                '', // info3
                '', // info4
                '', // memo
                '', // クリック数
                '', // テキストID
                '', // SMSタイトル
                'testMediaSentCsv', // SMS本文
            ],
            [
                $mobilenumber_sample2,
                '', // info1
                '', // info2
                '', // info3
                '', // info4
                '', // memo
                '', // クリック数
                '', // テキストID
                '', // SMSタイトル
                'testMediaSentCsv', // SMS本文
            ],
        ];

        //
        $Media4u = new Media4U($username, $password);
        $result = $Media4u->send_csv($csv);
        $this->assertSame('200', $result);
    }
}
