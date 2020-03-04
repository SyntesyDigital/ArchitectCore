<?php

namespace Modules\Architect\Services\EncoderFileLibrary\Tests\Feature;

use Modules\Architect\Services\EncoderFileLibrary\Tests\TestCase;
use Modules\Architect\Services\EncoderFileLibrary\Handlers\FileEncoderHandler;
use Modules\Architect\Services\EncoderFileLibrary\Entities\EncoderFile;

class FileEncoderTest extends TestCase
{
    public function testIfPhpUnitIsWorking()
    {
        return $this->assertTrue(true);
    }

    public function testEncoding()
    {
        $fileAudio = EncoderFile::create([
            'file' => 'testaudio.opus',
            'type' => EncoderFile::TYPE_AUDIO,
            'status' => EncoderFile::STATUS_PENDING,
        ]);

        if (!$fileAudio) {
            return $this->assertTrue(false);
        }
        $inputPath = base_path().'/Modules/Architect/Services/EncoderFileLibrary/Tests/Files/';
        $outputPath = base_path().'/Modules/Architect/Services/EncoderFileLibrary/Tests/Files/Output/';

        $encoder = new FileEncoderHandler($fileAudio, $inputPath, $outputPath, false);
        $outputFile = $encoder->handle();

        if ($outputFile->status != EncoderFile::STATUS_DONE) {
            return $this->assertTrue(false);
        }

        $fileVideo = EncoderFile::create([
            'file' => 'testvideo.mp4',
            'type' => EncoderFile::TYPE_VIDEO,
            'status' => EncoderFile::STATUS_PENDING,
        ]);

        if (!$fileVideo) {
            return $this->assertTrue(false);
        }
        $inputPath = base_path().'/Modules/Architect/Services/EncoderFileLibrary/Tests/Files/';
        $outputPath = base_path().'/Modules/Architect/Services/EncoderFileLibrary/Tests/Files/Output/';

        $encoder = new FileEncoderHandler($fileVideo, $inputPath, $outputPath, false);
        $outputFile = $encoder->handle();

        if ($outputFile->status != EncoderFile::STATUS_DONE) {
            return $this->assertTrue(false);
        }

        return $this->assertTrue(true);
    }
}
