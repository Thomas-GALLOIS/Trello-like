@foreach ($columns as $column)

                <div class="table_list"><a href="">
                <p> colonne : </p>
                {{-- FAUT METTRE LE NOM DANS UN SPAN --}}
               <span id="name-table-{{$column->id}}">{{$column->name}}</span>

                            <p>Id : {{$column->id}}</p></a>


                            {{-- CREATE A INPUT AND A BTN FOR EDIT NAME TABLE --}}
                           <div hidden id="input-name-table-{{$column->id}}">

                                <input type="text" value="{{$column->name}}">
                                <div>
                                    <button onclick="updateNameColumn({{$column->id}})">
                                        SAVE
                                    </button>
                                    @csrf {{-- vai criar um token --}}
                                </div>
                            </div>
                            {{-- BTN FOR TOGGLE LE BTN AND INPUT NAME TABLE --}}
                            <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{$column->id}})">
                                EDITER
                            </button>
                            <form action="" method="post">
                                @method("DELETE")
                                @csrf

                                <input type="submit" value="Supprimer"/>
                                </form>
                </div>
                @endforeach
