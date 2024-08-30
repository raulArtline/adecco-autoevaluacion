<?php

namespace App\Livewire;

use App\Models\Survey;
use Livewire\Component;

class AutoevalComponent extends Component
{

    public Survey $survey;
    public $data = [];

    public function mount($id)
    {
        // recuperar la encuesta y obtener tambien los datos de la tabla asociada question
        $this->survey = Survey::where('uuid', $id)->with('question')->first();
    }

    public function render()
    {
        return view('livewire.autoeval-component');
    }
}
