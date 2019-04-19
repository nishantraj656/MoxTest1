@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                       
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif   
                    <div class="row">
                    <form method="POST" action="{{url('/categories')}}">
                        <div class="form-inline">
                            <input type="text" placeholder="Enter Category" class="form-control" name="categorie" />
                        <input  name="_token" value="{{csrf_token()}}" type="hidden">
                            <button type="submit" class="btn btn-primary">Add</button>
                            
                            

                        </div>
                    </form>
                    </div>
                    <div class="row">
                        <table class="table">
                        @foreach ($datas as $data )
                            <tr><td>
                            {{$data}}
                            </td></tr>
                            
                        @endforeach
                        </table>
                        <form method="POST" action="{{url('/categories/save')}}">
                            <div class="form-inline">
                                  <input  name="_token" value="{{csrf_token()}}" type="hidden">
                                <button type="submit" class="btn btn-primary">Save Data</button>                              
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
