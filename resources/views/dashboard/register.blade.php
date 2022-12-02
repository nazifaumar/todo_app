@extends('dashboard.layout')
@section('content')
    <style>
        .card {
            background-image: url('https://images.rawpixel.com/image_800/czNmcy1wcml2YXRlL3Jhd3BpeGVsX2ltYWdlcy93ZWJzaXRlX2NvbnRlbnQvbHIvdjkwNC1udW5ueS0wMzIuanBn.jpg');
            background-size: cover;
        }

        .bayangan {
            box-shadow: rgba(19, 17, 17, 0.514) 4px 4px 4px;
        }
    </style>

    <div class="card border-0 rounded-0 ">
        <form method="POST" action="{{ route('register-input') }}">
            @if ($errors->any())
                <div class="container d-flex align-items-center alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container d-flex align-items-center justify-content-center vh-100">
                <div class="form-control mt-3 bg-light border-0 w-50" style="--bs-bg-opacity: 0.2; ">
                    @csrf
                    <div class="text-center">
                        <div class="mt-4">
                                <img src="https://todolist.bapeten.go.id/img/todolist.png" style="width: 160px" alt="TODOLIST">
                                <br>
                                <br>
                                <br>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Full Name</label>
                        <input type="name" class="opacity-50 form-control" id="exampleInputName" style="border-radius: 15px" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="opacity-50 form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="border-radius: 15px"
                            name="email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="username" class="opacity-50 form-control" id="exampleInputusername1"
                            aria-describedby="usernameHelp" style="border-radius: 15px" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Create Passwords</label>
                        <input type="password" class="opacity-50 form-control" id="exampleInputPassword1" style="border-radius: 15px" name="password">
                        <div class="form-text"></div>
                    </div>
                    <div class="mb-3 form-check">
                        <a class="form-check-label " style="margin-left: 380px" for="exampleCheck1" href="/">I have
                            Account</a>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-submit btn mb-4">Register</button>
                    </div>
        </form>
    </div>
    </div>
    </div>
@endsection

