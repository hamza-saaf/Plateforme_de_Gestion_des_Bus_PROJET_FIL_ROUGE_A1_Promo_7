<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TrajetRepositoryInterface;

class TrajetController extends Controller
{
    protected $trajetRepo;

    public function __construct(TrajetRepositoryInterface $trajetRepo)
    {
        $this->trajetRepo = $trajetRepo;
    }

    public function index()
    {
        $trajets = $this->trajetRepo->all();
        return view('trajets.index', compact('trajets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'depart' => 'required|string|max:100',
            'destination' => 'required|string|max:100',
            'date' => 'required|date|after_or_equal:today',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:1',
        ]);

        $this->trajetRepo->store($data);
        return redirect()->back()->with('success', 'Trajet ajouté avec succès!');
    }


    public function search(Request $request)
    {
        $data = $request->validate([
            'depart' => 'required|string',
            'destination' => 'required|string',
            'date' => 'required|date',
        ]);
    
        $trajets = $this->trajetRepo->search($data);
    
        if ($request->ajax()) {
            return response()->json([
                'html' => view('trajet_results', compact('trajets'))->render()
            ]);
            
        }
        return view('home', compact('trajets'));
    }
    
}
