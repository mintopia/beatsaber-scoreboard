<?php

namespace App\Observers;

use App\ApiKey;
use Ramsey\Uuid\Uuid;

class ApiKeyObserver
{
    /**
     * Handle the api key "created" event.
     *
     * @param  \App\ApiKey  $apiKey
     * @return void
     */
    public function created(ApiKey $apiKey)
    {
        //
    }

    public function creating(ApiKey $apiKey)
    {
        if (!$apiKey->key) {
            $apiKey->key = Uuid::uuid4()->toString();
        }
    }

    /**
     * Handle the api key "updated" event.
     *
     * @param  \App\ApiKey  $apiKey
     * @return void
     */
    public function updated(ApiKey $apiKey)
    {
        //
    }

    /**
     * Handle the api key "deleted" event.
     *
     * @param  \App\ApiKey  $apiKey
     * @return void
     */
    public function deleted(ApiKey $apiKey)
    {
        //
    }

    /**
     * Handle the api key "restored" event.
     *
     * @param  \App\ApiKey  $apiKey
     * @return void
     */
    public function restored(ApiKey $apiKey)
    {
        //
    }

    /**
     * Handle the api key "force deleted" event.
     *
     * @param  \App\ApiKey  $apiKey
     * @return void
     */
    public function forceDeleted(ApiKey $apiKey)
    {
        //
    }
}
