<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Numeric;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Karyawan';
    protected static ?string $breadcrumb = 'Karyawan';
    protected static ?string $navigationGroup = 'Managemen Karyawan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal Information')
                ->schema([
                    Forms\Components\Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Nama')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('address')
                                ->required()
                                ->label('Alamat')
                                ->maxLength(255),
                            Forms\Components\DatePicker::make('date_hired')
                                ->label('Tanggal Masuk')
                                ->required(),
                            Forms\Components\DatePicker::make('date_of_birth')
                                ->label('Tanggal Lahir')
                                ->required(),
                            Forms\Components\FileUpload::make('photo')
                                ->label('Photo')
                                ->image()
                                ->required()
                                ->maxSize(1024),
                        ])
                ]),
                Section::make('Employee address')
                ->schema([
                    Forms\Components\Grid::make()
                        ->schema([
                            Select::make('country_id')
                                ->options(Country::pluck('name', 'id'))
                                ->label('Negara')
                                ->searchable()
                                ->required()
                                ->preload(),
                            Select::make('state_id')
                                ->options(State::pluck('name', 'id'))
                                ->label('Provinsi')
                                ->searchable()
                                ->required()
                                ->preload(),
                            Select::make('city_id')
                                ->options(City::pluck('name', 'id'))
                                ->label('Kotaity')
                                ->searchable()
                                ->required()
                                ->preload(),
                            Select::make('department_id')
                                ->options(Department::pluck('name', 'id'))
                                ->label('Departemen')
                                ->searchable()
                                ->required()
                                ->preload(),
                            TextInput::make('zip_code')
                                ->label('Kode Pos')
                                ->required()
                                ->numeric(),
                        ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->sortable()
                    ->label('Alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_hired')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('photo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            // 'view' => Pages\ViewEmployee::route('/{record}'),
            // 'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
