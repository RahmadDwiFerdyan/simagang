<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <title>Sistem Magang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body class="min-h-screen bg-gray-100">
    <nav class="px-6 py-4 text-white bg-indigo-600 shadow">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div>
            <h1 class="text-2xl font-bold tracking-wide">Sistem Magang</h1>
          </div>

          @auth
            <div class="flex items-center gap-2">
              <div>
                  <h1>|</h1>
              </div>
              @if (auth()->user()->role === "admin")
                <a
                  href="{{ route("admin.index") }}"
                  class="px-4 py-2 rounded transition {{
                    request()->routeIs(
                      'admin.index',
                    )
                      ? "bg-white text-indigo-600 font-semibold"
                      : "hover:bg-white/10"
                  }}"
                >
                  Daftar Lowongan
                </a>
                <a
                  href="{{ route("admin.pendaftar") }}"
                  class="px-4 py-2 rounded transition {{
                    request()->routeIs(
                      'admin.pendaftar',
                    )
                      ? "bg-white text-indigo-600 font-semibold"
                      : "hover:bg-white/10"
                  }}"
                >
                  Pendaftar
                </a>
                <a
                  href="{{ route("admin.reports") }}"
                  class="px-4 py-2 rounded transition {{
                    request()->routeIs(
                      'admin.reports',
                    )
                      ? "bg-white text-indigo-600 font-semibold"
                      : "hover:bg-white/10"
                  }}"
                >
                  Laporan
                </a>
              @endif
            </div>
          @endauth
        </div>

        @auth
          <div class="flex items-center gap-4">
            <div class="hidden text-right md:block">
              <p class="font-semibold">
                {{ auth()->user()->nama ?? auth()->user()->name }}
              </p>

              <p class="text-sm text-indigo-100 capitalize">
                {{ auth()->user()->role }}
              </p>
            </div>

            @if (auth()->user()->avatar ?? false)
              <img
                src="{{ asset("storage/" . auth()->user()->avatar) }}"
                alt="{{ auth()->user()->nama ?? auth()->user()->name }}"
                class="object-cover w-10 h-10 rounded-full"
              />
            @else
              <div
                class="flex w-10 h-10 text-indigo-600 bg-white rounded-full items-center justify-center"
              >
                <i class="text-2xl bi bi-person-circle" aria-hidden="true"></i>
              </div>
            @endif

            <form method="POST" action="{{ route("logout") }}">
              @csrf

              <button
                class="px-4 py-2 bg-red-500 rounded hover:bg-red-600 transition"
              >
                Logout
              </button>
            </form>
          </div>
        @endauth
      </div>
    </nav>

    <main class="p-6">
      @if (session("success"))
        <div class="p-3 mb-4 text-green-700 bg-green-100 rounded">
          {{ session("success") }}
        </div>
      @endif

      @yield("content")
    </main>
  </body>
</html>
