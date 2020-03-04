<?php

namespace Modules\Architect\Services\EncoderFileLibrary\Tests\Feature;

use Modules\Architect\Services\EncoderFileLibrary\Tests\TestCase;
use Modules\Architect\Services\EncoderFileLibrary\Handlers\AudioEncoderHandler;
use Modules\Architect\Services\EncoderFileLibrary\Entities\EncoderFile;

class AudioEncoderTest extends TestCase
{
    public function testIfPhpUnitIsWorking()
    {
        return $this->assertTrue(true);
    }

    public function testEncoding()
    {
        $file = EncoderFile::create([
            'file' => 'testaudio.opus',
            'type' => EncoderFile::TYPE_AUDIO,
            'status' => EncoderFile::STATUS_PENDING,
        ]);

        if (!$file) {
            return $this->assertTrue(false);
        }
        $inputPath = base_path().'/Modules/Architect/Services/EncoderFileLibrary/Tests/Files/';
        $outputPath = base_path().'/Modules/Architect/Services/EncoderFileLibrary/Tests/Files/Output/';

        $encoder = new AudioEncoderHandler($file, $inputPath, $outputPath);
        $outputFile = $encoder->handle();

        if ($outputFile->status != EncoderFile::STATUS_DONE) {
            return $this->assertTrue(false);
        }

        return $this->assertTrue(true);
    }
}
