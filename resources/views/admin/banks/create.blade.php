@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bank.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.banks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="property_id">{{ trans('cruds.bank.fields.property') }}</label>
                <select class="form-control select2 {{ $errors->has('property') ? 'is-invalid' : '' }}" name="property_id" id="property_id" required>
                    @foreach($properties as $id => $property)
                        <option value="{{ $id }}" {{ old('property_id') == $id ? 'selected' : '' }}>{{ $property }}</option>
                    @endforeach
                </select>
                @if($errors->has('property'))
                    <div class="invalid-feedback">
                        {{ $errors->first('property') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.property_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="number">{{ trans('cruds.bank.fields.number') }}</label>
                <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="number" name="number" id="number" value="{{ old('number', '') }}" step="1" required>
                @if($errors->has('number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.bank.fields.name') }}</label>
                <select class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" required>
                    <option value disabled {{ old('name', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Bank::NAME_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('name', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cardholder">{{ trans('cruds.bank.fields.cardholder') }}</label>
                <input class="form-control {{ $errors->has('cardholder') ? 'is-invalid' : '' }}" type="text" name="cardholder" id="cardholder" value="{{ old('cardholder', '') }}" required>
                @if($errors->has('cardholder'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cardholder') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.cardholder_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection