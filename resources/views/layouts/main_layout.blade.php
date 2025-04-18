<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Título padrão' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen p-4">

    @yield('content')

    {{-- <script src="https://unpkg.com/inputmask/dist/inputmask.min.js"></script> --}}
    <script src="https://unpkg.com/imask"></script>
    <script>
        
        mask('depositar');
        mask('sacar');
        mask('transferir');

        function mask(id){
            const input = document.getElementById(id);
            const maskOptions = {
            mask: 'num',
            blocks: {
                num: {
                mask: Number,
                thousandsSeparator: '.',
                radix: ',',
                mapToRadix: ['.'],
                scale: 2,
                signed: false
                }
            }
            };
            IMask(input, maskOptions);
        }
    </script>
</body>
</html>
