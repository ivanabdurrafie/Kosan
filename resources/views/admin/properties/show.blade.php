@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.property.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.properties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.id') }}
                        </th>
                        <td>
                            {{ $property->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.user') }}
                        </th>
                        <td>
                            {{ $property->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.name') }}
                        </th>
                        <td>
                            {{ $property->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.address') }}
                        </th>
                        <td>
                            {{ $property->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.rating') }}
                        </th>
                        <td>
                            {{ $property->rating }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.photos') }}
                        </th>
                        <td>
                            @foreach($property->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.properties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#property_rooms" role="tab" data-toggle="tab">
                {{ trans('cruds.room.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#property_banks" role="tab" data-toggle="tab">
                {{ trans('cruds.bank.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="property_rooms">
            @includeIf('admin.properties.relationships.propertyRooms', ['rooms' => $property->propertyRooms])
        </div>
        <div class="tab-pane" role="tabpanel" id="property_banks">
            @includeIf('admin.properties.relationships.propertyBanks', ['banks' => $property->propertyBanks])
        </div>
    </div>
</div>

@endsection