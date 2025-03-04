<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Joobs;
use App\Models\Departement;

class JoobsComponent extends Component
{
    use WithPagination;

    public $title, $description, $department_id, $joob_id;
    public $isEdit = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'department_id' => 'required|exists:departements,id'
    ];

    public function render()
    {
        // Récupérer les jobs avec pagination
        $joobs = Joobs::with('department')->paginate(10);

        // Passer la variable $joobs à la vue
        return view('livewire.job-manager', [
            'joobs' => $joobs,
        ]);
    }

    public function create()
    {
        $this->resetFields();
        $this->isEdit = false;
    }

    public function edit($id)
    {
        $joob = Joobs::findOrFail($id);
        $this->joob_id = $joob->id;
        $this->title = $joob->title;
        $this->description = $joob->description;
        $this->department_id = $joob->department_id;
        $this->isEdit = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEdit) {
            Joobs::find($this->joob_id)->update([
                'title' => $this->title,
                'description' => $this->description,
                'department_id' => $this->department_id
            ]);
            session()->flash('message', 'Joob mis à jour avec succès.');
        } else {
            Joobs::create([
                'title' => $this->title,
                'description' => $this->description,
                'department_id' => $this->department_id
            ]);
            session()->flash('message', 'Joob créé avec succès.');
        }

        $this->resetFields();
    }

    public function delete($id)
    {
        Joobs::findOrFail($id)->delete();
        session()->flash('message', 'Joob supprimé avec succès.');
    }

    private function resetFields()
    {
        $this->title = '';
        $this->description = '';
        $this->department_id = '';
        $this->joob_id = null;
        $this->isEdit = false;
    }
}
