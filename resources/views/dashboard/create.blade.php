@extends('dashboard.layout')
@section('content')
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

        <div class="container content" style="margin-top: auto;">
            <form id="create-form" style="border-radius:15px" action="{{ route('store') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="container d-flex align-items-center alert alert-danger" style="border-radius: 15px">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h3>Create Todo</h3>

                <fieldset>
                    <label for="">Title</label>
                    <input placeholder="title of todo" type="text" name="title">
                </fieldset>
                <fieldset>
                    <label for="">Target Date</label>
                    <input placeholder="Target Date" type="date" name="date">
                </fieldset>
                <fieldset>
                    <label for="">Description</label>
                    <textarea name="description" placeholder="Type your descriptions here..." tabindex="5"></textarea>
                </fieldset>
                <fieldset>
                    <button type="submit" id="contactus-submit">Submit</button>
                </fieldset>
                <fieldset>
                    <a href="/todo/" class="btn-cancel btn-lg btn">Cancel</a>
                </fieldset>

            </form>
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
