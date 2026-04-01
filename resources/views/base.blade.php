<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'WorkWork')</title>
        @livewireStyles
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('index') }}"> WORKWORK </a>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    @if(auth()->check())
                        <span class='text-light'>Здравствуйте, {{auth()->user()->name }}</span>
                    @endif
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto flex gap-1">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('categoriesIndex')}}">Категории</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('companiesIndex')}}">Компании</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="btn btn-primary" href="{{route('login')}}">Вход</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary" href="{{route('register')}}">Регистрация</a>
                            </li> -->
                            @if(auth()->check())
                            <li>
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    <input type='submit' value='Выйти' class="btn btn-primary">
                                </form>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="btn btn-primary" href="{{route('cabinet.index')}}">Кабинет</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="flex-grow-1">
            <div class="container min-vh-100 py-4">@yield('content')</div>
        </main>
        <footer class="bg-dark text-white mt-auto">
            <div class="container py-3 text-center">ZHDK</div>
        </footer>
        @livewireScripts
    </body>
</html>
