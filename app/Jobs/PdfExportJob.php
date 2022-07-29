<?php

namespace App\Jobs;

use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PdfExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $users;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $pdf = PDF::loadView('export.pdf', ['users' => $this->users])->setPaper('legal', 'portrait');
        $fileName = 'export.pdf';
        $pdfFilePath = 'results/' . $fileName;
        Storage::disk('local')->put($pdfFilePath, $pdf->output());
    }
}
