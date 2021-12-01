@extends('layouts.app')

@section('content')
@if(session()->has('success'))
                <div class="alert alert-success">
                 {{ session()->get('success') }}
                </div>
                 @endif

<a class="back_link" href="{{route('tables.index')}}" >Retour aux tableaux</a>
@if ($table)

    <div class="show_table_menu">
        <div class="show_table_name" >

                <h2>{{$table[0]->table_name}}</h2>

                {{-- <button><a href="" >Modifier</a></button>
                <form action="{{route('tables.destroy',$table[0]->id) }}" method="post">
                    @method("DELETE")
                    @csrf

                    <input type="submit" value="Supprimer"/>
                    </form>--}}


        </div>
                <div>
                <p>Crée par : {{$table[0]->user_creator->name}} </p>
                </div>
    </div>
<div class="show_table_element">




    <div class="column_list" >
        @foreach ($table[0]->columns as $column)


        <div class="column">
            <div>
                <span id="name-{{$column->id}}" class="column_title">{{$column->name}}</span>
            </div>
                {{-- CREATE A INPUT AND A BTN FOR EDIT NAME TABLE --}}
                <div class="column_buttons">
                {{-- FUNCTION UPDATE --}}
                <div class="column_buttons_hidden" hidden id="input-{{$column->id}}">
                        <form action="{{ route('columns.update', $column->id)}}" method="POST">

                            <input type="text" name="column_name" value="{{$column->name}}">

                            @csrf {{-- vai criar um token --}}
                            @method("PUT")
                            <button type="submit" class="btn btn-success" >

                                SAUVEGARDER
                            </button>
                        </form>
                </div>

                        {{-- BTN FOR TOGGLE LE BTN AND INPUT NAME TABLE --}}
                        <div class="column_buttons_mod_sup">
                        <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{$column->id}})">
                            MODIFIER
                        </button>
                            <form action="{{route('columns.destroy',$column->id) }}" method="post">
                                @method("DELETE")
                                @csrf

                                <input type="submit" class="btn btn-danger" value="SUPPRIMER"/>
                                </form>
                        </div>

                    <div class="new_ticket">

                        <form action="{{route('tickets.store')}}" method="post">
                         @csrf
                            <input id="myInput" type='text' name="content" placeholder="+ Nouveau ticket">
                            <input  hidden type='text' name='columns_id' value="{{$column->id}}">

                            <input hidden type="submit" value="créer ticket">
                        </form>
                    </div>

                        <div class="tickets_list" >
                            @foreach ($column->tickets as $ticket)


                                <div>
                                    <div>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="ticket" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter-{{$ticket->id}}">
                                            <span id="name-table-{{$ticket->id}}" class="column_title">{{$ticket->content}}</span>
                                            <div class="comments_counter">
                                            <p><i class="far fa-comment"></i> {{count($ticket->comments)}}</p>
                                            </div>

                                          </button>


                                          <!-- Modal -->
                                          <div class="modal fade" id="exampleModalCenter-{{$ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalCenterTitle">Ticket</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">

                                                    <span id="name-{{$ticket->id}}" class="column_title">{{$ticket->content}}</span>



                                                    <div hidden id="input-{{$ticket->id}}">
                                                        <form action="{{ route('tickets.update', $ticket->id)}}" method="POST">
                                                        <input type="text" name="content" value="{{$ticket->content}}">
                                                        @csrf
                                                        @method("PUT")
                                                            <button type="submit" class="btn btn-success" >
                                                                SAUVEGARDER
                                                            </button>
                                                        </form>


                                                    </div>
                                                    <div class="column_buttons_mod_sup">
                                                    {{-- BTN FOR TOGGLE LE BTN AND INPUT NAME TABLE --}}
                                                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{$ticket->id}})">
                                                        MODIFIER
                                                    </button>
                                                    <form action="{{route('tickets.destroy',$ticket->id) }}" method="post">
                                                        @method("DELETE")
                                                        @csrf

                                                        <input class="btn btn-danger" type="submit" value="SUPPRIMER"/>
                                                    </form>
                                                </div>

                                                    <div class="comments_form">
                                                        <p>Commentaires : {{count($ticket->comments)}}</p>

                                                        <form action="{{route('comments.store')}}" method="post">
                                                         @csrf
                                                            <input id="myInput" type='text' name="text_comment" placeholder="Ajouter un commentaire">
                                                            <input  hidden type='text' name='tickets_id' value="{{$ticket->id}}">
                                                            <input  hidden type='text' name='users_id' value="{{Auth::user()->id}}">

                                                            <input hidden type="submit" value="créer ticket">
                                                        </form>
                                                    </div>

                                                    <div class="comments" >

                                                        @foreach ($ticket->comments as $comment)
                                                        <div class="comments_list">
                                                        <span id="name-table-{{$comment->id}}" class="column_title">{{$comment->text_comment}}</span><span class="author"> Par : {{$comment->user_creator->name}}</span>
                                                        </div>
                                                        @endforeach
                                                    </div>



                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                </div>
                            @endforeach
                        </div>
                     </div>
                </div>
            @endforeach
    </div>
    <div class="form__group field">
        <form action="{{route('columns.store')}}" method="post">
            @csrf
        <input type="input" class="form__field" placeholder="+Nouvelle colonne" name="name" id='name' required />
        <label for="name" class="form__label">+Nouvelle colonne</label>
    </div>
        <input  hidden type='text' name='tables_id' value="{{$table[0]->id}}">

            <input hidden id="myBtn" type="submit" value="création">
        </form>




</div>
@endif


<script>
    var input = document.getElementById("myInput");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();

        }
    });
    </script>

@endsection
