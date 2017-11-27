@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-md-4 ">

            <div class="panel panel-primary">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body text-center">
                   <h3>Total VC <span class="label label-info">{{$vc}}</span></h3>
                </div>
            </div>
        
            <div class="panel panel-primary">
                <div class="panel-heading">Logs</div>
                <div class="panel-body">
                   <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>VC Sent</th>
                                <th>VC Received</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_logs as $logs)
                            <tr>
                                @if($logs->receiver_id !=  Auth::user()->id)
                                <td>{{$logs->quantity}}</td>
                                <td></td>
                                @else
                                <td></td>
                                <td>{{$logs->quantity}}</td>
                                @endif
                                <td>{{$logs->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                   </table>
                </div>
            </div>
        </div>    
        @if (Session::has('error'))
        <div class="col-md-8">
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                    {{ Session::get('error') }}
            </div>
        </div> 
        @endif
        @if (Session::has('success'))
        <div class="col-md-8">
            <div class="alert alert-success" role="alert">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                <span class="sr-only">Success:</span>
                    {{ Session::get('success') }}
            </div>
        </div> 
        @endif
        <div class="col-md-8">
            {!! Form::open(['url' => 'sendvc']) !!}
                <div class="panel panel-primary">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Send VC</div>
                            <!-- List group -->
                            <ul class="list-group">
                                @foreach($users as $user)
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon3">{{$user->name}}</span>
                                        {!! Form::text('vcqty[]',null,['class'=>'form-control','id'=>'basic-url']) !!}
                                        {!! Form::hidden('userid[]',$user->id,['class'=>'form-control','id'=>'basic-url']) !!}
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        <div class="panel-footer">
                          <button type="submit" class="btn btn-primary ">Send</button>
                        </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
