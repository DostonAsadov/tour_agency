<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourResource\Pages;
use App\Filament\Resources\TourResource\RelationManagers;
use App\Models\Tour;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Lexer\TokenEmulator\PipeOperatorEmulator;
use PHPUnit\Event\Telemetry\Duration;

use function Laravel\Prompts\select;

class TourResource extends Resource
{
    protected static ?string $model = Tour::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->label('Tour nomi')
                    ->required()
                    ->maxLength(255),
                Select::make('categories')->label('Kategoriya')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->preload()
                    ->required(),
                Textarea::make('description')->label('Tasnifi')
                    ->placeholder('Tour haqida biroz malumot kiriting'),
                TextInput::make('price')->label("Narxi dollarda")
                    ->required()
                    ->maxLength(10)
                    ->placeholder('son bilan narxni kiriting, masalan: 100.00'),
                TextInput::make('duration')->label('Davomiyligi')
                    ->required()
                    ->maxLength(100)
                    ->placeholder('son bilan davomiylikni kiriting, masalan: 7'),
                TextInput::make('capacity_of_people')->label('Turist soni')
                    ->required()
                    ->maxLength(100)
                    ->placeholder('son bilan odam sonini kiriting, masalan: 10'),
                Select::make('season')->label('Mavsumi')
                    ->options([
                        'Yoz' => 'Yoz',
                        'Qish' => 'Qish',
                        'Bahor' => 'Bahor',
                        'Kuz' => 'Kuz',
                    ]),
                FileUpload::make('image')->label('Rasm')
                    ->image()
                    ->disk('public')
                    ->directory('tours')
                    ->imageEditor()
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('image')->label('Rasm')->disk('public')->square(),
                TextColumn::make('name')->label('Tour nomi'),
                TextColumn::make('categories.name')->label('Kategoriya')->badge()->separator(', '),
                TextColumn::make('description')->label('Tasnifi'),
                TextColumn::make('price')->label("narxi dollarda"),
                TextColumn::make('duration')->label('Davomiyligi'),
                TextColumn::make('capacity_of_people')->label('Turist soni'),
                TextColumn::make('season')->label('Mavsumi'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTours::route('/'),
            'create' => Pages\CreateTour::route('/create'),
            'edit' => Pages\EditTour::route('/{record}/edit'),
        ];
    }
}
