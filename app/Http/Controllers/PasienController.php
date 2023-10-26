<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use function Pest\Laravel\get;

class PasienController extends Controller
{
    public function createPasien(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:pasiens|max:50',
            'phone_number' => 'required|string|max:13',
            'role_id' => 'required|integer',
            'password' => 'required|min:6',
            'age' => 'nullable|integer', 
            'height' => 'nullable|numeric', 
            'weight' => 'nullable|numeric', 
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $pasien = new Pasien([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'role_id' => $validated['role_id'],
            'password' => bcrypt($validated['password']),
            'age' => $validated['age'],
            'height' => $validated['height'],
            'weight' => $validated['weight'],
        ]);

        if ($request->hasFile('profile_picture')) {
            $fileName = time().$request->file('profile_picture')->getClientOriginalName();
            $path = $request->file('profile_picture')->storeAs('images', $fileName, 'public');
            $pasien->profile_picture = $path;
        }

        $pasien->save();

        return redirect()->route('login')->with('status', 'Pasien created successfully');
    }

    public function getPasienList(Request $request)
    {
        $pagination = 9;
        $query = Pasien::query();
    
        if ($request->has('query')) {
            $search_text = $request->input('query');
            $query->where(function ($q) use ($search_text) {
                $q->where('name', 'LIKE', "%$search_text%")
                    ->orWhere('email', 'LIKE', "%$search_text%")
                    ->orWhere('phone_number', 'LIKE', "%$search_text%")
                    ->orWhere('age', 'LIKE', "%$search_text%")
                    ->orWhere('height', 'LIKE', "%$search_text%")
                    ->orWhere('weight', 'LIKE', "%$search_text%");
            });
        }
    
        if ($request->has('sort_by')) {
            $sort_by = $request->input('sort_by');
            if ($sort_by === 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($sort_by === 'name_desc') {
                $query->orderBy('name', 'desc');
            } elseif ($sort_by === 'age_asc') {
                $query->orderBy('age', 'asc');
            } elseif ($sort_by === 'age_desc') {
                $query->orderBy('age', 'desc');
            } elseif ($sort_by === 'height_asc') {
                $query->orderBy('height', 'asc');
            } elseif ($sort_by === 'height_desc') {
                $query->orderBy('height', 'desc');
            } elseif ($sort_by === 'weight_asc') {
                $query->orderBy('weight', 'asc');
            } elseif ($sort_by === 'weight_desc') {
                $query->orderBy('weight', 'desc');
            }
        } else {
            $query->orderBy('name', 'asc');
        }
    
        $pasiens = $query->paginate($pagination);
    
        return view('admin.pasiens', [
            'title' => 'Pasiens',
            'pasiens' => $pasiens,
            'query' => $request->input('query'),
            'sort_by' => $request->input('sort_by'),
        ]);
    }
    

    public function editPasien($id)
    {
        $pasien = Pasien::find($id);
    
        if (!$pasien) {
            return redirect()->route('pasien.list')->with('error', 'Pasien not found');
        }
    
        return view('admin.editPasien', [
            'title' => 'Edit Pasien',
            'pasien' => $pasien,
        ]);
    }

    public function updatePasien(Request $request, $id)
    {
        $pasien = Pasien::find($id);
    
        if (!$pasien) {
            return redirect()->route('pasien.list')->with('error', 'Pasien not found');
        }
    
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:pasiens,email,' . $pasien->id,
            'phone_number' => 'required|string|max:18',
            'role_id' => 'required|integer',
            'age' => 'nullable|integer',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
        ]);
        
        $pasien->name = $validated['name'];
        $pasien->email = $validated['email'];
        $pasien->phone_number = $validated['phone_number'];
        $pasien->role_id = $validated['role_id'];
        $pasien->age = $validated['age'];
        $pasien->height = $validated['height'];
        $pasien->weight = $validated['weight'];
    
        $pasien->save();
    
        return back()->with('status', 'Pasien updated successfully');
    }
    
    public function photoUpload(Request $request, $id)
    {
        $pasien = Pasien::find($id);
    
        if (!$pasien) {
            return redirect()->route('pasien.list')->with('error', 'Pasien not found');
        }

        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $picturePath = $request->file('profile_picture')->store('public/pictures');
            $pasien->profile_picture = str_replace('public/', '', $picturePath);
        }

        if ($request->type === 'delete') {
            $pasien->profile_picture = null;
        }

        $pasien->save();

        return back()->with('status', "Pasien's profile picture updated successfully");
    }

    public function deletePasien($id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return redirect()->route('pasiens.list')->with('error', 'Pasien not found');
        }
        $pasien->delete();

        return redirect()->route('pasiens.list')->with('status', 'Pasien deleted successfully');
    }
}
