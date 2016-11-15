@extends('layouts.app')

@section('title','Admin users edit')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-push-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Gebruiker bewerken</b></div>

                    <div class="panel-body">
                        <form method="post" action="/admin/user/update">
                            {{ csrf_field() }}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Voornaam</label>
                                    <input type="text" class="form-control" placeholder="{{ trans('admin.placeholder_firstname') }}" value="{{ $user->first_name}}">
                                </div>
                                <div class="form-group">
                                    <label>Tussenvoegsel</label>
                                    <input type="text" class="form-control" value="{{ $user->insertion}}">
                                </div>
                                <div class="form-group">
                                    <label>Achternaam</label>
                                    <input type="text" class="form-control" placeholder="{{ trans('admin.placeholder_lastname') }}" value="{{ $user->last_name}}">
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" placeholder="{{ trans('admin.placeholder_mail') }}" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-md-push-1">
                                <div class="input-group pull-left">
                                    <label>Rol</label>
                                    <select class="form-control" name="role">
                                        @foreach($roles as $role)
                                            @if($role->id === $user->role_id)
                                                <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                            @else
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success pull-right">Wijzigingen opslaan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
