<?php

namespace App\Observers;

use App\Models\ApiKey;
use Ramsey\Uuid\Uuid;

class ApiKeyObserver
{
    /**
     * Handle the ApiKey "created" event.
     *
     * @param  \App\Models\ApiKey  $apiKey
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
     * Handle the ApiKey "updated" event.
     *
     * @param  \App\Models\ApiKey  $apiKey
     * @return void
     */
    public function updated(ApiKey $apiKey)
    {
        //
    }

    /**
     * Handle the ApiKey "deleted" event.
     *
     * @param  \App\Models\ApiKey  $apiKey
     * @return void
     */
    public function deleted(ApiKey $apiKey)
    {
        //
    }

    /**
     * Handle the ApiKey "restored" event.
     *
     * @param  \App\Models\ApiKey  $apiKey
     * @return void
     */
    public function restored(ApiKey $apiKey)
    {
        //
    }

    /**
     * Handle the ApiKey "force deleted" event.
     *
     * @param  \App\Models\ApiKey  $apiKey
     * @return void
     */
    public function forceDeleted(ApiKey $apiKey)
    {
        //
    }
}
