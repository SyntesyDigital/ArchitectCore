<?php

namespace Modules\Architect\Services\EncoderFileLibrary\Handlers;

use Modules\Architect\Services\EncoderFileLibrary\Entities\EncoderFile;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AudioEncoderHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $cmd = 'ffmpeg -i %s -vn -ar 44100 -ac 2 -b:a 192k %s';

    public function __construct(
        EncoderFile $file,
        $inputPath = null,
        $outputPath = null,
        $callbackHandler = null
    ) {
        $this->file = $file;
        $this->inputPath = $inputPath;
        $this->outputPath = $outputPath;
        $this->callbackHandler = $callbackHandler;
    }

    public function handle()
    {
        $filename = uniqid(rand(), false).'.mp3';

        $this->file->update([
            'status' => EncoderFile::STATUS_IN_PROGRESS,
        ]);

        if ($this->inputPath) {
            $input = $this->inputPath.$this->file->file;
        } else {
            $input = storage_path('app/public/'.$this->file->file);
        }
        if ($this->outputPath) {
            $output = $this->outputPath.$filename;
        } else {
            $output = storage_path('app/public/'.$filename);
        }

        exec(sprintf($this->cmd, $input, $output), $response, $exit_code);

        if (!$exit_code) {
            $this->file->update([
                'file' => $filename,
                'status' => EncoderFile::STATUS_DONE,
            ]);

            if ($this->callbackHandler) {
                $this->callbackHandler->handle($output, $this->file);
            }
        }

        return $this->file;
    }
}
