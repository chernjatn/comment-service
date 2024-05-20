<?php

namespace App\Filament\Resources;

use App\Enums\Channel;
use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use App\Services\Wp\WpConnectionManager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Checkbox::make('is_active')
                            ->label('Активность')
                            ->default(false),
                        Forms\Components\TextInput::make('name')
                            ->label('Автор')
                            ->required(),
                        Forms\Components\Select::make('article_id')
                            ->relationship('article', titleAttribute: 'title')
                            ->placeholder('Выберите статью')
                            ->label('Статья')
                            ->preload()
                            ->required(),
                        Forms\Components\Textarea::make('text')
                            ->label('Текст')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->searchable(),
                Tables\Columns\BooleanColumn::make('is_active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options(Channel::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\CreateAction::make(),
                Tables\Actions\ReplicateAction::make(),
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
