@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Current tea round</div>

                    <div class="panel-body">

                        <h2 class="text-center">{{ $round->chosen }} <br /><small> has been chosen to make the round</small></h2>
                        <div class="text-center">{{ $round->created_at->diffForHumans() }}</div>

                        <table class="table table-stripled">
                            <thead>
                            <tr>
                                <th>Person</th>
                                <th>Drink</th>
                                <th>Sugar</th>
                                <th>Milk</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($round->users as $user)
                                <tr>
                                    <td>{{ $user->user }}</td>
                                    <td>{{ $user->drink }}</td>
                                    <td>{{ $user->sugar }}</td>
                                    <td>{{ $user->milk }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
