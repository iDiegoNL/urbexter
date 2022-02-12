<?php

namespace App\Http\Livewire\Reports\Show;

use App\Models\Report;
use LivewireUI\Modal\ModalComponent;

class ShowReportModal extends ModalComponent
{
    public ?Report $report;

    public function mount(int|string $report_id): void
    {
        $this->report = Report::query()->findOrFail($report_id);
    }

    public function render()
    {
        return view('livewire.reports.show.report-modal');
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
