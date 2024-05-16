<?php

namespace luissdeep\hcfaction\profile;

class Profile {

    public string $xuid, $name;

    public int $balance = 0;

    public function __construct(string $xuid, string $name){
        $this->xuid = $xuid;
        $this->name = $name;
        if (ProfileService::getInstance()->getRepository()->exists($xuid)) {
            $data = ProfileService::getInstance()->getRepository()->get($xuid);
            $this->balance = $data["balance"];
        }
    }

    public function __destruct(){
        ProfileService::getInstance()->getRepository()->set($this->xuid, [
            "balance" => $this->balance
        ]);
        ProfileService::getInstance()->getRepository()->save();
    }

    public function getXuid(): string {
        return $this->xuid;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getBalance(): int {
        return $this->balance;
    }

    public function setBalance(int $balance): void {
        $this->balance = $balance;
    }

}