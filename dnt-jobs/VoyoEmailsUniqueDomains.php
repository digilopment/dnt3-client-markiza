<?php

namespace App\GlobalServices\Mailer\Providers;

use App\GlobalServices\Mailer\Transcriber\Activity;
use App\GlobalServices\Mailer\Transcriber\Macro;

class BaseProvider
{

    protected $providerConfig;
    protected $activity;
    protected $macro;
    public $config = [];

    protected const AVAILABLE_CONFIG_FIELDS = [
        'recipientName',
        'recipientEmail',
        'senderName',
        'senderEmail',
        'attachments',
        'stringAttachments',
        'subject',
        'message',
        'smtpHost',
        'disableSeenLog',
        'disableClickLog',
    ];

    public function __construct(Activity $activity, Macro $macro)
    {
        $this->activity = $activity;
        $this->macro = $macro;
    }

    public function setConfig($customConfig = [])
    {
        $providerConfig = [];
        foreach (array_keys($this->config) as $key) {
            $providerConfig[$key] = $customConfig[$key] ?? $this->config[$key];
        }

        $finalConfig = $this->setRecipient($customConfig, $providerConfig);
        if (isset($customConfig['recipients']) && is_array($customConfig['recipients'])) {
            $finalConfig = $this->setRecipients($customConfig, $providerConfig);
        }
        $this->providerConfig = $this->customize($finalConfig);
    }

    protected function customize($config)
    {
        $final = [];
        foreach ($config as $recipientId => $recipient) {
            foreach ($recipient as $key => $val) {
                if ($key == 'message') {
                    $final[$recipientId][$key] = $this->macro->creator($recipient, $this->activity->aplyRules($recipient));
                } else {
                    $final[$recipientId][$key] = $this->macro->creator($recipient, $val);
                }
            }
        }
        return $final;
    }

    protected function responseData($config): array
    {
        $final = [];
        foreach ($config as $key => $val) {
            if ($key != 'message') {
                $final[$key] = $val;
            }
        }
        return $final;
    }

    private function setRecipients($customConfig, $providerConfig)
    {
        $finalConfig = [];
        foreach (array_keys($customConfig['recipients']) as $i) {
            foreach (self::AVAILABLE_CONFIG_FIELDS as $key) {
                $finalConfig[$i][$key] = $this->configSetter($customConfig, $i, $key);
            }
            $finalConfig[$i] = array_merge($providerConfig, $finalConfig[$i]);
        }
        return $finalConfig;
    }

    private function configSetter($customConfig, $i, $key)
    {
        if (isset($customConfig['recipients'][$i][$key]) && !empty($customConfig['recipients'][$i][$key])) {
            return $customConfig['recipients'][$i][$key];
        } elseif (isset($customConfig[$key]) && !empty($customConfig[$key])) {
            return $customConfig[$key];
        } elseif (isset($this->config[$key])) {
            return $this->config[$key];
        } else {
            return false;
        }
    }

    private function setRecipient($customConfig, $providerConfig)
    {
        $finalConfig = [];
        foreach (self::AVAILABLE_CONFIG_FIELDS as $key) {
            $finalConfig[0][$key] = $this->configSetter($customConfig, 0, $key);
        }
        $finalConfig[0] = array_merge($providerConfig, $finalConfig[0]);
        return $finalConfig;
    }

}