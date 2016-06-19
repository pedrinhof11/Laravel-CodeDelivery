<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use CodeDelivery\Http\Requests\AdminCategoriesRequest;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CategoriesController extends Controller
{

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {

        $this->categoryRepository = $categoryRepository;
    }
    
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(AdminCategoriesRequest $request)
    {
        $categoria = $request->all();
        $this->categoryRepository->create($categoria);
        
        return redirect()->route('admin.categories.index');
    }


    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        
        return view('admin.categories.edit', compact('category'));
    }

    public function update(AdminCategoriesRequest $request, $id)
    {
        $categoria = $request->all();
        $this->categoryRepository->update($categoria, $id);

        return redirect()->route('admin.categories.index');
    }
    
}
