<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
       Gate::authorize('admin-access');
       $users = User::orderBy('id')->get();
       return view('admin.users.index',compact('users'));
    }

    public function indexPaginated()
    {
       Gate::authorize('admin-access');
       $users = User::orderBy('id')->paginate(5);
       return view('admin.users.index-paginated',compact('users'));
    }

    public function edit(User $user){
        Gate::authorize('admin-access');
        return view('admin.users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('admin-access');
        $validated=$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email',
            'datum_rod' => 'required|date',
            'placa' => 'required|numeric|min:0',
            'isAdmin' => 'required|boolean',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success','Korisnik uspješno ažuriran');
    }

    public function deletePreview(User $user)
    {
        Gate::authorize('admin-access');
            return view('admin.users.delete',
            compact('user')
        );
    }

    public function destroy(User $user)
    {
        Gate::authorize('admin-access');
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success','Korisnik uspješno izbrisan');
    }
}
