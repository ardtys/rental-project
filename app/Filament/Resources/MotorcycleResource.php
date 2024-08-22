<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MotorcycleResource\Pages;
use App\Filament\Resources\MotorcycleResource\RelationManagers;
use App\Models\Motorcycle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Akaunting\Money\Money;
use Filament\Support\RawJs;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MotorcycleResource extends Resource
{
    protected static ?string $model = Motorcycle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('merk_motor')
                    ->options(Motorcycle::MERK_MOTOR)
                    ->required()
                    ->reactive(),
                Forms\Components\Select::make('nama_motor')
                    ->options(function (callable $get) {
                        $merk = $get('merk_motor');
                        return Motorcycle::getNamaMotorByMerk($merk);
                    })
                    ->required()
                    ->disabled(fn (callable $get) => !$get('merk_motor')),
                Forms\Components\Select::make('motor_type')
                    ->options(Motorcycle::MOTOR_TYPE)
                    ->required(),
                Forms\Components\Select::make('year')
                    ->options(Motorcycle::YEARS)
                    ->required(),
                Forms\Components\TextInput::make('plat_nomor')
                    ->required(),
                Forms\Components\TextInput::make('ganti_oli')
                    ->numeric(true, 'id-ID')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->formatStateUsing(fn ($state, $record) => $state ? Money::IDR($state)->format() : '')
                    ->required(),
                Forms\Components\TextInput::make('cleaning_cvt')
                    ->numeric(true, 'id-ID')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->formatStateUsing(fn ($state, $record) => $state ? Money::IDR($state)->format() : '')
                    ->required(),
                Forms\Components\TextInput::make('service_etc')
                    ->numeric(true, 'id-ID')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->formatStateUsing(fn ($state, $record) => $state ? Money::IDR($state)->format() : '')

                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('merk_motor'),
                Tables\Columns\TextColumn::make('nama_motor'),
                Tables\Columns\TextColumn::make('motor_type'),
                Tables\Columns\TextColumn::make('year'),
                Tables\Columns\TextColumn::make('plat_nomor'),
                Tables\Columns\TextColumn::make('ganti_oli')
                ->numeric()
                ->formatStateUsing(fn ($state, $record) => $state ? Money::IDR($state)->format() : ''),
                Tables\Columns\TextColumn::make('cleaning_cvt')
                ->numeric()
                ->formatStateUsing(fn ($state, $record) => $state ? Money::IDR($state)->format() : ''),
                Tables\Columns\TextColumn::make('service_etc')
                ->numeric()
                 ->formatStateUsing(fn ($state, $record) => $state ? Money::IDR($state)->format() : ''),
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
            'index' => Pages\ListMotorcycles::route('/'),
            // 'create' => Pages\CreateMotorcycle::route('/create'),
            // 'edit' => Pages\EditMotorcycle::route('/{record}/edit'),
        ];
    }
}
