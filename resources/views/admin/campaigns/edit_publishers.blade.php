@extends('layouts.app')

@section('content')
<div class="card card-custom gutter-b">
    <div class="card-header">
        <h3 class="card-title">@lang('admin.campaigns.edit')</h3>
    </div>
    @php
        $publisherList=[];
        $updatePublisherArr = [];
        foreach($campaign->contents AS $content) {
            foreach($content->publishersInstance AS $publisher) {
                if(($publisher->status === 'new' && !in_array($publisher->id, $publisherList))) {
                    $updatePublisherArr[] = $publisher;
                }
                $publisherList[] = $publisher->id;
            }
        }
    @endphp

    <!--begin::Form-->
    <div class="card-body">
        @include('admin.campaigns.editTab', ['active' => 'publishers'])
        <div class="tab-content mt-5" id="myTabContent">
            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                {!! Form::open(['route' => ['admin.campaigns.updateNewPublishers', $campaign], 'method' => 'put',
                'class' =>
                'form']) !!}
                @if(count($updatePublisherArr))
                @foreach ($updatePublisherArr as $index => $updatePublisher)
                <div
                    class="form-group m-form__group {{ $updatePublisher->name === '' ? ' border-warning bg-light-warning' : '' }}">
                    <div class="row p-2">
                        <input type="hidden" name="publishers[{{$index}}][id]" value="{{$updatePublisher->id}}" />
                        @include('components.form.input', ['scope' => 'admin.publishers', 'name' =>
                        "publishers[$index][name]",
                        'value' =>
                        $updatePublisher->name, 'label' => 'admin.publishers.name', 'placeholder' =>
                        'admin.publishers.enterName'])
                        @include('components.form.inputIcon', ['scope' => 'admin.publishers', 'name' =>
                        "publishers[$index][link]",
                        'icon'
                        => 'la la-url', 'value' => $updatePublisher->link, 'label' => 'admin.publishers.link',
                        'placeholder' => 'admin.publishers.enterLink'])
                        @include('components.form.radioGroup', ['scope' => 'admin.publishers', 'name' =>
                        "publishers[$index][platform]", 'staticOptions' =>
                        ['telegram' => __('admin.publishers.platforms.telegram'), 'instagram' =>
                        __('admin.publishers.platforms.instagram')], 'value' => $updatePublisher->platform, 'label' =>
                        'admin.publishers.platform', 'placeholder' => 'admin.publishers.choosePlatform'])
                        @include('components.form.radioGroup', [
                        'scope' => 'admin.publishers',
                        'name' => "publishers[$index][status]",
                        'staticOptions' => [
                        'new' => __('admin.publishers.statuses.new'),
                        'active' => __('admin.publishers.statuses.active'),
                        'inactive' => __('admin.publishers.statuses.inactive')
                        ],
                        'value' => $updatePublisher->status,
                        'label' => 'admin.publishers.status',
                        'placeholder' => 'admin.publishers.chooseStatus'
                        ])
                    </div>
                </div>
                @endforeach
                @endif
                <div class="form-group m-form__group">
                    <div class="col-lg-6">
                        <button type="submit"
                            class="btn btn-primary mr-2">@lang('admin.campaigns.savePublishers')</button>
                        <button type="reset" class="btn btn-secondary">@lang('admin.global.cancel')</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
    <!--end::Form-->
</div>
@endsection

