<div class="container text-center">
    <nav aria-label="...">
        <ul class="pagination">                    
            @if ($page > 0)
                <li class="page-item">
                    <a href="{{ route('entradas', $page - 1) }}">
                        <span class="page-link">Anterior</span>
                    </a>
                </li>
            @endif
            
            @for ($i = $page; $i <= $page + 2; $i++)
                <li class="page-item {{ $i == $page + 1 ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('entradas', $i) }}">{{ $i }}</a>
                </li>
            @endfor
            
            @if ($contador > $offset + 3)
                <li class="page-item">
                    <a class="page-link" href="{{ route('entradas', $page + 1) }}">{{ $page + 2 }}</a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="{{ route('entradas', $page + 1) }}">Siguiente</a>
                </li>
            @endif
        </ul>
    </nav>
</div>