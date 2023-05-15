<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="mb-4">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Add
                Contact</button>
            <form action="{{ route('search') }}">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Search</span>
                    <input type="text" class="form-control" placeholder="Name" aria-label="Username"
                        aria-describedby="addon-wrapping" name="search">
                </div>
            </form>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            ?>
            <tbody>
                @if ($contacts->isEmpty())
                    <div class="alert alert-dark fw-bold" role="alert">
                        Data tidak ditemukan
                    </div>
                @else
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $contact->nama }}</td>
                            <td>{{ $contact->no_hp }}</td>
                            <td>
                                <a href="{{ route('deleteContact', $contact->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Contact</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeContact') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Nomor HP</label>
                        <input type="number" class="form-control" id="nomor_hp" name="no_hp">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
