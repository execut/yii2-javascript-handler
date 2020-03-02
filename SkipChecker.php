<?php


namespace execut\javascriptHandler;


class SkipChecker
{
    protected $skippedMessages = [];
    public function __construct($skippedMessages)
    {
        $this->checkParameters($skippedMessages);
        $this->skippedMessages = $skippedMessages;
    }

    protected function checkParameters($skippedMessages) {
        $allowedKeys = [
            'message',
            'lineNo',
            'columnNo',
            'errorUrl',
            'userAgent',
        ];
        foreach ($skippedMessages as $skippedMessage) {
            if (is_string($skippedMessage)) {
                continue;
            }
            foreach ($skippedMessage as $key => $value) {
                if (!in_array($key, $allowedKeys)) {
                    throw new \Exception('Wrong configuration parameter \'' . $key . '\'');
                }
            }
        }
    }

    public function check($message) {
        foreach ($this->skippedMessages as $ignoredError) {
            if (is_string($ignoredError)) {
                $ignoredError = [
                    'message' => $ignoredError,
                ];
            }

            if (empty($ignoredError['message'])) {
                if ($this->isIgnoredMessage($message, $ignoredError)) {
                    return true;
                }

                continue;
            }

            $ignoredMessages = $ignoredError['message'];
            if (!is_array($ignoredMessages)) {
                $ignoredMessages = [$ignoredMessages];
            }

            foreach ($ignoredMessages as $ignoredMessage) {
                if (strpos($this->filtrateMessage($message['message']), $this->filtrateMessage($ignoredMessage)) !== false) {
                    $isIgnore = $this->isIgnoredMessage($message, $ignoredError);

                    if ($isIgnore) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    protected function filtrateMessage($message) {
        return str_replace(["\n", "\r"], '', $message);
    }

    /**
     * @param $message
     * @param $ignoredError
     * @return bool
     */
    protected function isIgnoredMessage($message, $ignoredError): bool
    {
        $isIgnore = true;
        if ((array_key_exists('lineNo', $ignoredError) && $ignoredError['lineNo'] !== (int)$message['lineNo']) ||
            (array_key_exists('columnNo', $ignoredError) && $ignoredError['columnNo'] !== (int)$message['columnNo']) ||
            (array_key_exists('errorUrl', $ignoredError) && strpos($message['errorUrl'], $ignoredError['errorUrl']) === false) ||
            (array_key_exists('userAgent', $ignoredError) && strpos($message['userAgent'], $ignoredError['userAgent']) === false)) {
            $isIgnore = false;
        }
        return $isIgnore;
    }
}