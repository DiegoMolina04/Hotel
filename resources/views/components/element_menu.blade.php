@props(['link', 'nombre', 'activo' ])

<li class="nav-item">
    <a href="{{$link}}" class="nav-link {{$activo}}" aria-current="page">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi me-2 bi-house" viewBox="0 0 16 16">
          {{$slot}}
        </svg>
      {{$nombre}}
    </a>
  </li>