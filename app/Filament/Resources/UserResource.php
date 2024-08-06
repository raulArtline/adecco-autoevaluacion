<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;


    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $modelLabel = 'usuario';
    protected static ?string $pluralModelLabel = 'usuarios';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->minLength(5)
                    ->maxLength(50)
                    ->columnSpan(2),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->rule('regex:/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/')
                    ->unique()
                    ->required()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->helperText(fn (string $context): string | null => $context === 'edit' ? 'Dejar vacio si no se desea editar' : null)
                    ->validationMessages([
                        'unique' => 'El :attribute ya existe en el sistema.',
                        'email' => 'El :attribute debe ser una dirección de correo válida.',
                        'regex' => 'El :attribute debe tener un formato válido.',
                    ]),
                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->helperText(fn (string $context): string | null => $context === 'edit' ? 'Dejar vacio si no se desea editar' : null)
                    ->rules([
                        'string',
                        'min:6',
                        'regex:/[A-Z]/', // Al menos una mayúscula
                        'regex:/[0-9]/', // Al menos un número
                    ])
                    ->validationMessages([
                        'required' => 'El campo contraseña es obligatorio al crear un usuario.',
                        'min' => 'La contraseña debe tener al menos 8 caracteres.',
                        'regex' => 'La contraseña debe contener al menos una mayúscula y un número.',
                    ]),
                Toggle::make('is_admin')->label('Administrador')->default(0)
                    ->onIcon('heroicon-m-user-plus')
                    ->offIcon('heroicon-m-user-minus')
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre')->sortable(),
                TextColumn::make('email')->sortable(),
                TextColumn::make('is_admin')
                    ->label('Perfil')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state == '1' ? 'Admin' : 'Editor')
                    ->color(fn (string $state): string => $state == '1' ? 'success' : 'warning'),
            ])
            ->filters([
                // Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),

            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                //     Tables\Actions\ForceDeleteBulkAction::make(),
                //     Tables\Actions\RestoreBulkAction::make(),
                // ]),
            ])
            ->headerActions([
                // CreateAction::make()
                //     ->mutateFormDataUsing(function (array $data): array {
                //         $data['email_verified_at'] = now();
                //         $data['remember_token'] = Str::random(10);

                //         return $data;
                //     }),
            ]);
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
