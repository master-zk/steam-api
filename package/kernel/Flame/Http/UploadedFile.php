<?php

declare(strict_types=1);

namespace Flame\Http;

use Exception;
use Flame\Filesystem\Storage;
use Flame\Support\Arr;
use Illuminate\Support\Traits\Macroable;
use RuntimeException;
use Symfony\Component\HttpFoundation\File\UploadedFile as SymfonyUploadedFile;

class UploadedFile extends SymfonyUploadedFile
{
    use FileHelpers, Macroable;

    /**
     * Store the uploaded file on a filesystem disk.
     *
     * @throws Exception
     */
    public function store(string $path = '', array|string $options = []): bool
    {
        return $this->storeAs($path, $this->hashName(), $this->parseOptions($options));
    }

    /**
     * Store the uploaded file on a filesystem disk.
     *
     * @throws Exception
     */
    public function storeAs(string $path, string|array|null $name = null, array|string $options = []): bool
    {
        if (is_null($name) || is_array($name)) {
            [$path, $name, $options] = ['', $path, $name ?? []];
        }

        $options = $this->parseOptions($options);

        $disk = Arr::pull($options, 'disk');
        $disk = is_null($disk) ? '' : $disk;
        $storage = new Storage($disk);

        $path = trim($path.'/'.$name, '/');

        return $storage->upload($path, $this->getRealPath());
    }

    /**
     * Get the contents of the uploaded file.
     */
    public function get(): false|string
    {
        if (! $this->isValid()) {
            throw new RuntimeException("File does not exist at path {$this->getPathname()}.");
        }

        return file_get_contents($this->getPathname());
    }

    /**
     * Get the file's extension supplied by the client.
     */
    public function clientExtension(): string
    {
        return $this->guessClientExtension();
    }

    /**
     * Create a new file instance from a base instance.
     */
    public static function createFromBase(SymfonyUploadedFile $file, bool $test = false): static
    {
        return $file instanceof static ? $file : new static(
            $file->getPathname(),
            $file->getClientOriginalName(),
            $file->getClientMimeType(),
            $file->getError(),
            $test
        );
    }

    /**
     * Parse and format the given options.
     */
    protected function parseOptions(array|string $options): array
    {
        if (is_string($options)) {
            $options = ['disk' => $options];
        }

        return $options;
    }
}
