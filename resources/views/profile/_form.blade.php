<div class="card-body">
    <div class="form-group row validated">
        @include('components.form.input', ['scope' => 'auth.profile', 'name' => 'first_name'])
        @include('components.form.input', ['scope' => 'auth.profile', 'name' => 'last_name'])
    </div>
    <div class="form-group row validated">
        @include('components.form.inputIcon', ['scope' => 'auth.profile', 'name' => 'email', 'type' => 'email', 'icon' => 'fa flaticon-email'])
        @include('components.form.inputIcon', ['scope' => 'auth.profile', 'name' => 'mobile', 'icon' => 'la la-phone'])
    </div>
    <div class="form-group row validated">
        @include('components.form.inputIcon', ['scope' => 'auth.profile', 'name' => 'brand', 'icon' => 'fa flaticon-customer'])
        @include('components.form.inputIcon', ['scope' => 'auth.profile', 'name' => 'password', 'type' => 'password', 'icon' => 'la la-lock'])
    </div>
</div>