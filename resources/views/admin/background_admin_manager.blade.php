@extends('layouts.admin')

@section('content')

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Manager Background
                        </h2>
                    </div>
                    <div class="body">
                        <table id="mainTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allUser as $p)
                                  <tr>

                                            <td>{{ $p['id'] }}</td>
                                           <td>{{ $p['name'] }}</td>

                                           <td>
                                               <a onclick="javascript:delete_confirm({{ $p['id'] }});" href="#">
                                                   <i class="material-icons">delete</i>
                                               </a>
                                               <a href="/admin/background-update/{{ $p['id'] }}">
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

        var r = confirm("Do you want delete this background ?");
        if (r == true) {
            url = '/admin/background-delete/'+id;
            $(location).attr("href", url);
        }

    }
</script>
{{ $paginator->links() }}

@endsection
