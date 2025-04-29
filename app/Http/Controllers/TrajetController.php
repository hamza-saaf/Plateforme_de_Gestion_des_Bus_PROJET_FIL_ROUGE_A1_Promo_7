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
        return view('Admin.gestion_des_trajets', compact('trajets'));
    }

    public function popular()
    {
        $popularRoutes = $this->trajetRepo->getPopularRoutes();
        return view('trajetsPopulaires', compact('popularRoutes'));
    }

    public function show($id)
    {
        $trajet = $this->trajetRepo->find($id);
        return view('voyageur.trip_details', compact('trajet'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'depart' => 'required|string|max:100',
                'destination' => 'required|string|max:100',
                'date' => 'required|date|after_or_equal:today',
                'price' => 'required|numeric|min:0',
                'available_seats' => 'required|integer|min:1',
            ]);

            $this->trajetRepo->store($data);

            if ($request->expectsJson()) {
                return response()->json(['success' => true]);
            }
            
            return redirect()->back()->with('success', 'Trajet ajouté avec succès!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $trajet = $this->trajetRepo->find($id);
        return response()->json($trajet);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'depart' => 'required|string|max:100',
                'destination' => 'required|string|max:100',
                'date' => 'required|date|after_or_equal:today',
                'price' => 'required|numeric|min:0',
                'available_seats' => 'required|integer|min:1',
            ]);

            $this->trajetRepo->update($id, $data);

            if ($request->expectsJson()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'Trajet modifié avec succès!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->trajetRepo->destroy($id);
            return redirect()->back()->with('success', 'Trajet supprimé avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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

    public function book($id)
    {
        $trajet = $this->trajetRepo->find($id);
        return view('trajets.booking', compact('trajet'));
    }
}
