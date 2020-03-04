<?php

namespace Modules\Architect\Services\EncoderFileLibrary\Handlers;

use Modules\Architect\Services\EncoderFileLibrary\Entities\EncoderFile;

class FileEncoderHandler
{
    public function __construct(
        EncoderFile $file,
        $inputPath = null,
        $outputPath = null,
        $queue = true,
        $callbackHandler = null
    ) {
        $this->file = $file;
        $this->inputPath = $inputPath;
        $this->outputPath = $outputPath;
        $this->queue = $queue;
        $this->callbackHandler = $callbackHandler;
    }

    public function handle()
    {
        if ($this->file->type == EncoderFile::TYPE_AUDIO) {
            $job = new AudioEncoderHandler($this->file, $this->inputPath, $this->outputPath, $this->callbackHandler);
        } elseif ($this->file->type == EncoderFile::TYPE_VIDEO) {
            $job = new VideoEncoderHandler($this->file, $this->inputPath, $this->outputPath, $this->callbackHandler);
        }

        if ($this->queue) {
            dispatch($job);

            return true;
        } else {
            return dispatch_now($job);
        }

        return false;
    }
}
