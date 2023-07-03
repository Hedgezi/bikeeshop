@extends("layouts.app")

@section("content")
    <form name="createProduct" method="POST" enctype="multipart/form-data" @isset($product) action="/admin/product/{{ $product->id }}" @else action="/admin/product" @endisset>
        @csrf
            <div class="row m-3 col" id="images">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($product)
                            @foreach($product->images as $image)
                                <tr id="image{{ $image->id }}">
                                    <td>
                                        <img src="{{ asset(Storage::url($image['path'])) }}" alt="{{ Storage::url($image['path']) }}" width="100px">
                                        <input type="hidden" name="image_id[]" value="{{ $image->id }}">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" id="imageDelete{{ $loop->index }}">-</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
            <div class="row m-3 col" id="image">
                <input type="file" name="image[]" class="row m-1" multiple>
            </div>
            <div class="row form-floating m-3">
                <input class="col-9 form-control" type="text" id="floatingName" placeholder="Name" name="name" @isset($product) value="{{ $product->name }}" @endisset required>
                <label for="floatingName">Name</label>
            </div>
            <div class="row form-floating m-3">
                <input class="col form-control" type="text" id="floatingDescription" placeholder="Description" name="description" @isset($product) value="{{ $product->description }}" @endisset required>
                <label for="floatingDescription">Description</label>
            </div>
            <div class="row">
                <select class="form-select col m-3" name="brand_id">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @isset($product) @if($product->brand_id == $brand->id)
                            selected
                            @endif @endisset>{{ $brand->name }}</option>
                    @endforeach
                </select>
                <select class="form-select col m-3" name="country_id">
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" @isset($product) @if($product->country_id == $country->id)
                            selected
                            @endif @endisset>{{ $country->name }}</option>
                    @endforeach
                </select>
                <select class="form-select col m-3" name="type_id">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" @isset($product) @if($product->type_id == $type->id)
                            selected
                        @endif @endisset>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">
                            Variants
                        </th>
                        <th scope="col" class="row">
                            <select class="form-select m-1 w-25 col" id="attributeAddSelect">
                                <option value="0" selected>--</option>
                                @isset($product)
                                    @foreach($product->variants()->get() as $variant)
                                        <option value="{{ $loop->iteration }}">{{ $loop->iteration  }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            <button id="attributeAddButton" class="btn btn-dark col m-2">Add</button>
                        </th>
                        <th scope="col">
                            <button id="addVariant" class="btn btn-dark">+</button>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Attributes</th>
                        <th scope="col">Values</th>
                    </tr>
                </thead>
                <tbody id="variantsTable">
                    @isset($product)
                        @foreach($product->variants()->get() as $variant)
                            <tr>
                                <input type="hidden" name="variants[{{ $loop->index }}][id]" value="{{ $variant->id }}">
                                <td>
                                    <div class="form-floating row m-2">
                                        <input class="form-control" type="text" id="price{{ $loop->index }}" placeholder="Price" name="variants[{{ $loop->index }}][price]" value="{{ $variant->price }}">
                                        <label for="price{{ $loop->index }}">Price</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-floating row m-2">
                                        <input class="form-control" type="text" id="quantity{{ $loop->index }}" placeholder="Quantity" name="variants[{{ $loop->index }}][quantity]" value="{{ $variant->quantity }}">
                                        <label for="quantity{{ $loop->index }}">Quantity</label>
                                    </div>
                                </td>
                                <td id="attributesSelect{{ $loop->index }}">
                                    @foreach($variant->attributes as $presentAttribute)
                                        <select class="form-select row mt-2 mb-2" name="variants[{{ $loop->parent->index }}][attribute_id][{{ $loop->index }}]">
                                            @foreach($attributes as $attribute)
                                                <option value="{{ $attribute->id }}" @if($presentAttribute->id == $attribute->id) selected @endif>{{ $attribute->name }}</option>
                                            @endforeach
                                        </select>
                                    @endforeach
                                </td>
                                <td id="attributesValue{{ $loop->index }}" >
                                    @foreach($variant->attributes as $presentAttribute)
                                        <div class="form-floating row mt-2 h-50">
                                            <input class="form-control h-50" type="text" id="attributeValue{{ $loop->parent->index }}{{ $loop->index }}" placeholder="Value" name="variants[{{ $loop->parent->index }}][attribute_value][{{ $loop->index }}]" value="{{ \App\Models\Value::where('variant_id', $variant->id)->where('attribute_id', $presentAttribute->id)->get()[0]->value }}">
                                            <label for="attributeValue{{ $loop->parent->index }}{{ $loop->index }}">Value</label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input class="btn btn-primary p-2 m-2" type="submit" value="Update">
    </form>

    <script>
        let vTable = document.getElementById("variantsTable");
        let counterVariant = vTable.childElementCount;

        let imagesTag = document.getElementById("images");
        let counterImages = imagesTag.childElementCount;

        document.addEventListener("DOMContentLoaded", function() {
            let addButton = document.getElementById("addVariant");
            addButton.addEventListener("click", function(event) {
                event.preventDefault();
                addInput();
             });
        });

        document.addEventListener("DOMContentLoaded", function() {
            let attributeAddButton = document.getElementById("attributeAddButton");
            attributeAddButton.addEventListener("click", function(event) {
                event.preventDefault();
                addAttribute();
            });
        });

        @isset($product)
            @foreach($product->images as $image)
                document.addEventListener("DOMContentLoaded", function() {
                    let imageDeleteButton = document.getElementById("imageDelete{{ $loop->index }}");
                    imageDeleteButton.addEventListener("click", function(event) {
                        event.preventDefault();
                        deleteImage({{ $image->id }});
                    });
                });
            @endforeach
        @endisset

        function addInput() {
            let tableRow = document.createElement("tr");

            let priceColumn = document.createElement("td");
            let quantityColumn = document.createElement("td");
            let attributesSelectColumn = document.createElement("td");
            attributesSelectColumn.id = "attributesSelect"+counterVariant;
            let attributesValueColumn = document.createElement("td");
            attributesValueColumn.id = "attributesValue"+counterVariant;

            let priceDiv = document.createElement("div");
            priceDiv.className = "form-floating row m-2";
            let priceInput = document.createElement("input");
            priceInput.className = "form-control";
            priceInput.type = "text";
            priceInput.placeholder = "Price";
            priceInput.id = "price"+counterVariant;
            priceInput.name = `variants[${counterVariant}][price]`;
            let priceLabel = document.createElement("label");
            priceLabel.for = "price"+counterVariant;
            priceLabel.innerText = "Price";

            let quantityDiv = document.createElement("div");
            quantityDiv.className = "form-floating row m-2";
            let quantityInput = document.createElement("input");
            quantityInput.className = "form-control";
            quantityInput.type = "text";
            quantityInput.placeholder = "Quantity";
            quantityInput.id = "quantity"+counterVariant;
            quantityInput.name = `variants[${counterVariant}][quantity]`;
            let quantityLabel = document.createElement("label");
            quantityLabel.for = "quantity"+counterVariant;
            quantityLabel.innerText = "Quantity";

            let attributesSelect = document.createElement("select");
            attributesSelect.className = "form-select row mt-2 mb-2";
            attributesSelect.name = `variants[${counterVariant}][attribute_id][]`;
            @foreach($attributes as $attribute)
                let attribute{{ $loop->iteration }} = document.createElement("option");
                attribute{{ $loop->iteration }}.value = {{ $attribute->id }};
                attribute{{ $loop->iteration }}.innerText = "{{ $attribute->name }}";
                attributesSelect.appendChild(attribute{{ $loop->iteration }});
            @endforeach

            let attributeDiv = document.createElement("div");
            attributeDiv.className = "form-floating row mt-2 h-50";
            let attributeInput = document.createElement("input");
            attributeInput.className = "form-control h-50";
            attributeInput.type = "text";
            attributeInput.placeholder = "Value";
            attributeInput.id = "attributeValue"+counterVariant;
            attributeInput.name = `variants[${counterVariant}][attribute_value][]`;
            let attributeLabel = document.createElement("label");
            attributeLabel.for = "attributeValue"+counterVariant;
            attributeLabel.innerText = "Value";

            priceDiv.appendChild(priceInput);
            priceDiv.appendChild(priceLabel);
            priceColumn.appendChild(priceDiv);
            tableRow.appendChild(priceColumn);

            quantityDiv.appendChild(quantityInput);
            quantityDiv.appendChild(quantityLabel);
            quantityColumn.appendChild(quantityDiv);
            tableRow.appendChild(quantityColumn);

            attributesSelectColumn.appendChild(attributesSelect);
            tableRow.appendChild(attributesSelectColumn);

            attributeDiv.appendChild(attributeInput);
            attributeDiv.appendChild(attributeLabel);
            attributesValueColumn.appendChild(attributeDiv);
            tableRow.appendChild(attributesValueColumn);

            let container = document.getElementById("variantsTable");
            container.appendChild(tableRow);

            let attributeAddSelect = document.getElementById("attributeAddSelect");
            let newOption = document.createElement("option");
            newOption.value = counterVariant+1;
            newOption.innerText = counterVariant+1;
            attributeAddSelect.appendChild(newOption);

            counterVariant++;
        }
        function addAttribute() {
            let attributeAddSelect = document.getElementById("attributeAddSelect");
            let addTo = attributeAddSelect.value;
            if (addTo == 0) {
                return;
            }
            let attributesSelects = document.getElementById("attributesSelect"+(addTo-1));
            let attributesValues = document.getElementById("attributesValue"+(addTo-1));
            let numberOfAttributes = attributesSelects.childElementCount;

            let attributesSelect = document.createElement("select");
            attributesSelect.className = "form-select row mt-2 mb-2";
            attributesSelect.name = `variants[${addTo-1}][attribute_id][]`;
            @foreach($attributes as $attribute)
                let attribute{{ $loop->iteration }} = document.createElement("option");
                attribute{{ $loop->iteration }}.value = {{ $attribute->id }};
                attribute{{ $loop->iteration }}.innerText = "{{ $attribute->name }}";
                attributesSelect.appendChild(attribute{{ $loop->iteration }});
            @endforeach

            let attributeDiv = document.createElement("div");
            attributeDiv.className = "form-floating row mt-2 h-50";
            let attributeInput = document.createElement("input");
            attributeInput.className = "form-control h-50";
            attributeInput.type = "text";
            attributeInput.placeholder = "Value";
            attributeInput.id = ("attributeValue"+counterVariant)+numberOfAttributes;
            attributeInput.name = `variants[${addTo-1}][attribute_value][]`;
            let attributeLabel = document.createElement("label");
            attributeLabel.for = ("attributeValue"+counterVariant)+numberOfAttributes;
            attributeLabel.innerText = "Value";

            attributeDiv.appendChild(attributeInput);
            attributeDiv.appendChild(attributeLabel);
            attributesSelects.appendChild(attributesSelect);
            attributesValues.appendChild(attributeDiv);

        }
        function deleteImage(id) {
            let image = document.getElementById("image"+id);
            image.remove();
        }
    </script>
@endsection
