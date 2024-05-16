<?php

namespace luissdeep\hcfaction\storage;

use luissdeep\hcfaction\HCFLoader;
use pocketmine\utils\TextFormat;

class Repository {

    public string $name;
    public array  $data;
    public string $path;
    public string $file;

    public function __construct(string $name, array $data = []) {
        $this->name = $name;
        $this->data = $data;
        $this->path = HCFLoader::getInstance()->getDataFolder() . "repositories/";
        $this->file = $this->path . "$name.json";
        $this->check();
    }

    public function __destruct(){
        $this->close();
    }

    public function check(): void {
        if (!is_dir($this->path)) {
            @mkdir(dirname($this->file));
        }
        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode($this->data, JSON_PRETTY_PRINT));
        }
        if (file_exists($this->file)) {
            $this->data = json_decode(file_get_contents($this->file), true);
        }
        echo TextFormat::colorize("&aRepository &e{$this->name} &achecked!\n");
    }

    public function save(): void {
        file_put_contents($this->file, json_encode($this->data, JSON_PRETTY_PRINT));
    }

    public function get(string $key, $default = null) {
        return $this->data[$key] ?? $default;
    }

    public function set(string $key, mixed $value): void {
        $this->data[$key] = $value;
    }

    public function remove(string $key): void {
        unset($this->data[$key]);
    }

    public function getAll(): array {
        return $this->data;
    }

    public function exists(string $key): bool {
        return $this->data[$key] ?? false;
    }

    public function clear(): void {
        $this->data = [];
    }

    public function close(): void {
        $this->save();
    }

}
