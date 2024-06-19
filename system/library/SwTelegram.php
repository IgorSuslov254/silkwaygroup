<?php

class SwTelegram
{
    /**
     * @var array
     */
    private array $settings_send;

    /**
     * @param array $settings_send
     */
    public function __construct(array $settings_send)
    {
        $this->settings_send = $settings_send;
    }

    /**
     * @param string $message
     * @return bool
     */
    public function sendMessage(string $message): bool
    {
        $log = new Log('error.log');

        try {
            $ch = curl_init("https://api.telegram.org/bot{$this->settings_send['token']}/sendMessage?" . http_build_query([
                'chat_id'  => $this->settings_send['chat_id'],
                'parse_mode' => 'html',
                'text' => $message
            ]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $html = json_decode(curl_exec($ch), true);
            curl_close($ch);

            if ($html['ok']) {
                return true;
            } else {
                throw new Exception($html);
            }
        } catch (exception $e) {
            $log->write($e->getMessage());
            return false;
        }
    }
}