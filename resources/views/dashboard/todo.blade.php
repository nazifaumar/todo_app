@extends('dashboard.layout')
@section('content')
    @if (session('notAllowed'))
        <script>
            Swal.fire(
                'Kamu sudah login !',
            )
        </script>
    @endif

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
            integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <title>Todo App</title>
    </head>

    <body>
        <div class="wrapper bg-white" style="margin-top: auto;">
            @if (Session::get('successUpdate'))
                <div class="alert alert-success">
                    {{ Session::get('successUpdate') }}
                </div>
            @endif
            @if (Session::get('done'))
                <div class="alert alert-success">
                    {{ Session::get('done') }}
                </div>
            @endif
            @if (Session::get('delete'))
                <div class="alert alert-success">
                    {{ Session::get('delete') }}
                </div>
            @endif
            @if (Session::get('succesAdd'))
                <div class="alert alert-success">
                    {{ Session::get('succesAdd') }}
                </div>
            @endif

            <div class="d-flex align-items-start justify-content-between" style="border-radius: 15px">
                <div class="d-flex flex-column">
                    <div class="h5">My Todo's</div>
                    <p class="text-muted text-justify">
                        Here's a list of activities you have to do
                    </p>
                    <br>
                    <span>
                        <a href="/create" class="text-success">Create</a>
                        <a href="">Complated</a>
                    </span>
                </div>

                <div class="info btn ml-md-4 ml-0">
                    <span class="fas fa-info" title="Info"></span>
                </div>
            </div>

            <div class="work border-bottom pt-3">
                <div class="d-flex align-items-center py-2 mt-1">
                    <div>
                        <span class="text-muted fas fa-comment btn"></span>
                    </div>
                    <div class="text-muted">{{ $todos->count() }} todos</div>
                    <button class="ml-auto btn bg-white text-muted fas fa-angle-down" type="button" data-toggle="collapse"
                        data-target="#comments" aria-expanded="false" aria-controls="comments"></button>
                </div>
            </div>
            <br>

            {{-- <form action="" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="fas fa-circle-check text-primary btn"></button>
            </form> --}}

            <div class="d-flex flex-column">
                @foreach ($todos as $todo)
                    <div class="comment d-flex align-items-start justify-content-start">
                        <div class="mr-2">
                            @if ($todo['status'] == 1)
                                <span class="fa-solid fa-bookmark text-secondary btn"></span>
                                {{-- cek kalau status nya selain satu baru muncul icon cekliss yang bisa di klik buat update ke completed --}}
                            @else
                                <form action="/completed/{{ $todo['id'] }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="fas fa-circle-check text-primary btn"></button>
                                </form>
                            @endif
                        </div>

                        <div class="d-flex flex-column w-75">
                            {{-- menampilkan data dinamis/data yg diambil dari db pada blade harus menggunakan {{}} --}}
                            {{ $todo['title'] }}
                            <a>{{ $todo['description'] }} </a>
                            <p class="text-muted">{{ $todo['status'] == 1 ? 'Completed' : 'On-Procces' }}
                                <span class="date">
                                    @if ($todo['status'] == 1)
                                        Selesai pada : {{ \Carbon\Carbon::parse($todo['done_time'])->format('j F, Y') }}
                                    @endif

                                </span>
                                <br>
                                <br>
                            <div class=" d-flex ">
                                <form action="{{ route('delete', $todo['id']) }}" method="POST" class=" align-self-end">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 bg-transparent">
                                        <a class="text-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </a>
                                    </button>
                                    </a>
                                </form>

                                <a href="{{ route('edit', $todo->id) }}" class="text-dark align-self-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        {{-- <div class="ml-auto">
                        <a href="{{route('delete', $todo->id) }}" class="btn" style="border-radius: 15px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                          </svg>
                        </a>
                    </div>
                    --}}
                    </div>
                @endforeach
            </div>
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
                integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
                integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
            </script>
    </body>

    </html>
@endsection
