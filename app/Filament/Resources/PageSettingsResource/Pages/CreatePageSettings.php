<?php

namespace App\Filament\Resources\PageSettingsResource\Pages;

use App\Filament\Resources\PageSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\PageSetting;
use Filament\Notifications\Notification;
class CreatePageSettings extends CreateRecord
{
    protected static string $resource = PageSettingsResource::class;
 protected function beforeCreate(): void
    {
        if (PageSetting::count() >= 1) {
            Notification::make()
                ->title('Pengaturan sudah ada')
                ->danger()
                ->body('Hanya diperbolehkan 1 data pengaturan halaman.')
                ->send();

            $this->halt(); // hentikan proses penyimpanan
        }
    }
}
