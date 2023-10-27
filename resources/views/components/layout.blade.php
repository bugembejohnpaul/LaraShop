<x-header />
        <x-navbar />
        <main>
  
        <!-- @yield('content') -->
            {{$slot}}
        </main>
        <x-flash-message />
<x-footer />