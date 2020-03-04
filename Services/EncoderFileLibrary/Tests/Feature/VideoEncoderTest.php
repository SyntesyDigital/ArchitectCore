<?php

namespace Modules\Architect\Services\EncoderFileLibrary\Tests\Feature;

use Modules\Architect\Services\EncoderFileLibrary\Tests\TestCase;
use Modules\Architect\Services\EncoderFileLibrary\Handlers\VideoEncoderHandler;
use Modules\Architect\Services\EncoderFileLibrary\Entities\EncoderFile;

class VideoEncoderTest extends TestCase
{
    public function testIfPhpUnitIsWorking()
    {
        return $this->assertTrue(true);
    }

    public function testEncoding()
    {
        $file = EncoderFile::create([
            'file' => 'testvideo.mp4',
            'type' => EncoderFile::TYPE_VIDEO,
            'status' => EncoderFile::STATUS_PENDING,
        ]);

        if (!$file) {
            return $this->assertTrue(false);
        }
        $inputPath = base_path().'/Modules/Architect/Services/EncoderFileLibrary/Tests/Files/';
        $outputPath = base_path().'/Modules/Architect/Services/EncoderFileLibrary/Tests/Files/Output/';

        $encoder = new VideoEncoderHandler($file, $inputPath, $outputPath);
        $outputFile = $encoder->handle();

        if ($outputFile->status != EncoderFile::STATUS_DONE) {
            return $this->assertTrue(false);
        }

        return $this->assertTrue(true);
    }
}
