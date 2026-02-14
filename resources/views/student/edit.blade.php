<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        <h2>Student edit form , id = {{ $data->id }}</h2>

        @php
            // dd($data);
        @endphp
        <form action="{{ route('students.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name:</label>
                <input type="name" class="form-control" id="name" placeholder="Enter name" name="name"
                    value="{{ $data->name }}">
            </div>
            <div class="mb-3 mt-3">
                <label for="mobile" class="form-label">Mobile:</label>
                <input type="text" class="form-control" id="mobile" placeholder="Enter mobile" name="mobile"
                    value="{{ $data->mobile }}">
            </div>
            <div class="mb-3 mt-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone"
                    value="{{ $data->phone->name ?? '' }}">
            </div>
            <div class="mb-3 mt-3">
                <label for="hobbies" class="form-label">Hobbies: (ex:html,css,js)</label>
                <input type="text" class="form-control" id="hobbies" placeholder="Enter hobbies" name="hobbies"
                    value="{{ $data->hobbies_list ?? '' }}">
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>
