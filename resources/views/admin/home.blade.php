@extends('layouts.admin')

@section('content')
<div class="admin_home">
<h1>Bonjour {{ Auth::guard('admin')->user()->name }}</h1>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <p>
                Bienvenue dans votre espace Admin
            </p>

    @if($users_all)
        <table class="table color">
        <thead>
            <tr>
                <th>
                    Création
                </th>
                <th>
                    Id
                </th>
                <th>
                    Nom
                </th>
                <th>
                    Mail
                </th>


            </tr>
        </thead>

        @foreach ($users_all as $user)

        <div hidden id="input-{{$user->id}}">
            <div>
                <form action="{{route('admin.update', $user->id)}}" method="POST">
                    @csrf
                    @method("PUT")
                    <input type="text" name="name" value="{{$user->name}}">
                    <input type="mail" name="email" value="{{$user->email}}">
                    <button type="submit"> UPDATE</button>
                </form>
            </div>
        </div>
        <tbody>
            <tr id="name-{{$user->id}}">
                <td>
                    <?= $rest = substr($user->created_at, 0, -9);  // retourne date sans l'heure ?>
                </td>
                <td>
                    {{$user->id}}
                </td>
                <td >
                    {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{$user->id}})">  Modifier  </button>
                </td>
                <td>
                    <form action="{{route('admin.delete', $user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>Supprimer </button>
                    </form>


                </td>
                <td>
                    <input type="radio" id="huey" name="drone" value="huey"
         checked> Admin
                </td>

            </tr>
        </tbody>

        @endforeach
            </table>
    @endif
        </div>
    </div>
</div>
</div>


@endsection
