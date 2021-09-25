<?php

declare(strict_types = 1);

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createForm(): View
    {
        $categories = Category::get();

        return view('system.category-creation', compact('categories'));
    }

    public function create(CategoryRequest $request): RedirectResponse
    {
        $slug = str_replace(' ', '', $request->category);
        Category::create([
            'name' => $request->category,
            'slug' => $slug,
        ]);

        return redirect()->route('dashboard')->with('status', 'You have successfully created a category');
    }
}
