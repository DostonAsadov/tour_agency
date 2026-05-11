<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Asosiy ma\'lumotlar  ')
                    ->description('Bu yerda kompaniya haqida asosiy ma\'lumotlarni kiritishingiz mumkin')
                    ->icon('heroicon-o-building-office')
                    ->schema([

                        TextInput::make('company_name')->label('Kompaniya nomi')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')->label('Elektron pochta')
                            ->required()
                            ->email(),
                        TextInput::make('address')->label('Manzil')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')->label('Telefon raqami')
                            ->required()
                            ->tel(),
                        TextInput::make('phone2')->label('Ikkinchi telefon raqami')
                            ->required()
                            ->tel(),
                        Repeater::make('working_hours')
                            ->schema([
                                Forms\Components\TextInput::make('days')
                                    ->placeholder('Mon – Sat')
                                    ->required(),
                                Forms\Components\TextInput::make('hours')
                                    ->placeholder('9:00 – 18:00')
                                    ->required(),
                            ])
                            ->columns(2),
                    ])
                    ->collapsible(),
                Section::make('Qo\'shimcha ma\'lumotlar Raqamda')
                    ->description('Bu yerda kompaniya haqida qo\'shimcha ma\'lumotlarni kiritishingiz mumkin')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextInput::make('travelers')->label("Xizmat ko'rsatilgan sayohatchilar soni")
                            ->required()
                            ->numeric(),
                        TextInput::make('completed_tours')->label('Bajarilgan sayohatlar soni')
                            ->required()
                            ->numeric(),
                        TextInput::make('experience_years')->label('Tajriba yili')
                            ->required()
                            ->numeric(),
                        TextInput::make('hotels')->label('Mehmonxonalalar soni')
                            ->nullable()
                            ->numeric(),
                        TextInput::make('number_partners')->label('Hamkorlar soni')
                            ->nullable()
                            ->numeric()
                    ])
                    ->collapsible(),
                Section::make('Ijtimoiy tarmoqlar')
                    ->description('Bu yerda kompaniya ijtimoiy tarmoqlardagi havolalarini kiritishingiz mumkin')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        TextInput::make('facebook_link')->label('Facebook havolasi')
                            ->nullable()
                            ->url(),
                        TextInput::make('instagram_link')->label('Instagram havolasi')
                            ->nullable()
                            ->url(),
                        TextInput::make('youtube_link')->label('YouTube havolasi')
                            ->nullable()
                            ->url(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Kompaniya nomi'),
                Tables\Columns\TextColumn::make('working_hours')
                    ->label('Ish vaqti')
                    ->wrap(),
                Tables\Columns\TextColumn::make('email')->label('Elektron pochta')->wrap(),
                Tables\Columns\TextColumn::make('address')->label('Manzil')->wrap(),
                Tables\Columns\TextColumn::make('phone')->label('Telefon raqami'),
                Tables\Columns\TextColumn::make('phone2')->label('Ikkinchi telefon raqami'),
                Tables\Columns\TextColumn::make('travelers')->label("Xizmat ko'rsatilgan sayohatchilar soni"),
                Tables\Columns\TextColumn::make('completed_tours')->label('Bajarilgan sayohatlar soni'),
                Tables\Columns\TextColumn::make('experience_years')->label('Tajriba yili'),
                Tables\Columns\TextColumn::make('hotels')->label('Mehmonxonalalar soni'),
                Tables\Columns\TextColumn::make('number_partners')->label('Hamkorlar soni'),
                Tables\Columns\TextColumn::make('facebook_link')->label('Facebook havolasi')->wrap(),
                Tables\Columns\TextColumn::make('instagram_link')->label('Instagram havolasi')->wrap(),
                Tables\Columns\TextColumn::make('youtube_link')->label('YouTube havolasi')->wrap(),

            ])
            ->paginated(false)
            ->striped()
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // что не было бы возможности массового удаления, так как мы разрешаем только одну запись
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
    public static function canCreate(): bool
    {
        return \App\Models\About::count() < 1;
    }

    public static function canDeleteAny(): bool
    {
        return false; // Запрещаем удалять страницу
    }
}
