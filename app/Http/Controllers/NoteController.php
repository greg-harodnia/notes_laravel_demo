<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NoteController extends Controller
{
    /**
     * Display a listing of the notes.
     */
    public function index(): View
    {
        $notes = Note::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new note.
     */
    public function create(): View
    {
        return view('notes.create');
    }

    /**
     * Store a newly created note in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'folder' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();

        Note::create($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Note created successfully.');
    }

    /**
     * Display the specified note.
     */
    public function show(Note $note): View
    {
        $this->authorize('view', $note);

        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified note.
     */
    public function edit(Note $note): View
    {
        $this->authorize('update', $note);

        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified note in storage.
     */
    public function update(Request $request, Note $note): RedirectResponse
    {
        $this->authorize('update', $note);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'folder' => 'nullable|string|max:255',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified note from storage.
     */
    public function destroy(Note $note): RedirectResponse
    {
        $this->authorize('delete', $note);

        $note->delete();

        return redirect()->route('notes.index')
            ->with('success', 'Note deleted successfully.');
    }
}