@section('scripts')
@parent
<script type="text/javascript" src="{{asset('assets/plugins/custom/datepicker/persian-date.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/custom/datepicker/persian-datepicker.min.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
    var rowCount = parseInt("{{count($campaign->contents)}}");

    function changeName(element, number, rowNum) {
        element.find('input').each(function(i) {
            $(this).attr('name', 'content[' + number + '][' + rowNum + '][' + $(this).attr('name') + ']');
            $(this).val(null);
        });
        element.find('select').each(function(i) {
            if ($(this).attr('name') === 'publishers[]') {
                $(this).attr('name', 'content[' + number + '][' + rowNum + '][publishers][]');
            } else {
                $(this).attr('name', 'content[' + number + '][' + rowNum + '][' + $(this).attr('name') + ']');
            }
        });
        return element;
    }

    function addARow() {
        // row ra ke az file mediaRow dar paein body darim clone mikonim
        var cloned = $('#media-row').clone();
        // name tamame input ha ro dorost mikonim
        cloned = changeName(cloned, rowCount, 0);

        //newclass ro be onvane kelas ezafe mikonim, nazesh darim vas selectpicker miaim shomare row asli va tedad farzandasham meghdar dehi mikonim
        cloned = cloned.addClass('newClass').attr('data-number', rowCount++).attr('child-node-count', 0).attr('id', '');
        // append mikonim akhare tabe row clone shodamono
        $('.table tbody').append(cloned);

        // tedad kole row haro hesab mikonim, lazemesh darim baraye initialize kardane selectpicker
        var countOfRow = $('.table tbody').children('tr').length;
        $('.newClass .m_selectpickermedia-row').addClass('amirali' + countOfRow);
        // select picker lamasab ro initialize mikonim
        $(".amirali" + countOfRow).not('.enableSelectClass').selectpicker();
        //not('.enableSelectClass')
        // be newclass dige ehtiaj nadarim, hazfesh mikonim
        $('.newClass').removeClass('newClass');
        $("input[name='content\[" + (rowCount - 1) + "\]\[0\]\[contentType\]']").val('normal');
    }

    function addARowSamePublisher(thisObj) {
        // clone mikonim hamon row ro
        var cloned = $('#media-row-type-1').clone();

        // data-numbere tr asli ro mikhonim ke mige changomin row mamolie
        rowNumber = parseInt($(thisObj).parents('tr').attr('data-number') || 0);
        // data-numbere tr asli ro mikhonim ke mige in row asli chanta bache dare
        elementCount = parseInt($(thisObj).parents('tr').attr('child-node-count') || 1);
        // tedad child ro yeki ezafe mikonim
        $(thisObj).parents('tr').attr('child-node-count', elementCount + 1);
        // input name ha ro eslah mikonim
        cloned = changeName(cloned, rowNumber, elementCount + 1);
        $("input[name='content\[" + rowNumber + "\]\[0\]\[contentType\]']").val('type1');
        // class newClass ro ezafe mikonim vas dastane selectpicker
        cloned = cloned.addClass('newClass').attr('id', '');
        // bad az akharin child ezafe mikonim in row ro
        var lastRow = $(thisObj).closest('tr');
        for (i = 1; i <= elementCount; i++) {
            lastRow = lastRow.next('tr');
        }
        lastRow.after(cloned);

        //mirim avalin tr in row asli
        var prev = $('.newClass').prev("tr")
        while (prev.hasClass('row-type-1')) {
            prev = prev.prev("tr")
        }

        // yedone be rowspan avalid td va ye done ham be akharish ezafe mikonim
        var first = prev.find('td:first-child');
        first.attr('rowspan', (parseInt(first.attr('rowspan') || 1) + 1));

        var last = prev.find('td:last-child');
        last.attr('rowspan', (parseInt(last.attr('rowspan') || 1) + 1));


        var lastNth = prev.find('td:nth-last-child(3)');
        lastNth.attr('rowspan', (parseInt(lastNth.attr('rowspan') || 1) + 1));

        var lastNth = prev.find('td:nth-last-child(4)');
        lastNth.attr('rowspan', (parseInt(lastNth.attr('rowspan') || 1) + 1));

        var lastNth = prev.find('td:nth-last-child(5)');
        lastNth.attr('rowspan', (parseInt(lastNth.attr('rowspan') || 1) + 1));

        // newClass ro baz haz mikonim
        $('.newClass').addClass('row-type-1').removeClass('newClass');
    }

    function addARowSamePublisherAndDocument(thisObj) {
        // media ro inja clone mikonim
        var cloned = $('#media-row').clone();

        // bad mirim shomare ro asli va tedade farzandasho peyda mikonim bad update mikonim
        rowNumber = parseInt($(thisObj).parents('tr').attr('data-number') || 0);
        elementCount = parseInt($(thisObj).parents('tr').attr('child-node-count') || 1);
        $(thisObj).parents('tr').attr('child-node-count', elementCount + 1);
        // name ha ro update mikonim
        cloned = changeName(cloned, rowNumber, elementCount + 1);
        $("input[name='content\[" + rowNumber + "\]\[0\]\[contentType\]']").val('type2');
        // newClass ro ezafe mikonim
        cloned = cloned.addClass('newClass').attr('id', '');

        //akhare row asli ro peyda mikonim va appendesh mikonim
        var lastRow = $(thisObj).closest('tr');
        for (i = 1; i <= elementCount; i++) {
            lastRow = lastRow.next('tr');
        }
        lastRow.after(cloned);

        // avalo akhare row ro mizanim
        $('.newClass td:first-child').remove();
        $('.newClass td:last-child').remove();
        $('.newClass td:last-child').remove();
        $('.newClass td:nth-last-child(1)').remove();
        $('.newClass td:nth-last-child(1)').remove();
        $('.newClass td:nth-last-child(1)').remove();
        var prev = $('.newClass').prev("tr");
        while (prev.hasClass('row-type-2')) {
            prev = prev.prev("tr")
        }

        // tr aval miaim td avali va 2taye akhare rowspanesho dorost mikonim ke jaye on pak shodeha ro por kone
        var first = prev.find('td:first-child');
        first.attr('rowspan', (parseInt(first.attr('rowspan') || 1) + 1));

        var beforeLast = prev.find('td:nth-last-child(2)');
        beforeLast.attr('rowspan', (parseInt(beforeLast.attr('rowspan') || 1) + 1));

        var last = prev.find('td:last-child');
        last.attr('rowspan', (parseInt(last.attr('rowspan') || 1) + 1));

        var lastNth = prev.find('td:nth-last-child(3)');
        lastNth.attr('rowspan', (parseInt(lastNth.attr('rowspan') || 1) + 1));

        lastNth = prev.find('td:nth-last-child(4)');
        lastNth.attr('rowspan', (parseInt(lastNth.attr('rowspan') || 1) + 1));

        lastNth = prev.find('td:nth-last-child(5)');
        lastNth.attr('rowspan', (parseInt(lastNth.attr('rowspan') || 1) + 1));

        // newClasso dige lazem nadarim pakesh mikonim
        $('.newClass').addClass('row-type-2').removeClass('newClass');
    }

    function removeRow(thisObj) {
        elementCount = parseInt($(thisObj).parents('tr').attr('child-node-count') || 1);
        var firstRow = $(thisObj).closest('tr');
        var lastRow = $(thisObj).closest('tr');
        for (i = 1; i <= elementCount; i++) {
            lastRow = lastRow.next('tr');
        }
        if (lastRow.hasClass('row-type-1')) {
            firstRow.find('td:first-child').attr('rowspan', elementCount);
            firstRow.find('td:last-child').attr('rowspan', elementCount);
            firstRow.find('td:nth-last-child(3)').attr('rowspan', elementCount);
            firstRow.find('td:nth-last-child(4)').attr('rowspan', elementCount);
            firstRow.find('td:nth-last-child(5)').attr('rowspan', elementCount);
            $(thisObj).parents('tr').attr('child-node-count', elementCount - 1);
            lastRow.remove();
        } else {
            $(firstRow).remove();
        }
    }

    function removeRowType2(thisObj) {
        elementCount = parseInt($(thisObj).parents('tr').attr('child-node-count') || 1);
        var firstRow = $(thisObj).closest('tr');
        var lastRow = $(thisObj).closest('tr');
        for (i = 1; i <= elementCount; i++) {
            lastRow = lastRow.next('tr');
        }
        if (lastRow.hasClass('row-type-2')) {
            firstRow.find('td:first-child').attr('rowspan', elementCount);
            firstRow.find('td:last-child').attr('rowspan', elementCount);
            firstRow.find('td:nth-last-child(2)').attr('rowspan', elementCount);
            firstRow.find('td:nth-last-child(3)').attr('rowspan', elementCount);
            firstRow.find('td:nth-last-child(4)').attr('rowspan', elementCount);
            firstRow.find('td:nth-last-child(5)').attr('rowspan', elementCount);
            $(thisObj).parents('tr').attr('child-node-count', elementCount - 1);
            lastRow.remove();
        } else {
            $(firstRow).remove();
        }
    }

    $(document).ready(function() {
        $('.enableSelectClass').selectpicker();
    })
</script>
@endsection
