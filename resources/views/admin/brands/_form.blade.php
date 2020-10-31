<div class="card-body">
    <div class="form-group row validated">
        @include('components.form.input', ['scope' => 'admin.brands', 'name' => 'name'])
        @include('components.form.select', ['scope' => 'admin.brands', 'name' => 'category_id', 'staticOptions' =>
        $categories, 'extra' => ['data-live-search'=>"true", "data-actions-box"=>"true"]])
    </div>
    
</div>