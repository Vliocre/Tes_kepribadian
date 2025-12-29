@extends('admin.layout')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <span class="pill rounded-full px-3 py-1 text-xs font-semibold">Admin Dashboard</span>
            <h1 class="mt-4 text-3xl font-bold text-ink sm:text-4xl">Kelola Pertanyaan</h1>
            <p class="mt-2 text-sm text-muted sm:text-base">Tambah, ubah, dan atur bobot skor pertanyaan.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="btn-ghost rounded-xl px-4 py-2 text-sm font-semibold transition">Ke Halaman Utama</a>
            <a href="{{ route('admin.questions.create') }}" class="btn-primary rounded-xl px-4 py-2 text-sm font-semibold text-white transition">Tambah Pertanyaan</a>
        </div>
    </div>

    @if(session('status'))
        <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-8 space-y-4">
        @forelse($questions as $question)
            <div class="rounded-2xl border border-soft bg-card-strong p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="max-w-3xl">
                        <div class="text-xs font-semibold uppercase tracking-wide text-soft">
                            {{ $categoryLabels[$question->category] ?? $question->category }}
                        </div>
                        <div class="mt-1 text-lg font-semibold text-ink">{{ $question->question_text }}</div>
                        <div class="mt-2 text-xs text-muted">
                            Bobot: {{ $question->weights ? 'Custom (multi-kategori)' : 'Default (kategori utama)' }}
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.questions.edit', $question) }}" class="btn-ghost rounded-xl px-4 py-2 text-sm font-semibold transition">Edit</a>
                        <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" onsubmit="return confirm('Yakin mau hapus pertanyaan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-xl bg-rose-100 px-4 py-2 text-sm font-semibold text-rose-700 transition hover:bg-rose-200">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-soft bg-card-strong p-5 text-sm text-muted">
                Belum ada pertanyaan. Klik "Tambah Pertanyaan" untuk mulai.
            </div>
        @endforelse
    </div>
@endsection
