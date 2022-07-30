<?php

namespace App\Jobs;

use App\Models\UserExport;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class PdfExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $users;
    public $i;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $i)
    {
        $this->users = $users;
        $this->i = $i;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pdf = PDF::loadView('export.pdf', ['users' => $this->users])->setPaper('legal', 'portrait');
        $fileName = "export$this->i.pdf";
        $pdfFilePath = 'pdf/split/' . $fileName;
        Storage::disk('local')->put($pdfFilePath, $pdf->output());
    }
}
