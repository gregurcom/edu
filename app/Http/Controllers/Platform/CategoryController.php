<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public function list(): View
    {
        $categories = Category::paginate(10, ['id', 'name']);

        return view('platform.categories', compact('categories'));
    }
}
