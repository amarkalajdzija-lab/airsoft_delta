<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->get();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email'
        ]);

        Member::create([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('members.index')
                         ->with('success', 'Član je uspješno dodan.');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);

        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $id
        ]);

        $member->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('members.index')
                         ->with('success', 'Član je uspješno ažuriran.');
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();

        return redirect()->route('members.index')
                         ->with('success', 'Član je obrisan.');
    }
}