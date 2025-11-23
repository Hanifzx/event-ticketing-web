<?php

namespace App\Livewire\Public\Events;

use Livewire\Component;
use App\Services\Event\CatalogService;

class Catalog extends Component
{
    // State Filter
    public $search = '';
    public $category = '';
    public $location = '';
    public $month = '';

    // Update URL browser
    protected $queryString = [
        'search'   => ['except' => ''],
        'category' => ['except' => ''],
        'location' => ['except' => ''],
        'month'    => ['except' => ''],
    ];

    public function render(CatalogService $service)
    {
        $filters = [
            'search'   => $this->search,
            'category' => $this->category,
            'location' => $this->location,
            'month'    => $this->month,
        ];

        return view('livewire.public.events.catalog', [
            'events'     => $service->getFilteredEvents($filters),
            'locations'  => $service->getUniqueLocations(),
            'categories' => $service->getCategories(),
            'months'     => [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ]
        ]);
    }
}