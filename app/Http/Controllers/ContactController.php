<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('book.index', compact('contacts'));
    }

    public function create()
    {
        return view('book.create');
    }

    public function add_contact(Request $request)
    {
        $this->validate($request, [
            'nama'   => 'required',
            'no_hp'  => 'required'
        ]);

        Contact::create([
            'nama'  => $request->nama,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('contact')->with(['success' => 'Data Berhasil Ditambahkan']);

    }

    public function remove_contact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contact')->with(['success' => 'Data Berhasil dihapus']);

    }

    public function search_contact(Request $request)
    {
        $keyword = $request->search;
        $contacts = Contact::where('nama', 'like', "%". $keyword ."%")->get();

        return view('book.index', compact('contacts'));
    }
}
