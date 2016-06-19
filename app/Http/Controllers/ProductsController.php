<?php

namespace CodeDelivery\Http\Controllers;


use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCategoriesRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Http\Requests\AdminProductsRequest;

class ProductsController extends Controller
{

    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {

        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    
    public function index()
    {
        $products = $this->productRepository->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->getlists();
        return view('admin.products.create', compact('categories'));
    }

    public function store(AdminProductsRequest $request)
    {
        $products = $request->all();
        $this->productRepository->create($products);
        
        return redirect()->route('admin.products.index');
    }


    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        $categories = $this->categoryRepository->getlists();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(AdminProductsRequest $request, $id)
    {
        $product = $request->all();
        $this->productRepository->update($product, $id);

        return redirect()->route('admin.products.index');
    }


    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return redirect()->route('admin.products.index');
    }
}
