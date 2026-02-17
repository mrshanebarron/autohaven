<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::with('vehicle')->latest()->paginate(20);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $inquiry->update($request->validate([
            'status' => 'required|in:new,contacted,closed',
        ]));

        return back()->with('success', 'Inquiry status updated.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return back()->with('success', 'Inquiry deleted.');
    }
}
