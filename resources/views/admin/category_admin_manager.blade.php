@extends('layouts.admin')

@section('content')

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Manager Category
                        </h2>
                    </div>
                    <div class="body">
                        <table id="mainTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>description</th>
                                    <th>Parent Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allUser as $p)
                                  <tr>


                                           <td>{{ $p['name'] }}</td>
                                           <td>{{ $p['description'] }}</td>
                                           <td>{{ $p['parent_name'] }}</td>
                                           <td>
                                              @if (@$p['id'] != 1 && $p['id'] != 7)
                                               <a onclick="javascript:delete_confirm({{ $p['id'] }});" href="#">
                                                   <i class="material-icons">delete</i>
                                               </a>
                                               @endif
                                               <a href="/admin/category-update/{{ $p['id'] }}">
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

        var r = confirm("Do you want delete this Category ?");
        if (r == true) {
            url = '/admin/category-delete/'+id;
            $(location).attr("href", url);
        }

    }
</script>
{{ $paginator->links() }}

@endsection
