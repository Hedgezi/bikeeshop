<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductsListRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Country;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Http\Response;

class AdminProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
    )
    {

    }

    public function index(ProductsListRequest $request): View
    {
        return view('products.index', [
            'products' => Product::query()->paginate($request->getPerPage(), ['*'], 'page', $request->getPage())
        ]);
    }


    public function create(): View
    {
        return view('products.form', [
            'brands' => Brand::all(),
            'countries' => Country::all(),
            'types' => Type::all(),
            'attributes' => Attribute::all(),
        ]);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $productData = $request->validated();
        if (!$this->productService->store($productData))
        {
            throw new \Exception("Can't store new product", 502);
        }
        return redirect('/admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Product $product): View
    {
        return view("products.form", [
            'product' => $product,
            'brands' => Brand::all(),
            'countries' => Country::all(),
            'types' => Type::all(),
            'attributes' => Attribute::all(),
        ]);
    }

    /**
     * @throws \Exception
     */
    public function update(Product $product, StoreProductRequest $request): RedirectResponse
    {
        dd($request->validated());
        if (!$this->productService->update($product, $request->validated()))
        {
            throw new \Exception("Can't store new product", 502);
        }

        return redirect('/admin/product');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if (!$this->productService->destroy($product)) {
            return back()->withErrors("DestroyError");
        }

        return redirect("/admin/product");
    }

}
