<div class="card-body">
    <div class="form-group row validated">
        @include('components.form.input', ['scope' => 'admin.users', 'name' => 'first_name'])
        @include('components.form.input', ['scope' => 'admin.users', 'name' => 'last_name'])
    </div>
    <div class="form-group row validated">
        @include('components.form.inputIcon', ['scope' => 'admin.users', 'name' => 'email', 'type' => 'email', 'icon' => 'fa flaticon-email'])
        @include('components.form.inputIcon', ['scope' => 'admin.users', 'name' => 'mobile', 'icon' => 'la la-phone'])
    </div>
    <div class="form-group row validated">
        @include('components.form.inputIcon', ['scope' => 'admin.users', 'name' => 'brand', 'icon' => 'fa flaticon-customer'])
        @include('components.form.inputIcon', ['scope' => 'admin.users', 'name' => 'password', 'type' => 'password', 'icon' => 'la la-lock'])
    </div>
    <div class="form-group row validated">
        @include('components.form.radioGroup', ['scope' => 'admin.users', 'name' => 'role', 'options' => ['super_admin', 'admin', 'member']])
        @include('components.form.radioGroup', ['scope' => 'admin.users', 'name' => 'status', 'options' => ['active', 'inactive']])
    </div>
    <div class="form-group row validated">
        @include('components.form.radioGroup', ['scope' => 'admin.users', 'name' => 'user_type', 'options' => ['normal', 'hunter', 'executor','hunter_executor']])
    </div>
</div>
