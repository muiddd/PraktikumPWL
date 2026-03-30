<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Facades\Filament;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Group;


class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([

                    Section::make("Post Details")
                        ->description("Fill in the details of the post")
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->rules('min:5')
                                ->validationMessages([
                                    'required' => 'Judul tidak boleh kosong, wajib diisi.',
                                    'min' => 'Judul terlalu pendek, harus minimal 5 karakter.',
                                ]),
                            TextInput::make('slug')
                                ->required()
                                ->rules('min:3')
                                ->unique(ignoreRecord: true)
                                ->validationMessages([
                                    'required' => 'Slug wajib diisi.',
                                    'unique' => 'Slug ini sudah dipakai oleh postingan lain.',
                                    'min' => 'Slug terlalu pendek, minimal 3 karakter.',
                                ]),
                            Select::make('category_id')
                                ->relationship("category", "name")
                                ->required()
                                ->preload()
                                ->searchable(),
                            ColorPicker::make("color"),
                            MarkdownEditor::make("body")
                                ->columnSpanFull(),
                        ])
                        ->columns(2),
                ])->columnSpan(2),

                Group::make([

                    Section::make("Image Upload")
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->required()
                                ->disk('public')
                                ->directory('posts')
                        ]),
                    Section::make("Meta Information")
                        ->icon('heroicon-o-tag')
                        ->schema([
                            TagsInput::make("tags"),
                            Checkbox::make("published"),
                            DateTimePicker::make("published_at"),
                        ]),

                ])->columnSpan(1),

            ])->columns(3);
    }
}
