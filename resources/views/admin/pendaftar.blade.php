@extends("layouts.app")

@section("content")
  <h2 class="mb-4 text-2xl font-bold">Data Pendaftar</h2>

  <table class="w-full bg-white rounded shadow">
    <thead>
      <tr class="bg-gray-200">
        <th class="p-3 text-start">Nama</th>
        <th class="p-3 text-start">Universitas</th>
        <th class="p-3 text-start">IPK</th>
        <th class="p-3 text-start">Posisi</th>
        <th class="p-3 text-start">Status</th>
        <th class="p-3 text-start">CV</th>
        <th class="p-3 text-start">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pendaftars as $pendaftar)
        <tr class="border-t">
          <td class="p-3">{{ $pendaftar->name }}</td>
          <td class="p-3">{{ $pendaftar->university }}</td>
          <td class="p-3">{{ $pendaftar->ipk }}</td>
          <td class="p-3">{{ $pendaftar->lowongan->posisi }}</td>
          <td class="p-3">
            @if ($pendaftar->status == "P")
              <span class="px-2 py-1 bg-yellow-200 rounded">Pending</span>
            @elseif ($pendaftar->status == "A")
              <span class="px-2 py-1 bg-green-200 rounded">Approved</span>
            @else
              <span class="px-2 py-1 bg-red-200 rounded">Rejected</span>
            @endif
          </td>
          <td class="p-3">
            <a
              href="{{ $pendaftar->path_cv }}"
              target="_blank"
              class="text-indigo-600 underline">
              Lihat CV
            </a>
          </td>
          <td class="flex p-3 gap-2">
            @if ($pendaftar->status == "P")
              <form
                method="POST"
                action="{{ route("admin.approve", $pendaftar->id) }}">
                @csrf
                @method("PATCH")

                <button class="px-3 py-1 text-white bg-green-600 rounded">
                  Approve
                </button>
              </form>

              <form
                method="POST"
                action="{{ route("admin.reject", $pendaftar->id) }}">
                @csrf
                @method("PATCH")

                <button class="px-3 py-1 text-white bg-red-600 rounded">
                  Reject
                </button>
              </form>
            @else
              <span class="text-gray-500 text-sm italic">Clear</span>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
