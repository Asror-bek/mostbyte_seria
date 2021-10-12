<?php

namespace App\Service;

use App\Models\Client;

class ClientService
{

    public function list()
    {
        return Client::query()->get();
    }

    public function createClient(array $validated)
    {
        return Client::query()->create($validated);
    }

    public function updateClient(array $validated, Client $client)
    {
        return tap($client)->update($validated);
    }

    public function deleteClient(Client $client)
    {
        $client->delete();
    }

}


?>
