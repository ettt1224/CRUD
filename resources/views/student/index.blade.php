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
        <h2>學生資料總表</h2>
        @php
            // dd($data);
        @endphp
        <p>The .table class adds basic styling (light padding and horizontal dividers) to a table:</p>

        <div class="text-end mb-3">
            <a href="{{ route('students.create') }}" class="btn btn-success">新增</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Phone</th>
                    <th>Hobbies</th>
                    <th>opt</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $value)
                    <tr>
                        <td>{{ $value->id ?? '' }}</td>
                        <td>{{ $value->name ?? '' }}</td>
                        <td>{{ $value->mobile ?? '' }}</td>
                        <td>{{ $value->phone->name ?? '' }}</td>
                        <td>
                            @foreach ($value->hobbies as $key => $item)
                                @if (empty($item->name))
                                    @break
                                @endif
                                {{ $key + 1 . '.' . $item->name ?? '' }}<br>
                            @endforeach
                        </td>
                        <td>

                            @php
                                // $url = route('students.edit',  ['student' => $value->id]);
                                // dd($url);
                            @endphp
                            {{-- <a href="{{ route('students.edit', $value->id) }}" class="btn btn-warning">修改</a> --}}

                            <form action="{{ route('students.destroy', ['student' => $value->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('students.edit', ['student' => $value->id]) }}"
                                    class="btn btn-warning">修改</a>
                                <button type="submit" class="btn btn-danger">刪除</button>
                            </form>

                            {{-- <a href="{{ route('students.destroy', ['student' => $value->id]) }}" class="btn btn-danger">刪除</a> --}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</body>

</html>
