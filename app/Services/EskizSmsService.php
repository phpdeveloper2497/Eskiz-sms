<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class EskizSmsService
{
    protected $email;

    protected $password;
    protected $token;

    public function __construct()
    {
        $this->email = config('services.sms.email');
        $this->password = config('services.sms.password');
        $this->token = Cache::get('eskiz_token');

        if (!$this->token) {
            $this->authenticate();
        }
    }

    public function authenticate()
    {
        $response = Http::post('https://notify.eskiz.uz/api/auth/login', [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->token = $data['data']['token'];

            Cache::put('eskiz_token', $this->token, 86400);
        } else {
            throw new \Exception('Eskiz autentifikatsiyasi muvaffaqiyatsiz.');
        }
    }

    public function sendSms($phone, $message = 'Bu Eskiz dan test')
    {
        $response = Http::withToken($this->token)->post('https://notify.eskiz.uz/api/message/sms/send', [
            'mobile_phone' => $phone,
            'message' => $message,
            'from' => '4546',
            'callback_url' => null
        ]);

        if ($response->status() == 401) {
            $this->authenticate();
            return $this->sendSms($phone, $message);
        }

        return $response->json();
    }
}
