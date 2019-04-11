@extends('layouts.admin')

@section('content')

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Manager Product
                        </h2>
                    </div>
                    <div class="body">
                        <table id="mainTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>category name</th>
                                    <th>image</th>
                                    <th>type</th>
                                    <th>price paypal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allUser as $p)
                                  <tr>


                                           <td>{{ $p['name'] }}</td>
                                           <td>{{ $p['category_name'] }}</td>
                                           <td><img src="{{ $p['icon'] }}" width="48" height="48" alt="User" /></td>
                                           <td>{{ $p['type'] }}</td>
                                           <td>{{ number_format($p['price_paypal'], 0) }}</td>
                                           <td>
                                               <a onclick="javascript:delete_confirm({{ $p['id'] }});" href="#">
                                                   <i class="material-icons">delete</i>
                                               </a>
                                               <a href="/admin/product-update/{{ $p['id'] }}">
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

        var r = confirm("Do you want delete this product ?");
        if (r == true) {
            url = '/admin/product-delete/'+id;
            $(location).attr("href", url);
        }

    }
</script>
{{ $paginator->links() }}

@endsection
