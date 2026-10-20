<x-layouts.app title="Jadwal Periksa">

    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-slate-800">
            Jadwal Periksa
        </h2>

        <a href="{{ route('polis.create') }}" class="btn bg-[#2d4499] hover:bg-[#1e2d6b] 
                  text-white border-none rounded-lg px-5">
            <i class="fas fa-plus"></i>
            Tambah Jadwal Periksa
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if (session('success') || session('message'))
        <div class="alert alert-success mb-4 rounded-xl shadow-sm">
            <i class="fas fa-circle-check"></i>
            <span>{{ session('success') ?? session('message') }}</span>
        </div>
    @endif

    {{-- Notifikasi Error --}}
    @if (session('error'))
        <div class="alert alert-error mb-4 rounded-xl shadow-sm">
            <i class="fas fa-circle-xmark"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-100 text-xs uppercase tracking-wider text-slate-600">
                    <tr>
                        <th class="px-6 py-4">Hari</th>
                        <th class="px-6 py-4">Jam Mulai</th>
                        <th class="px-6 py-4">Jam Selesai</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-sm text-slate-700">
                    @forelse ($jadwals as $jadwal)
                        <tr class="border-b border-slate-100 hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $jadwal->hari }}
                            </td>

                            <td class="px-6 py-4">
                                {{ substr($jadwal->jam_mulai, 0, 5) }}
                            </td>

                            <td class="px-6 py-4">
                                {{ substr($jadwal->jam_selesai, 0, 5) }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    Aktif
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('jadwal-periksa.edit', $jadwal->id) }}"
                                       class="rounded-lg bg-amber-500 px-3 py-2 text-xs font-semibold text-white hover:bg-amber-600">
                                        Edit
                                    </a>

                                    <form action="{{ route('jadwal-periksa.destroy', $jadwal->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="rounded-lg bg-red-500 px-3 py-2 text-xs font-semibold text-white hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                Belum ada jadwal periksa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.app>