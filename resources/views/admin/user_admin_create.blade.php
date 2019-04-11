@extends('layouts.admin')

@section('content')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="/admin/user-create" method="get" id="update-form">
          <div class="card">
              <div class="header">
                  <h2>
                      User Advanced
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
                <h2 class="card-inside-title">Name</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="data[name]" class="form-control" placeholder="name" value="{{ @$data['name'] }}" >
                    </div>
                </div>

                <h2 class="card-inside-title">Email</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="data[email]" class="form-control" placeholder="email" value="{{ @$data['email'] }}" >
                    </div>
                </div>

                <h2 class="card-inside-title">Password</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="password" name="data[password]" class="form-control" placeholder="password">
                    </div>
                </div>

                <h2 class="card-inside-title">Type</h2>

                <div class="row clearfix">
                    <div class="col-sm-12">
                        <select name="data[type]" class="form-control show-tick">
                            <option value="">-- Please select --</option>
                            <option value="default" @if (@$data['type'] == 'default')  selected="selected" @endif>default</option>
                            <option value="admin" @if (@$data['type'] == 'admin')  selected="selected" @endif>admin</option>
                        </select>
                    </div>

                </div>



              </div>
          </div>

          <div class="card">
              <div class="header">
                  <h2>
                      Profile
                  </h2>
              </div>
              <div class="body">


                <h2 class="card-inside-title">Address</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="data[address]" class="form-control" placeholder="address" value="{{ @$data['address'] }}" >
                    </div>
                </div>

                <h2 class="card-inside-title">Phone</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="data[phone]" class="form-control" placeholder="phone" value="{{ @$data['phone'] }}" >
                    </div>
                </div>

                <h2 class="card-inside-title">Price</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="data[price]" class="form-control" placeholder="price" value="{{ @$data['price'] }}" >
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

        var r = confirm("Do you want update this User ?");
        if (r == true) {
            $('#update-form').submit();
        }

    }
</script>
@endsection
