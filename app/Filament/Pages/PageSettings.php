<?php

namespace App\Filament\Pages;

use App\Models\PageSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Illuminate\Support\Facades\Auth;

class PageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string $view = 'filament.pages.page-settings';
    protected static ?string $navigationLabel = 'Pengaturan Halaman';
    protected static ?string $title = 'Pengaturan Halaman';
    protected static ?string $slug = 'page-setting';
    protected static ?string $navigationGroup = 'Website';

    public ?array $data = [];

    public function mount(): void
    {
        $pageSettings = PageSetting::first();

        if ($pageSettings) {
            $this->form->fill($pageSettings->toArray());
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
    Forms\Components\Tabs\Tab::make('Logo & Branding')
                            ->icon('heroicon-o-photo')
                            ->schema([
                               Forms\Components\Section::make('Logo Website')
    ->description('Upload logo yang akan ditampilkan di website')
    ->schema([
        Forms\Components\Grid::make(2)
            ->schema([
                // Kolom kiri: info & label
                Forms\Components\Placeholder::make('logo_info')
                    ->label('Logo')
                    ->content('Format: JPG, PNG, GIF. Maksimal 2MB'),

                // Kolom kanan: file upload dengan preview kotak
                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->directory('homepage')
                    ->imagePreviewHeight(150)
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth(300)
                    ->imageResizeTargetHeight(300)
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif']),
            ]),
    ]),


                            ]),

                        Forms\Components\Tabs\Tab::make('Hero Section')
                            ->icon('heroicon-o-star')
                            ->schema([
                                Forms\Components\Section::make('Bagian Hero')
                                    ->description('Konten utama yang akan ditampilkan di bagian atas halaman')
                                    ->schema([
                                        Forms\Components\TextInput::make('judul_hero')
                                            ->label('Judul Hero')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Masukkan judul hero section'),

                                        Forms\Components\Textarea::make('deskripsi_hero')
                                            ->label('Deskripsi Hero')
                                            ->rows(4)
                                            ->maxLength(1000)
                                            ->placeholder('Masukkan deskripsi hero section'),

                                        Forms\Components\FileUpload::make('gambar_hero')
                                            ->label('Gambar Hero')
                                            ->image()
                                            ->directory('homepage')
                                            ->imagePreviewHeight(200)
                                            ->imageResizeMode('contain')
                                            ->maxSize(5120)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                            ->helperText('Format: JPG, PNG. Maksimal 5MB. Resolusi disarankan: 1920x1080px'),
                                        Forms\Components\FileUpload::make('gambar_hero1')
                                            ->label('Gambar Hero')
                                            ->image()
                                            ->directory('homepage')
                                            ->imagePreviewHeight(200)
                                            ->imageResizeMode('contain')
                                            ->maxSize(5120)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                            ->helperText('Format: JPG, PNG. Maksimal 5MB. Resolusi disarankan: 1920x1080px'),
                                        Forms\Components\FileUpload::make('gambar_hero2')
                                            ->label('Gambar Hero')
                                            ->image()
                                            ->directory('homepage')
                                            ->imagePreviewHeight(200)
                                            ->imageResizeMode('contain')
                                            ->maxSize(5120)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                            ->helperText('Format: JPG, PNG. Maksimal 5MB. Resolusi disarankan: 1920x1080px'),

                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Sejarah')
                            ->icon('heroicon-o-book-open')
                            ->schema([
                                Forms\Components\Section::make('Bagian Sejarah')
                                    ->description('Konten tentang sejarah organisasi/perusahaan')
                                    ->schema([
                                        Forms\Components\TextInput::make('judul_sejarah')
                                            ->label('Judul Sejarah')
                                            ->maxLength(255)
                                            ->placeholder('Masukkan judul bagian sejarah'),

                                        Forms\Components\Textarea::make('deskripsi_sejarah')
                                            ->label('Deskripsi Sejarah')
                                            ->rows(6)
                                            ->maxLength(2000)
                                            ->placeholder('Masukkan deskripsi sejarah organisasi'),

                                        Forms\Components\FileUpload::make('gambar_sejarah')
                                            ->label('Gambar Profil')
                                            ->image()
                                            ->directory('homepage')
                                            ->imagePreviewHeight(200)
                                            ->imageResizeMode('contain')
                                            ->maxSize(5120)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                            ->helperText('Format: JPG, PNG. Maksimal 5MB'),
                                        Forms\Components\FileUpload::make('gambar_sejarah1')
                                            ->label('Gambar Profil')
                                            ->image()
                                            ->directory('homepage')
                                            ->imagePreviewHeight(200)
                                            ->imageResizeMode('contain')
                                            ->maxSize(5120)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                            ->helperText('Format: JPG, PNG. Maksimal 5MB'),
                                        Forms\Components\FileUpload::make('gambar_sejarah2')
                                            ->label('Gambar Profil')
                                            ->image()
                                            ->directory('homepage')
                                            ->imagePreviewHeight(200)
                                            ->imageResizeMode('contain')
                                            ->maxSize(5120)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                            ->helperText('Format: JPG, PNG. Maksimal 5MB'),

                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Video')
                            ->icon('heroicon-o-play-circle')
                            ->schema([
                                Forms\Components\Section::make('Bagian Video')
                                    ->description('Konten video yang akan ditampilkan di website')
                                    ->schema([
                                        Forms\Components\TextInput::make('judul_video')
                                            ->label('Judul Video')
                                            ->maxLength(255)
                                            ->placeholder('Masukkan judul bagian video'),

                                        Forms\Components\Textarea::make('deskripsi_video')
                                            ->label('Deskripsi Video')
                                            ->rows(4)
                                            ->maxLength(1000)
                                            ->placeholder('Masukkan deskripsi video'),

                                        Forms\Components\TextInput::make('url_video')
                                            ->label('URL Video')
                                            ->url()
                                            ->placeholder('https://www.youtube.com/watch?v=...')
                                            ->helperText('Masukkan URL video YouTube atau platform video lainnya'),
                                        Forms\Components\TextInput::make('url_video1')
                                            ->label('URL Video')
                                            ->url()
                                            ->placeholder('https://www.youtube.com/watch?v=...')
                                            ->helperText('Masukkan URL video YouTube atau platform video lainnya'),
                                        Forms\Components\TextInput::make('url_vide2o')
                                            ->label('URL Video')
                                            ->url()
                                            ->placeholder('https://www.youtube.com/watch?v=...')
                                            ->helperText('Masukkan URL video YouTube atau platform video lainnya'),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Struktur Organisasi')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Forms\Components\Section::make('Struktur Organisasi')
                                    ->description('Gambar struktur organisasi yang akan ditampilkan')
                                    ->schema([
                                        Forms\Components\FileUpload::make('gambar_struktur_organisasi')
                                            ->label('Gambar Struktur Organisasi')
                                            ->image()
                                            ->directory('homepage')
                                            ->imagePreviewHeight(300)
                                            ->imageResizeMode('contain')
                                            ->maxSize(5120)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/pdf'])
                                            ->helperText('Format: JPG, PNG, PDF. Maksimal 5MB. Gunakan gambar dengan resolusi tinggi untuk hasil terbaik'),
                                    ]),
                            ]),
                              Forms\Components\Tabs\Tab::make('SPMB')
    ->icon('heroicon-o-sparkles')
    ->schema([
        Forms\Components\Section::make('SPMB')
            ->description('Masukkan informasi SPMB.')
            ->schema([
            Forms\Components\Grid::make(2)
            ->schema([
                Forms\Components\TextInput::make('tanggal_ppdb')
                    ->label('Tanggal Pendaftaran')
                    ->required()
                    ->placeholder('Misal 10 - 21 Agustus 2025...'),
                Forms\Components\TextInput::make('pengumuman_ppdb')
                    ->label('Tanggal Pengumuman')
                    ->required()
                    ->placeholder('Misal 25 Agustus 2025...'),
            ]),
               Forms\Components\RichEditor::make('syarat_ppdb')
    ->label('Syarat Pendaftaran')
    ->columnSpanFull()

                    ])

            ]),
     Forms\Components\Tabs\Tab::make('Visi dan Misi')
    ->icon('heroicon-o-sparkles')
    ->schema([
        Forms\Components\Section::make('Visi dan Misi')
            ->description('Masukkan visi dan misi organisasi atau institusi.')
            ->schema([
                Forms\Components\Textarea::make('visi')
                    ->label('Visi')
                    ->rows(4)
                    ->required()
                    ->placeholder('Masukkan visi di sini...'),
      TinyEditor::make('misi')
    ->profile('default') // atau 'simple', 'minimal'
    ->fileAttachmentsDisk('public')
    ->fileAttachmentsDirectory('uploads')
    ->fileAttachmentsVisibility('public')
    ->required() // tambahkan jika field wajib diisi
    ->columnSpanFull(), // agar editor mengambil lebar penuh

            ]),
    ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->submit('save')
                ->keyBindings(['mod+s'])
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $pageSettings = PageSetting::first();

        if ($pageSettings) {
            $pageSettings->update($data);
        } else {
            PageSetting::create($data);
        }

        Notification::make()
            ->success()
            ->title('Pengaturan berhasil disimpan')
            ->body('Semua pengaturan halaman telah berhasil disimpan.')
            ->send();
    }
 public static function canViewAny(): bool
{
    return Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin';
}
        public static function shouldRegisterNavigation(): bool
{
    return Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin';
}
    protected function getHeaderActions(): array
    {
        return [

        ];
    }
    public function hasFullWidthFormActions(): bool
{
    return true; // atau false jika kamu tidak ingin tombol full-width
}

}
