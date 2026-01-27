<?php
namespace App\Filament\Resources\Orders\Schemas;

use Dom\Text;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\View;

use App\Models\Post;
use App\Models\User;
use Filament\Actions\Action;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Get;

class OrderForm
{
    public array $orderItems = [];

    public function mount(): void {
        $this->orderItems = session('orderItems',[]);
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Allgemeine Informationen')
                    ->description('Geben Sie die allgemeinen Informationen zur Bestellung ein.')
                    ->schema([
                        Select::make('customer_id')
                            ->relationship('customer', 'prename')
                            ->getOptionLabelFromRecordUsing(function ($record) {
                                return $record->prename . ' ' . $record->surname;
                            })
                            ->createOptionForm([
                                TextInput::make('prename')
                                ->required()
                                ->label('Vorname'),
                                TextInput::make('surname')
                                ->required()
                                ->label('Nachname'),
                                TextInput::make('telephonenumber')
                                ->required()
                                ->label('Telefonnummer'),
                            ])
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Kunde'),
                        
                        Select::make('orderstatus_id')
                            ->relationship('orderStatus', 'status_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->default(1)
                            ->label('Status'),

                        DatePicker::make('order_date')
                            ->label('Bestelldatum')
                            ->date()
                            ->default(today()),
                        DatePicker::make('delivery_date')
                            ->label('Abholdatum')
                            ->date()
                            ->default(null),
                        TextInput::make('PickupLocation')
                            ->label('Abholort')
                            ->default(null),
                        
                        TextInput::make('note')
                            ->label('Notiz')
                            ->default(null),

                    ])->columnSpan(2)->columns(2),

            Section::make('Produktauswahl')
                ->schema([
                    Select::make('category_id')
                        ->label('Kategorie')
                        ->options(fn () => \App\Models\Category::pluck('category_name', 'category_id'))
                        ->live()
                        ->columnSpan(3),

                        Section::make('Auswahl')
                        ->schema(function ($get){
                                $categoryId = $get('category_id');

                                if(!$categoryId){
                                    return[];
                                }

                                $products = \App\Models\Product::where('category_id',$categoryId)->get();
                                $actions = [];

                                foreach ($products as $product){
                                    $actions[] = Action::make('add_' . $product->product_id)
                                        ->label($product->product_name)
                                        ->icon('heroicon-o-plus')
                                        ->color('success')
                                        ->form([
                                            TextInput::make('quantity')
                                                    ->label('Menge')
                                                    ->numeric()
                                                    ->required()
                                                    ->default(1),
                                            TextInput::make('note')
                                                    ->label('Notiz'),
                                        ])
                                        ->action(function ($data, $set, $get) use ($product) {
                                            $orderItems = $get('orderInfos') ?? [];                                          
                                            $orderItems[] = [
                                                'product_id' => $product->product_id,
                                                'product_name' => $product->product_name,
                                                'quantity' => $data['quantity'],
                                                'note' => $data['note'] ?? '',
                                            ];
                                            
                                            $set('orderInfos', $orderItems);

                                        });
                                }
                                return $actions;
                            })
                            ->columnSpan(1),
                    

                            Section::make("Produkte in der Bestellung")
                            ->schema([
                                Repeater::make('orderInfos')
                                    ->disableLabel()
                                    ->relationship('orderInfos')
                                    ->disableItemCreation()
                                    ->schema([
                                        Hidden::make('product_id'),
                                        TextInput::make('product_name')
                                            ->label('Produkt')
                                            ->disabled()
                                            ->afterStateHydrated(function ($set, $record, $state) {
                                                if ($record && $record->product) {
                                                    $set('product_name', $record->product->product_name);
                                                } else {
                                                    $set('product_name', \App\Models\Product::find($state['product_id'])?->product_name);
                                                }
                                            }),
                                        TextInput::make('quantity')
                                            ->label('Menge')
                                            ->numeric(),
                                        TextInput::make('note')
                                            ->label('Notiz')
                                    ])
                                    ->defaultItems(0)
                                    ->columns(3)
                                    ->columnSpan(3),
                            ])
                        
                        ->columnSpan(2),
                ])
                ->columnSpan(3)->columns(3),
            ]);            
    }
}
