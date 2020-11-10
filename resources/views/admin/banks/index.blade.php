@extends('layouts.admin')
@section('content')
@can('bank_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.banks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bank.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bank.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Bank">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.bank.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.bank.fields.property') }}
                        </th>
                        <th>
                            {{ trans('cruds.bank.fields.number') }}
                        </th>
                        <th>
                            {{ trans('cruds.bank.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.bank.fields.cardholder') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banks as $key => $bank)
                        <tr data-entry-id="{{ $bank->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $bank->id ?? '' }}
                            </td>
                            <td>
                                {{ $bank->property->name ?? '' }}
                            </td>
                            <td>
                                {{ $bank->number ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Bank::NAME_SELECT[$bank->name] ?? '' }}
                            </td>
                            <td>
                                {{ $bank->cardholder ?? '' }}
                            </td>
                            <td>
                                @can('bank_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.banks.show', $bank->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bank_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.banks.edit', $bank->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bank_delete')
                                    <form action="{{ route('admin.banks.destroy', $bank->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('bank_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.banks.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Bank:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection