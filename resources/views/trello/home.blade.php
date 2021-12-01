@extends('layouts.app')

@section('content')
<div class="table_form">



<form class ="table_form_part" action="{{route('tables.store')}}" method="post">
    @csrf
    <input type='text' name="table_name" placeholder="Nouveau tableau">

    <label class="rad" onclick="maFonction()"><i class="fas fa-user-friends"></i></label>


    <div id="maDIV" style="display:none;">
    <input for="adresse_principale" type='email' name="guests" placeholder="Email de l'invité">
    </div>


    <input type="submit" value="création">
</form>

</div>


@if(session()->has('success'))
            <div class="alert alert-success">
             {{ session()->get('success') }}
            </div>
             @endif



<div class="table_title">
    <h4>Vos tableaux </h4>
</div>

<div class="view_port">
    <div class="polling_message">

    </div>
    <div class="cylon_eye"></div>
  </div>


                <div class="table_list">
                @foreach ($tables as $table)
                <div class="table_content"><a href="{{route('tables.show',$table->id)}}">

                        <div class="table_content_title">
                        <span id="name-{{$table->id}}">{{$table->table_name}}</span></a>
                        </div>



                            <div class="table_content_buttons">
                            {{-- CREATE A INPUT AND A BTN FOR EDIT NAME TABLE --}}
                            <div class="table_content_buttons_hidden" hidden id="input-{{$table->id}}">

                                <form action="{{ route('tables.update', $table->id)}}" method="POST">
                                    @csrf
                                    @method("PUT")

                                    <input type="text" name="table_name" value="{{$table->table_name}}">

                                    <button class="btn btn-success" type="submit">
                                        ENREGISTRER
                                    </button>
                                </form>
                            </div>
                            {{-- BTN FOR TOGGLE LE BTN AND INPUT NAME TABLE --}}
                            <div class="table_content_buttons_mod_sup">
                            <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{$table->id}})">
                                MODIFIER
                            </button>
                            <form action="{{route('tables.destroy',$table->id) }}" method="post">
                                @method("DELETE")
                                @csrf

                                <input type="submit" class="btn btn-danger" value="SUPPRIMER"/>
                                </form>
                            </div>
                </div>



                </div>

                @endforeach

                @if ($tables_guest)

        @foreach ($tables_guest as $item)
        <div class="table_content"><a href="{{route('tables.show',$item->id)}}">
            <div class="table_content_part">
            <span id="name-table-{{$item->id}}">{{$item->table_name}}</span>
            <p>Nom du créateur : {{$item->user_creator->name}}</p></a>
            </div>
        </div>
        @endforeach

    @endif
                </div>



                <script>
                    function toggleInput(tableId) {
                        const nomeTableEl = document.getElementById(`name-table-${tableId}`);
                        const inputTableEl = document.getElementById(`input-name-table-${tableId}`);
                            if (nomeTableEl.hasAttribute('hidden')) {
                                nomeTableEl.removeAttribute('hidden');
                                inputTableEl.hidden = true;
                            } else {
                                inputTableEl.removeAttribute('hidden');
                                nomeTableEl.hidden = true;
                            }
                        //
                        // function for edit the table's name
                        //
                    }

                    function updateNameTable(tableId) {
                        let formData = new FormData();
                        const name = document
                            .querySelector(`#input-name-table-${tableId} > input`)
                            .value;
                        const token = document
                            .querySelector(`input[name="_token"]`)
                            .value;
                        formData.append('name', name);
                        formData.append('_token', token);
                        const url = `/tables/${tableId}/updateNameTable`;
                        fetch(url, {
                            method: 'POST',
                            body: formData
                            }).then(() => {
                            toggleInput(tableId);
                            document.getElementById(`name-table-${tableId}`).textContent = name;
                            });
                    }

                    //
                    //Function to show guest input
                    //

                    function maFonction() {
                        var div = document.getElementById("maDIV");
                        if (div.style.display === "none") {
                            div.style.display = "block";
                        } else {
                        div.style.display = "none";
                            }
                        }





                </script>

            @endsection
