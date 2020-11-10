@can('feedback_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.feedback.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.feedback.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.feedback.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userFeedback">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.feedback.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedback.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedback.fields.transaction') }}
                        </th>
                        <th>
                            {{ trans('cruds.transaction.fields.check_out') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedback.fields.comment') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedback.fields.rating') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedback.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedback as $key => $feedback)
                        <tr data-entry-id="{{ $feedback->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $feedback->id ?? '' }}
                            </td>
                            <td>
                                {{ $feedback->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $feedback->transaction->check_in ?? '' }}
                            </td>
                            <td>
                                {{ $feedback->transaction->check_out ?? '' }}
                            </td>
                            <td>
                                {{ $feedback->comment ?? '' }}
                            </td>
                            <td>
                                {{ $feedback->rating ?? '' }}
                            </td>
                            <td>
                                @if($feedback->photo)
                                    <a href="{{ $feedback->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $feedback->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('feedback_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.feedback.show', $feedback->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('feedback_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.feedback.edit', $feedback->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('feedback_delete')
                                    <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('feedback_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.feedback.massDestroy') }}",
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
  let table = $('.datatable-userFeedback:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection