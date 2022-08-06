<?php

namespace App\Jobs;

use App\Mail\FactureMail;
use App\Models\Client;
use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class FactureMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $commande;

    public $client;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Commande $commande, Client $client)
    {
        $this->commande = $commande;
        $this->client = $client;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->client->email)
            ->send(new FactureMail($this->commande));
    }
}
