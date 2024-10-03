
   UnexpectedValueException 

  There is no existing directory at "/var/www/storage/logs" and it could not be created: Permission denied

  at vendor/monolog/monolog/src/Monolog/Handler/StreamHandler.php:219
    215▕             set_error_handler([$this, 'customErrorHandler']);
    216▕             $status = mkdir($dir, 0777, true);
    217▕             restore_error_handler();
    218▕             if (false === $status && !is_dir($dir) && strpos((string) $this->errorMessage, 'File exists') === false) {
  ➜ 219▕                 throw new \UnexpectedValueException(sprintf('There is no existing directory at "%s" and it could not be created: '.$this->errorMessage, $dir));
    220▕             }
    221▕         }
    222▕         $this->dirCreated = true;
    223▕     }

      [2m+10 vendor frames [22m
  11  [internal]:0
      Illuminate\Foundation\Bootstrap\HandleExceptions::handleException(Object(UnexpectedValueException))
