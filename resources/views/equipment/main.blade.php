@extends('app')
@section('content')

<div class="container-fluid container-padded dash-controls">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12 page-title" id="sandbox-container">
                <h2>{{$obj}}</h2>
                    
            </div>
        </div>
    </div>
</div>
<div class="main-content">
    <section>
        <div class="container-fluid container-padded">
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  
                         @if(isset($obj))
                            @if($obj=='techsrv')
                                @include('equipment\techsrv')
                            @endif
                            @if($obj=='dbsrvsau')
                                @include('equipment\dbsrvsau')
                            @endif
                        @if($obj=='docsrv')
                                @include('equipment\saudoc')
                            @endif
                        @endif
                  
                </div>
              </div>
            </div>
        </div>
    </section>
</div>
   
@endsection 