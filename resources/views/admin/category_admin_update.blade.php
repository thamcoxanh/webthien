@extends('layouts.admin')

@section('content')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="/admin/category-update-success/{{ $data['id'] }}" method="post" id="update-form">
          <div class="card">
              <div class="header">
                  <h2>
                      Category Advanced
                  </h2>
                  @csrf
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button type="button" onclick="javascript:update_confirm()" class="btn btn-primary m-t-15 waves-effect">Save</button>
              </div>
              <div class="body">
                @if (@$errors != '')
                <div class="alert alert-danger">
                    <strong>Errors!</strong> {{ $errors }}
                </div>
                @endif

                <h2 class="card-inside-title">name</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="data[name]" class="form-control" placeholder="name" value="{{ @$data['name'] }}" >
                    </div>
                </div>

                <h2 class="card-inside-title">description</h2>
                <div class="form-group">
                    <div class="form-line">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" name="data[description]" class="form-control no-resize" placeholder="Please description what you want...">{{ @$data['description'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row clearfix">
                    <div class="col-sm-12">
                        <select name="data[parent_id]" class="form-control show-tick">
                            <option value="">-- Please select --</option>
                            @foreach($allcategory as $p)
                                <option value="{{ $p['id'] }}" @if (@$data['parent_id'] == $p['id'])  selected="selected" @endif>{{ $p['name'] }}</option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <br>
                <button type="button" onclick="javascript:update_confirm()" class="btn btn-primary m-t-15 waves-effect">Save</button>

              </div>
          </div>


        </form>
    </div>
</div>
<script>
    function update_confirm(id){

        var r = confirm("Do you want update this Category ?");
        if (r == true) {
            $('#update-form').submit();
        }

    }
</script>
@endsection
