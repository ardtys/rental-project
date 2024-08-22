<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use App\Models\Motorcycle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('telephone_number')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('passport_code')
                ->required()
                ->numeric(),
            Forms\Components\FileUpload::make('passport_image')
                ->required()
                ->image(),
            Forms\Components\DatePicker::make('start_date')
                ->required(),
            Forms\Components\DatePicker::make('end_date')
                ->required(),
            Forms\Components\Select::make('motorcycle_id')
                ->label('Nama Motor')
                ->options(Motorcycle::pluck('nama_motor', 'id'))
                ->required()
                ->searchable(),
            Forms\Components\TextInput::make('rate_per_day')
                ->required()
                ->numeric()
                ->prefix('Rp'),
            Forms\Components\TextInput::make('total_price')
                ->required()
                ->numeric()
                ->prefix('Rp'),  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('telephone_number'),
                Tables\Columns\TextColumn::make('passport_code'),
                Tables\Columns\ImageColumn::make('passport_image'),
                Tables\Columns\TextColumn::make('start_date')
                    ->date(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date(),
                Tables\Columns\TextColumn::make('motorcycle.nama_motor')
                    ->label('Nama Motor'),
                Tables\Columns\TextColumn::make('rate_per_day')
                    ->money('idr'),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('idr'),
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
            'index' => Pages\ListCustomers::route('/'),
            // 'create' => Pages\CreateCustomer::route('/create'),
            // 'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
