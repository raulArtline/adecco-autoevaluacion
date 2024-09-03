<?php

namespace App\Livewire;

use App\Models\Survey;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AutoevalComponent extends Component
{

    public Survey $survey;

    #[Validate('required')]
    public $data = [];

    public function mount($id)
    {
        // recuperar la encuesta y obtener tambien los datos de la tabla asociada question
        $this->survey = Survey::where('uuid', $id)->with('question')->first();
    }

    public function saveResults()
    {
        // dd($this->data);
        $this->validate();
        // guardar los datos en la tabla de la encuesta en el campo resultados
        $this->survey->update(['results' => json_encode($this->data)]);

        // Evitar que el componente se re-renderice
        // $this->skipRender();

        // return json con susscess = true y un msg
        return response()->json(['success' => true, 'msg' => 'Encuesta guardada con exito']);
    }

    public function render()
    {
        return view('livewire.autoeval-component');
    }
}
