@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($errors) > 0 || session('success'))
            <div class="row">
                <div class="col-sm-12">
                    @if(count($errors))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-3">
                @if(user()->admin === 1)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">New round</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('new-round') }}" method="post">
                                {!! csrf_field() !!}

                                @foreach($people as $person)
                                    <label for="{{ $person->id }}">
                                        <input type="checkbox" name="people[]" value="{{ $person->user }}" id="{{ $person->id }}"> {{ $person->user }}
                                    </label>
                                @endforeach


                                <input type="submit" class="btn btn-primary" value="Start a new round!">
                            </form>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add person</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('add-person') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label>Person</label>
                                    <input type="text" name="person" placeholder="Persons name" class="form-control" value="{{ old('person') }}">
                                </div>
                                <div class="form-group">
                                    <label>Drink type</label>
                                    <select name="drink" class="form-control">
                                        @foreach(config('drinks') as $drink => $value)
                                            <option value="{{ $value }}">{{ ucwords($value) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>How many teaspoons of sugar?</label>
                                    <select name="sugar" class="form-control">
                                        @for($i=0;$i<6;$i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Any milk?</label>
                                    <select name="milk" class="form-control">
                                        <option value="None">None</option>
                                        <option value="Just a bit">Just a bit</option>
                                        <option value="A little more">A little more</option>
                                        <option value="Make it creamy">Make it creamy!</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>How busy are they generally?</label>
                                    <select name="busy" class="form-control">
                                        <option value="1">Super busy</option>
                                        <option value="2">Busy</option>
                                        <option value="3">Idle</option>
                                    </select>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Add person">
                            </form>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Current tea round</div>

                    <div class="panel-body">

                        @if(!$round)
                            There are no rounds currently
                        @else

                            <h2 class="text-center">{{ $round->chosen }} <br /><small> has been chosen to make the round</small></h2>
                            <div class="text-center">{{ $round->created_at->diffForHumans() }}</div>

                            <div class="text-center">
                                <form action="{{ route('call-round') }}">
                                    {!! csrf_field() !!}
                                    <input type="submit" value="Call for a new round" />
                                </form>
                            </div>

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
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
