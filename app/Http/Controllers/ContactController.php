<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\ContactMessage;


class ContactController extends Controller
{
    /**
     * Show the contact page
     */
    public function index(): View
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission
     */
    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Aquí iría la lógica para enviar un correo o guardar en base de datos
        // Por ahora, simulamos el éxito y redirigimos de vuelta
        ContactMessage::create($validated);

        return redirect()->route('contact')
            ->with('success', '¡Gracias por contactarnos! Tu mensaje ha sido enviado correctamente.');
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex(): View
    {
        $messages = ContactMessage::latest()->get();

        return view('admin.contact.index', compact('messages'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Mensaje eliminado correctamente.');
    }
}
