<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Donut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DonutController extends Controller
{
    public function index()
    {
        $donuts = Donut::with('category')
            ->latest()
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.donut', compact('donuts', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255', 'unique:donuts,name'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('donuts', 'public');
        }

        Donut::create($validated);

        return redirect()
            ->route('admin.donut.index')
            ->with('success', 'Donat berhasil ditambahkan.');
    }

    public function update(Request $request, Donut $donut)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255', 'unique:donuts,name,' . $donut->id],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($donut->image) {
                Storage::disk('public')->delete($donut->image);
            }

            $validated['image'] = $request->file('image')->store('donuts', 'public');
        }

        $donut->update($validated);

        return redirect()
            ->route('admin.donut.index')
            ->with('success', 'Donat berhasil diperbarui.');
    }

    public function destroy(Donut $donut)
    {
        if ($donut->image) {
            Storage::disk('public')->delete($donut->image);
        }

        $donut->delete();

        return redirect()
            ->route('admin.donut.index')
            ->with('success', 'Donat berhasil dihapus.');
    }
}
