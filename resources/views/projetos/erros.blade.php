@if ($errors->any())
    <div role="alert">
        <p>Verifique os dados informados:</p>
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif
