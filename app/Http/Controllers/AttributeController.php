<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttributeRequest;
use App\Models\Attribute;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\AttributeService;
use Illuminate\Http\Response;

class AttributeController extends Controller
{
    public function __construct(
        private AttributeService $attributeService,
    )
    {

    }

    public function index(): View
    {
        return view('attributes.index', [
            'attributes' => Attribute::paginate(15)
        ]);
    }


    public function create(): View
    {
        return view('attributes.form');
    }

    public function store(StoreAttributeRequest $request): RedirectResponse
    {
        $attributeData = $request->validated();
        if (!$this->attributeService->store($attributeData))
        {
            throw new \Exception("Can't store new attribute", 502);
        }
        return redirect('/admin/attribute');
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

    public function edit(Attribute $attribute): View
    {
        return view("attributes.form", [
            'attribute' => $attribute,
        ]);
    }

    /**
     * @throws \Exception
     */
    public function update(Attribute $attribute, StoreAttributeRequest $request): RedirectResponse
    {
        if (!$this->attributeService->update($attribute, $request->validated())) {
            throw new \Exception("Can't store new product", 502);
        }

        return redirect('/admin/attribute');
    }

    public function destroy(Attribute $attribute): RedirectResponse
    {
        if (!$this->attributeService->destroy($attribute)) {
            return back()->withErrors("DestroyError");
        }

        return redirect("/admin/attribute");
    }
}
