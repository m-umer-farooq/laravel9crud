<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" integrity="sha512-XWTTruHZEYJsxV3W/lSXG1n3Q39YIWOstqvmFsdNEEQfHoZ6vm6E9GK2OrF6DSJSpIbRbi+Nn0WDPID9O7xB2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
</head>
<body>

    <div class="container">

        @if (session()->has('success'))
            <div class="row mt-5">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session()->has('errors'))
            <div class="row mt-5">
                <div class="alert alert-danger">
                    {{ session('errors') }}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <a href="user-add" class="btn btn-primary">Add New</a>
            </div>
        </div>

    @if (!empty($users))
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone #</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>
                    <a href="user-edit-{{ $user->id }}">Edit</a>
                    <a href="user-delete-{{ $user->id }}">Delete</a>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
      {{-- {{ $users->links() }} --}}

      @else

        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    No Record Found
                </div>
            </div>
        </div>




      @endif


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.bundle.min.js" integrity="sha512-9GacT4119eY3AcosfWtHMsT5JyZudrexyEVzTBWV3viP/YfB9e2pEy3N7WXL3SV6ASXpTU0vzzSxsbfsuUH4sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
