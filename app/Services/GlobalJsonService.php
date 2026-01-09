<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class GlobalJsonService
{
    private string $baseDir = 'content/global-json/';
    private string $backupDir = 'content/global-json-backups/';

    public function readAll(): array
    {
        return [
            'colors' => $this->readJson('global-colors.json'),
            'fonts'  => $this->readJson('global-fonts.json'),
            'logos'  => $this->readJson('global-logos.json'),
            'images' => $this->readJson('global-images.json'),
            'text'   => $this->readJson('global-text.json'),
        ];
    }

    public function update(array $payload): void
    {
        $this->ensureDirs();

        // backup all files (single snapshot per save)
        $this->backupSnapshot([
            'global-colors.json',
            'global-fonts.json',
            'global-logos.json',
            'global-images.json',
            'global-text.json',
        ]);

        // write updated json
        if (isset($payload['colors'])) $this->writeJson('global-colors.json', $payload['colors']);
        if (isset($payload['fonts']))  $this->writeJson('global-fonts.json',  $payload['fonts']);
        if (isset($payload['logos']))  $this->writeJson('global-logos.json',  $payload['logos']);
        if (isset($payload['images'])) $this->writeJson('global-images.json', $payload['images']);
        if (isset($payload['text']))   $this->writeJson('global-text.json',   $payload['text']);
    }

    private function readJson(string $filename): array
    {
        $path = $this->baseDir . $filename;
        if (!Storage::exists($path)) return [];

        $raw = Storage::get($path);
        $decoded = json_decode($raw, true);

        return is_array($decoded) ? $decoded : [];
    }

    private function writeJson(string $filename, array $data): void
    {
        $path = $this->baseDir . $filename;

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            throw new RuntimeException("Failed to encode JSON for {$filename}");
        }

        Storage::put($path, $json);
    }

    private function backupSnapshot(array $filenames): void
    {
        $stamp = now()->format('Ymd_His') . '_' . Str::random(6);
        $snapshotDir = $this->backupDir . $stamp . '/';

        foreach ($filenames as $file) {
            $src = $this->baseDir . $file;
            $dest = $snapshotDir . $file;

            if (Storage::exists($src)) {
                Storage::put($dest, Storage::get($src));
            } else {
                Storage::put($dest, json_encode(new \stdClass(), JSON_PRETTY_PRINT));
            }
        }
    }

    private function ensureDirs(): void
    {
        if (!Storage::exists($this->baseDir)) {
            Storage::makeDirectory($this->baseDir);
        }
        if (!Storage::exists($this->backupDir)) {
            Storage::makeDirectory($this->backupDir);
        }
    }
}
