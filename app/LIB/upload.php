<?php

namespace APP\LIB;

use APP\Helpers\PublicHelper\PublicHelper;

class Upload
{
    use PublicHelper;
    use Validation;
    private string $name;

    private string $type;

    private string $size;
    private int|string $error;
    private string $tempDIR;
    private string $extension;
    private Language $language;
    private Messenger $message;
    private string $destination;
    private array $pactExtension = [
        "png", "jpg", "jp",
    ];

    public function __construct(array $file, Language $language, $destination='')
    {
        $this->name     = $file["name"];
        $this->type     = $file["type"];
        $this->size     = $file["size"];
        $this->error    = $file["error"];
        $this->tempDIR  = $file["tmp_name"];
        $this->language = $language;
        $this->destination = $destination ?? $_SERVER["HTTP_REFERER"];
    }

    private function setExtension(): void
    {
        preg_match_all('/([a-z]{1,4})$/i', $this->name, $m);
        $this->extension = strtolower($m[0][0]);
    }
    private function encryptName(): void
     {
        str_replace(' ', '', $this->name);
        $this->name = explode('.', $this->name)[0];
        $this->name = substr(md5($this->name . MAIN_SALT), 0, 30);
    }
    private function isValidSizeFile(): array|bool
    {
        preg_match_all('/(\d+)([MG])$/i', MAX_SIZE_FILE_UPLOAD, $matches);
        $maxFileSizeToUpload    = $matches[1][0];
        $sizeUnit               = $matches[2][0];
        $currentFileSize        = ($sizeUnit == 'M') ? ($this->size / 1024 / 1024) : ($this->size / 1024 / 1024 / 1024);
        $currentFileSize        = ceil($currentFileSize);

        if ($currentFileSize > $maxFileSizeToUpload) {
            return [MAX_SIZE_FILE_UPLOAD, $currentFileSize];
        }
            return true;

    }
    private function isValid(): bool
    {
        // TODO: create Trait to validate errors files
        // TODO: Update Functionality Send Messages Params
        if (mb_strlen($this->name) > 35) {
            throw new \Exception("file_error_large_long_name" . "|35");
        }


        $sizeValid = $this->isValidSizeFile();
        if ( is_array($sizeValid) ) {
            array_unshift($sizeValid, "file_error_large_size");
            $m = array_shift($sizeValid);
            throw new \Exception($m . "|" . implode('|', $sizeValid));
        }

        if (! is_writable($this->determineFolderStorage())) {
            $nameDir = explode(DIRECTORY_SEPARATOR, $this->determineFolderStorage());
            throw new \Exception("file_error_directory_not_writable" . "|". end($nameDir));
        }
        if (! in_array($this->extension, $this->pactExtension)) {
            $validExtension = [$this->extension, trim(implode(', ', $this->pactExtension), ", ")];
            array_unshift($validExtension, "file_error_field_extension");
            throw new \Exception("file_error_field_extension" . "|". $validExtension [1] .
                '|[' . end($validExtension) . ']');

        }
        return true;
    }

    public function getEncryptNameFile(): string
    {
        return $this->name . '.' . $this->extension;
    }

    private function isImage(): false|int
    {
        return preg_match("/image/i", $this->type);
    }
    private function determineFolderStorage(): string
    {
        if ($this->isImage()) {
            $storageFolderName = IMAGES_UPLOAD_PATH;
        } else {
            $storageFolderName = DOCS_UPLOAD_PATH;
        }

        return $storageFolderName;
    }
    private function handlerName(): void
    {
        $this->encryptName();
    }
    private function moveFile(): \Exception|static
    {
        if (move_uploaded_file($this->tempDIR, $this->determineFolderStorage() . DS . $this->getEncryptNameFile()))  {
            return $this;
        } else {
            throw new \Exception("file_error_when_upload" . "|".  $this->getEncryptNameFile());
        }
    }
    public function upload(): void
    {
        $this->setExtension();

        if ( $this->isValid() ) {
            $this->handlerName();
            $this->moveFile();
        }
    }
}