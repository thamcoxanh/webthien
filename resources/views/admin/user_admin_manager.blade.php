@extends('layouts.admin')

@section('content')

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Manager User
                        </h2>
                    </div>
                    <div class="body">
                        <table id="mainTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>type</th>
                                    <th>service</th>
                                    <th>address</th>
                                    <th>phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allUser as $p)
                                  <tr>


                                           <td>{{ $p['name'] }}</td>
                                           <td>{{ $p['email'] }}</td>
                                           <td>{{ $p['type'] }}</td>
                                           <td>{{ $p['service'] }}</td>
                                           <td>{{ $p['address'] }}</td>
                                           <td>{{ $p['phone'] }}</td>
                                           <td>
                                               <a onclick="javascript:delete_confirm({{ $p['id'] }});" href="#">
                                                   <i class="material-icons">delete</i>
                                               </a>
                                               <a href="/admin/user-update/{{ $p['id'] }}">
                                                   <i class="material-icons">mode_edit</i>
                                               </a>
                                           </td>

                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<script>
    function delete_confirm(id){

        var r = confirm("Do you want delete this User ?");
        if (r == true) {
            url = '/admin/user-delete/'+id;
            $(location).attr("href", url);
        }

    }
</script>
{{ $paginator->links() }}

@endsection
