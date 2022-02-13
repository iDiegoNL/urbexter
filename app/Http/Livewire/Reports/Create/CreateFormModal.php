<?php

namespace App\Http\Livewire\Reports\Create;

use App\Models\Location;
use App\Models\Report;
use Auth;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LivewireUI\Modal\ModalComponent;

/**
 * @property Forms\ComponentContainer $form
 */
class CreateFormModal extends ModalComponent implements HasForms
{
    use AuthorizesRequests;
    use InteractsWithForms;

    public Location $location;

    public string $title = '';
    public string $visited_at = '';
    public string $visit_duration = '';
    public string $description = '';
    public array $pictures = [];

    public function mount($location_id)
    {
        $this->location = Location::query()->findOrFail($location_id);

        $this->authorize('create', Report::class);
    }

    public function render()
    {
        return view('livewire.reports.create.create-form-modal');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Fieldset::make('General Information')
                ->columns(1)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->label('What should the title of this report be?')
                        ->maxLength(255),
                    Forms\Components\Grid::make()
                        ->schema([
                            Forms\Components\DateTimePicker::make('visited_at')
                                ->required()
                                ->label('When did you visit?')
                                ->maxDate(now()->addDay())
                                ->default(now())
                                ->withoutSeconds(),
                            Forms\Components\TextInput::make('visit_duration')
                                ->required()
                                ->numeric()
                                ->label('What was the duration of your visit?')
                                ->minValue(1)
                                ->postfix('hours')
                        ]),
                ]),

            Forms\Components\Fieldset::make('Report')
                ->columns(1)
                ->schema([
                    Forms\Components\MarkdownEditor::make('description')
                        ->required()
                        ->label('Content')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                        ]),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('pictures')
                        ->required()
                        ->multiple()
                        ->enableReordering()
                        ->disk('media')
                        ->image(),
                ]),
        ];
    }

    public function submit(): void
    {
        $validatedData = $this->form->getState();

        $report = Report::query()->create([
            'location_id' => $this->location->id,
            'user_id' => Auth::id(),
            'title' => $validatedData['title'],
            'visited_at' => $validatedData['visited_at'],
            'visit_duration' => $validatedData['visit_duration'],
            'description' => $validatedData['description'],
        ]);

        $this->form->model($report)->saveRelationships();
    }

    protected function getFormModel(): string
    {
        return Report::class;
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
