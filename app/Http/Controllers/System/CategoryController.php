<?php

declare(strict_types = 1);

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function create(): View
    {
        $categories = Category::get();

        return view('system.category.create', compact('categories'));
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $slug = str_replace(' ', '-', $request->name);
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('dashboard')->with('status', __('app.alert.create-category'));
    }

    public function edit(Category $category): View
    {
        return view('system.category.edit', compact('category'));
    }

    public function update(Category $category, CategoryRequest $request): RedirectResponse
    {
        $slug = strtolower(str_replace(' ', '-', $request->name));
        $category->update(array_merge(['slug' => $slug], $request->validated()));

        return redirect()->route('dashboard')->with('status', __('app.alert.edit-category'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('dashboard')->with('status', __('app.alert.delete-category'));
    }
}
