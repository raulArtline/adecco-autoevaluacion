<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SurveyResource\Pages;
use App\Filament\Resources\SurveyResource\RelationManagers;
use App\Models\Survey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\View;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Response;
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
                    ->label('Resultados')
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    ->color(Color::hex('#343434'))
                    ->copyable(function ($record) {
                        return config('app.url') . '/' . $record->uuid;
                    }),
                Tables\Actions\EditAction::make(),
                // ->successRedirectUrl(route('surveys.list')),
                Tables\Actions\ViewAction::make()->iconButton(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export')
                    // ->color('secondary')
                    ->label('Exportar resultados')
                    ->action(function () {
                        return static::exportResults();
                    })
                    // ->requiresConfirmation()
                    ->icon('heroicon-s-document-arrow-down')

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

                ViewEntry::make('resultados')
                    ->label('Resultados')
                    ->view('filament.infolist.infolist-resultados-table'), // Ruta de la vista personalizada
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


    // custom funcion para exportar los resultados
    public static function exportResults()
    {
        // Recupera todas las encuestas
        $surveys = Survey::all();

        // Nombre del archivo que generaremos
        $fileName = 'resultados_encuestas.csv';

        // Encabezados HTTP para la descarga
        $headers = [
            "Content-type"        => "text/csv; charset=utf-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Reunir todas las claves únicas de todas las encuestas para crear columnas dinámicamente
        $allQuestions = [];
        foreach ($surveys as $survey) {
            $decodedResults = json_decode($survey->results, true);
            if (is_array($decodedResults)) {
                $allQuestions = array_unique(array_merge($allQuestions, array_keys($decodedResults)));
            }
        }

        // dd($allQuestions);

        // Encabezado del CSV, comenzando con la columna 'Client'
        $csvHeaders = array_merge(['Cliente'], $allQuestions);

        // Definir el callback que genera el CSV
        $callback = function () use ($surveys, $csvHeaders) {
            $file = fopen('php://output', 'w');

            // Escribir los encabezados del CSV
            fputcsv($file, $csvHeaders);

            // Recorre cada encuesta y escribe sus resultados en el archivo CSV
            foreach ($surveys as $survey) {
                $decodedResults = json_decode($survey->results, true);
                $row = [$survey->client];

                // Añadir cada pregunta en el orden de los encabezados CSV
                foreach (array_slice($csvHeaders, 1) as $question) {  // Omitimos la columna 'Client'
                    $row[] = $decodedResults[$question] ?? ''; // Añade el valor si existe, de lo contrario, un valor vacío
                }

                fputcsv($file, $row);
            }

            // Cerrar el recurso de flujo
            fclose($file);
        };

        // Retorna la respuesta como descarga del archivo CSV
        return response()->stream($callback, 200, $headers);
    }
}
