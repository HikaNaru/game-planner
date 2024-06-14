<?php

namespace GamePlanner\Libraries;

class Storage
{
    public const DEFAULT_ACCOUNT_NAME = 'ACCOUNT';

    private function getDir()
    {
        if (!file_exists(STORAGE_PATH)) {
            mkdir(BASE_PATH . '/storage');
        }
        $dir = scandir(STORAGE_PATH);
        array_splice($dir, 0, 2);

        return $dir;
    }

    public function haveSaveData()
    {
        $dir = $this->getDir();

        if (count($dir) > 0) {
            $account = App::get($dir, 0);

            $session = Session::instance();
            $session->account = $account;
        } else {
            $this->makeAccount();
        }
    }

    public function makeAccount(string $accountName = '')
    {
        $accountName = trim($accountName);
        if (strlen($accountName) === 0) {
            $dir = $this->getDir();
            $count = count($dir) + 1;
            $accountName = static::DEFAULT_ACCOUNT_NAME . '_' . $count;
        }

        mkdir(STORAGE_PATH . '/' . $accountName);

        $session = Session::instance();
        $session->account = $accountName;
    }
}
