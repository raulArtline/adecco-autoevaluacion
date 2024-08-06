<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ManageUsers extends ManageRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                //Mutate form data before creating a user
                ->mutateFormDataUsing(function (array $data): array {
                    $data['email_verified_at'] = now();
                    $data['remember_token'] = Str::random(10);

                    // dd($data);
                    return $data;
                }),
        ];
    }
}
