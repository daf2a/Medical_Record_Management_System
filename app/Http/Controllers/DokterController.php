<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use function Pest\Laravel\get;

class DokterController extends Controller
{
    public function createDokter(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:dokters|max:50',
            'phone_number' => 'required|string|max:13',
            'role_id' => 'required|integer',
            'password' => 'required|min:6',
            'age' => 'nullable|integer', 
            'height' => 'nullable|numeric', 
            'weight' => 'nullable|numeric', 
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $dokter = new Dokter([
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
            $dokter->profile_picture = $path;
        }

        $dokter->save();

        return redirect()->route('login')->with('status', 'Dokter created successfully');
    }

    public function getDokterList(Request $request)
    {
        $pagination = 9;
        $query = Dokter::query();
    
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
    
        $dokters = $query->paginate($pagination);
    
        return view('admin.dokters', [
            'title' => 'Dokters',
            'dokters' => $dokters,
            'query' => $request->input('query'),
            'sort_by' => $request->input('sort_by'),
        ]);
    }
    

    public function editDokter($id)
    {
        $dokter = Dokter::find($id);
    
        if (!$dokter) {
            return redirect()->route('dokter.list')->with('error', 'Dokter not found');
        }
    
        return view('admin.editDokter', [
            'title' => 'Edit Dokter',
            'dokter' => $dokter,
        ]);
    }

    public function updateDokter(Request $request, $id)
    {
        $dokter = Dokter::find($id);
    
        if (!$dokter) {
            return redirect()->route('dokter.list')->with('error', 'Dokter not found');
        }
    
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:dokters,email,' . $dokter->id,
            'phone_number' => 'required|string|max:18',
            'role_id' => 'required|integer',
            'age' => 'nullable|integer',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
        ]);
        
        $dokter->name = $validated['name'];
        $dokter->email = $validated['email'];
        $dokter->phone_number = $validated['phone_number'];
        $dokter->role_id = $validated['role_id'];
        $dokter->age = $validated['age'];
        $dokter->height = $validated['height'];
        $dokter->weight = $validated['weight'];
    
        $dokter->save();
    
        return back()->with('status', 'Dokter updated successfully');
    }
    
    public function photoUpload(Request $request, $id)
    {
        $dokter = Dokter::find($id);
    
        if (!$dokter) {
            return redirect()->route('dokter.list')->with('error', 'Dokter not found');
        }

        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $picturePath = $request->file('profile_picture')->store('public/pictures');
            $dokter->profile_picture = str_replace('public/', '', $picturePath);
        }

        if ($request->type === 'delete') {
            $dokter->profile_picture = null;
        }

        $dokter->save();

        return back()->with('status', "Dokter's profile picture updated successfully");
    }

    public function deleteDokter($id)
    {
        $dokter = Dokter::find($id);

        if (!$dokter) {
            return redirect()->route('dokters.list')->with('error', 'Dokter not found');
        }
        $dokter->delete();

        return redirect()->route('dokters.list')->with('status', 'Dokter deleted successfully');
    }
}
