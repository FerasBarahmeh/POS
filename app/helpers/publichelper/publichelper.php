<?php

namespace APP\Helpers\PublicHelper;



trait PublicHelper
{
    public function redirect($path): void
    {
        session_write_close();
        header("Location: " . $path);
        exit;
    }

}