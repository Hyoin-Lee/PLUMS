<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCertificateRequest;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view certificates')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view certificates.');
        }

        // $certificates = Certificate::query()->paginate(10);
        $search = $request->input('query');
        $certificates = Certificate::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('cert_name', 'like', "%{$search}%");
            })
            ->paginate(10);
        return view('certificates.index', compact('certificates'));
    }

    public function create() {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create certificates')) {
            return redirect()->route('certificates.index')->with('error', 'You do not have permission to create certificates.');
        }

        return view('certificates.create');
    }

    public function store(StoreCertificateRequest $request)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create certificates')) {
            return redirect()->route('certificates.index')->with('error', 'You do not have permission to create certificates.');
        }

        $validated = $request->validated();
        Certificate::create($validated);
        return redirect(route('certificates.index'));
    }

    public function edit(Certificate $certificate) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit certificates')) {
            return redirect()->route('certificates.index')->with('error', 'You do not have permission to edit certificates.');
        }

        return view('certificates.edit', compact('certificate'));
    }
    public function update(Request $request, Certificate $certificate)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit certificates')) {
            return redirect()->route('certificates.index')->with('error', 'You do not have permission to edit certificates.');
        }

        $validated = $request->validated();
        $certificate->update($validated);
        return redirect(route('certificates.index'));
    }

    public function delete(Certificate $certificate) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('delete certificates')) {
            return redirect()->route('certificates.index')->with('error', 'You do not have permission to delete certificates.');
        }

        return view('certificates.delete', compact('certificate'));
    }

    public function destroy(Request $request, Certificate $certificate)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('delete certificates')) {
            return redirect()->route('certificates.index')->with('error', 'You do not have permission to delete certificates.');
        }

        $certificate->delete();
        return redirect(route('certificates.index'))->with('success', 'Certificate deleted successfully.');
    }
}
