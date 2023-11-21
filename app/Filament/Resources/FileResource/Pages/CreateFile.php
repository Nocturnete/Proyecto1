<?php

namespace App\Filament\Resources\FileResource\Pages;

use Filament\Resources\Pages\CreatePage;
use App\Filament\Resources\FileResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Storage;

class CreateFile extends ManageRecords
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data = ['filepath', 'filesize'];
        $filepath = $data['filepath'];
        $data['filesize'] = $filesize;
        $filesize = Storage::disk('public')->size($filepath);
       
        return $data;
    }
 
}
