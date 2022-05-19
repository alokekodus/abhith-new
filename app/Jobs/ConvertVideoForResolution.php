<?php

namespace App\Jobs;
use FFMpeg;
use App\Models\LessonAttachment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FFMpeg\Format\Video\X264;
use FFMpeg\Coordinate\Dimension;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg as SupportFFMpeg;

class ConvertVideoForResolution implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  
    public $lesson_attachment;
    public function __construct(LessonAttachment $lesson_attachment)
    {
       $this->lesson_attachment=$lesson_attachment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lowBitrateFormat = (new X264)->setKiloBitrate(500);

        // open the uploaded video from the right disk...
        SupportFFMpeg::open(attachmenetPath($this->lesson_attachment->path))

        // add the 'resize' filter...
            ->addFilter(function ($filters) {
                $filters->resize(new Dimension(960, 540));
            })

        // call the 'export' method...
            ->export()

        // tell the MediaExporter to which disk and in which format we want to export...
            ->toDisk('downloadable_videos')
            ->inFormat($lowBitrateFormat)

        // call the 'save' method with a filename...
            ->save($this->lesson_attachment->id . '.mp4');

        // update the database so we know the convertion is done!
        $this->lesson_attachment->update([
            'updated_at' => now(),
        ]);
    }
}
