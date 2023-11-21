<?php

namespace App\Filament\Resources\PlaceResource\Pages;

use App\Filament\Resources\PlaceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Storage;


class CreateFile extends ManageRecords
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        Log::debug("Mutate create form with file relationship");
        // Store file
        $filepath = array_values($this->data['file']['filepath'])[0];
        $filesize = Storage::disk('public')->size($filepath);
        $file = File::create([
            'filepath' => $filepath,
            'filesize' => $filesize
        ]);
        // Store file id
        $data['file_id'] = $file->id;
 
 
        return $data;
    } 
}
