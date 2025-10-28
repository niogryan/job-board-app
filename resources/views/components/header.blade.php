<header class="header">
    <div class="container">
        <h1 class="logo">JobBoard</h1>
        <nav class="nav-menu">
            <a href="/">Home</a>
            <a href="{{ route('viewform') }}">Post a Job</a>
            <a href="{{ route('viewadmin') }}">Admin
                @if ($pending > 0)
                    <span class="badge bg-danger">{{ $pending }} </span>
                @endif
            </a>
        </nav>
    </div>
</header>
