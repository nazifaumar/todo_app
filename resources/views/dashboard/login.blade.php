@extends('dashboard.layout')
@section('content')
    <style>
        .card {
            background-image: url('https://images.rawpixel.com/image_800/czNmcy1wcml2YXRlL3Jhd3BpeGVsX2ltYWdlcy93ZWJzaXRlX2NvbnRlbnQvbHIvdjkwNC1udW5ueS0wMzIuanBn.jpg');
            background-size: cover;
        }
    </style>
    <div class="card border-0 rounded-0" >
        <form method="POST" class="user" action="{{ route('login.auth') }}">
            {{-- mengambil dan mengirim data input ke controller yg nantinya diambil oleh request $request --}}
            @csrf
            @if ($errors->any())
            <script>
                Swal.fire(
                    'Username Tidak Tersedia!',
                    '',
                    'info',
                )
            </script>
            @endif
            @if (session('succes'))
                <div class="alert alert-success">
                    {{ session('succes') }}
                </div>
            @endif

            @if (session('notAllowed'))
                <script>
                    Swal.fire(
                    'Silahkan login terlebih dahulu!',
                    '.',
                    'error'
                    )
                </script>
            @endif

            <div class="container d-flex align-items-center justify-content-center vh-100">
                <div class="form-control mt-3 bg-light border-0 w-50 " style=" --bs-bg-opacity: 0.3;">
                    @csrf
                    <div class="text-center">
                         <br>
                             <h5 style="text-align:center;color:black">
                                 <img src="https://todolist.bapeten.go.id/img/todolist.png" style="width: 160px" alt="TODOLIST">
                       <br>
                                  <b>Login TODOLIST application</b>
                              </h5>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="opacity-75 form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" style="border-radius: 15px" name="username">
                        <div id="emailHelp" class="opacity-75 form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="opacity-75 form-control" id="exampleInputPassword1" style="border-radius: 15px" name="password">
                        <div id="emailHelp" class="opacity-50 form-text"></div>
                    </div>
                    <div class="mb-3 form-check">
                        <a class="form-check-label" style="margin-left: 0 px" for="exampleCheck1"
                            href="/register">Create an account</a>
                    </div>
                    <div class="mb-3 form-check">
                        <button type="submit" class="btn-login text-dark btn  mb-4">Login</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
