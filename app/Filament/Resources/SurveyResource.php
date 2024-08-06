<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SurveyResource\Pages;
use App\Filament\Resources\SurveyResource\RelationManagers;
use App\Models\Survey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
// Plugings:
// copy: https://v2.filamentphp.com/plugins/copy-actions
use Webbingbrasil\FilamentCopyActions\Tables\Actions\CopyAction;

class SurveyResource extends Resource
{
    protected static ?string $model = Survey::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Encuestas';
    protected static ?string $modelLabel = 'encuesta';
    protected static ?string $pluralModelLabel = 'encuestas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('client')
                    ->label('Cliente')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('question_id')
                    ->label('Preguntas')
                    ->relationship('question', 'name')
                    ->required(),
                // Forms\Components\Textarea::make('results')
                //     ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label("Identificador")
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('client')
                    ->label('Cliente')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('question.name')
                //     ->label('Preguntas')
                //     ->numeric(),
                Tables\Columns\TextColumn::make('question.list_questions')
                    ->label('Lista de preguntas')
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('results')
                    ->label('Resultados'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // pluging para copiar
                CopyAction::make("Copiar url")
                    ->button()
                    ->icon('heroicon-m-pencil-square')
                    ->copyable(function ($record) {
                        return config('app.url') . $record->uuid;
                    }),
                Tables\Actions\EditAction::make(),
                // ->successRedirectUrl(route('surveys.list')),
                Tables\Actions\ViewAction::make()->iconButton(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('uuid')
                    ->label('Url')
                    ->formatStateUsing(function ($state) {
                        return config('app.url') . '/' . $state;
                    }),
            ])
            ->columns(1)
            ->inlineLabel();
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
            'index' => Pages\ListSurveys::route('/'),
            'create' => Pages\CreateSurvey::route('/create'),
            'edit' => Pages\EditSurvey::route('/{record}/edit'),
        ];
    }
}
