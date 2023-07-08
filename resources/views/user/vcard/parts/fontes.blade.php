@php
    $fontes = [
        [
            'nome_fonte' => 'verdana',
            'titulo' => 'Verdana',
        ],
        [
            'nome_fonte' => 'Arial',
            'titulo' => 'Arial',
        ],[
            'nome_fonte' => 'Baskerville',
            'titulo' => 'Baskerville',
        ],
        [
            'nome_fonte' => 'Bodoni MT',
            'titulo' => 'Bodoni MT',
        ],[
            'nome_fonte' => 'Bodoni 72',
            'titulo' => 'Bodoni 72',
        ],
        [
            'nome_fonte' => 'calibri',
            'titulo' => 'Calibri',
        ],
        [
            'nome_fonte' => 'Calisto',
            'titulo' => 'Calisto',
        ],
        [
            'nome_fonte' => 'Cambria',
            'titulo' => 'Cambria',
        ],
        [
            'nome_fonte' => 'Candara',
            'titulo' => 'Candara',
        ],
        [
            'nome_fonte' => 'Century Gothic',
            'titulo' => 'Century Gothic',
        ],
        [
            'nome_fonte' => 'Consolas',
            'titulo' => 'Consolas',
        ],
        [
            'nome_fonte' => 'Arial',
            'titulo' => 'Arial',
        ],
        [
            'nome_fonte' => 'Copperplate Gothic',
            'titulo' => 'Copperplate Gothic',
        ],
        [
            'nome_fonte' => 'Courier New',
            'titulo' => 'Courier New',
        ],
        [
            'nome_fonte' => 'Dejavu Sans',
            'titulo' => 'Dejavu Sans',
        ],
        [
            'nome_fonte' => 'Didot',
            'titulo' => 'Didot',
        ],
        [
            'nome_fonte' => 'Franklin Gothic',
            'titulo' => 'Franklin Gothic',
        ],
        [
            'nome_fonte' => 'Garamond',
            'titulo' => 'Garamond',
        ],
        [
            'nome_fonte' => 'Georgia',
            'titulo' => 'Georgia',
        ],
        [
            'nome_fonte' => 'Gill Sans',
            'titulo' => 'Gill Sans',
        ],
        [
            'nome_fonte' => 'Goudy Old Style',
            'titulo' => 'Goudy Old Style',
        ],
        [
            'nome_fonte' => 'Helvetica',
            'titulo' => 'Helvetica',
        ],
        [
            'nome_fonte' => 'Impact',
            'titulo' => 'Impact',
        ],
        [
            'nome_fonte' => 'Lucida Bright',
            'titulo' => 'Lucida Bright',
        ],
        [
            'nome_fonte' => 'Lucida Sans',
            'titulo' => 'Lucida Sans',
        ],
        [
            'nome_fonte' => 'Microsoft Sans Serif',
            'titulo' => 'Microsoft Sans Serif',
        ],
        [
            'nome_fonte' => 'Optima',
            'titulo' => 'Optima',
        ],
        [
            'nome_fonte' => 'Palatino',
            'titulo' => 'Palatino',
        ],
        [
            'nome_fonte' => 'Perpetua',
            'titulo' => 'Perpetua',
        ],
        [
            'nome_fonte' => 'Rockwell',
            'titulo' => 'Rockwell',
        ],
        [
            'nome_fonte' => 'Tahoma',
            'titulo' => 'Tahoma',
        ],
        [
            'nome_fonte' => 'Trebuchet MS',
            'titulo' => 'Trebuchet MS',
        ],
        [
            'nome_fonte' => 'verdana',
            'titulo' => 'Verdana',
        ],
        [
            'nome_fonte' => 'Gill Sans',
            'titulo' => 'Gill Sans',
        ],
    ];
    
@endphp
<select name="{{$name}}" id="{{$id}}" class="form-control">
    @foreach ($fontes as $fonte)
        {{ $fonte['nome_fonte'] }}
        @include('user.vcard.parts.select_option', [
            'nome_fonte' => $fonte['nome_fonte'],
            'titulo' => $fonte['titulo'],
            'fonte_select' => $fonte_title,
        ])
    @endforeach
</select>
