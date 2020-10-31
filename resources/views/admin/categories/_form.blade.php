<div class="card-body">
    <div class="form-group row validated">
        @include('components.form.input', ['scope' => 'admin.categories', 'name' => 'name'])
        @include('components.form.input', ['scope' => 'admin.categories', 'name' => 'slug'])
    </div>
</div>