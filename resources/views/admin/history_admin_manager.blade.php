@extends('layouts.admin')

@section('content')

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Tài khoản đã mua
                        </h2>
                    </div>
                    <div class="body">
                        <table id="mainTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>type</th>
                                    <th>service</th>
                                    <th>phone</th>
                                    <th>price</th>
                                    <th>product</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allPaypal as $p)
                                  <tr>

                                          <td>{{ $p['id'] }}</td>
                                           <td>{{ $p['name'] }}</td>
                                           <td>{{ $p['email'] }}</td>
                                           <td>{{ $p['type'] }}</td>
                                           <td>{{ $p['service'] }}</td>
                                           <td>{{ $p['phone'] }}</td>
                                           <td>{{ number_format($p['price'], 0) }} </td>
                                           <td>{{ $p['pname'] }}</td>

                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

{{ $paginator->links() }}

@endsection
