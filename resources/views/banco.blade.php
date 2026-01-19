<!DOCTYPE html>
<html>

<head>
    <title>Bàn cờ vua {{ $n }}x{{ $n }}</title>
    <style>
        .board {
            display: grid;

            grid-template-columns: repeat({{ $n }}, 50px);
            width: fit-content;
            border: 2px solid #333;
            margin: 20px auto;
        }

        .cell {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .white {
            background-color: black;
            color: black;
        }

        .black {
            background-color: white;
            color: white;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center">Bàn cờ kích thước {{ $n }} x {{ $n }}</h2>

    <div class="board">
        @for ($row = 0; $row < $n; $row++)
            @for ($col = 0; $col < $n; $col++)
                <div class="cell {{ ($row + $col) % 2 == 0 ? 'white' : 'black' }}">

                </div>
            @endfor
        @endfor
    </div>
</body>

</html>