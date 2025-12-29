@extends('admin.layout')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <span class="pill rounded-full px-3 py-1 text-xs font-semibold">{{ $isEdit ? 'Edit Pertanyaan' : 'Tambah Pertanyaan' }}</span>
            <h1 class="mt-4 text-3xl font-bold text-ink sm:text-4xl">
                {{ $isEdit ? 'Ubah Pertanyaan' : 'Buat Pertanyaan Baru' }}
            </h1>
            <p class="mt-2 text-sm text-muted sm:text-base">
                Atur kategori utama dan bobot skor per skala 1-5.
            </p>
        </div>
        <a href="{{ route('admin.questions.index') }}" class="btn-ghost rounded-xl px-4 py-2 text-sm font-semibold transition">Kembali</a>
    </div>

    @if($errors->any())
        <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ $isEdit ? route('admin.questions.update', $question) : route('admin.questions.store') }}" method="POST" class="mt-8 space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="rounded-2xl border border-soft bg-card-strong p-5">
            <label class="block text-sm font-semibold text-ink">Pernyataan</label>
            <textarea name="question_text" rows="3" required class="input mt-2 w-full rounded-xl px-4 py-3 text-sm sm:text-base">{{ old('question_text', $question->question_text) }}</textarea>

            <label class="mt-5 block text-sm font-semibold text-ink">Kategori Utama</label>
            <select name="category" class="input mt-2 w-full rounded-xl px-4 py-3 text-sm sm:text-base" required>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @selected(old('category', $question->category) === $category)>
                        {{ $categoryLabels[$category] ?? ucfirst($category) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="rounded-2xl border border-soft bg-accent-soft p-5">
            <div class="flex flex-wrap items-center justify-between gap-2">
                <div>
                    <div class="text-sm font-semibold text-ink">Bobot Skor (0-10)</div>
                    <div class="text-xs text-muted">Isi 0 jika tidak menambah kategori. Jika semua 0, sistem pakai skor default.</div>
                </div>
            </div>

            <div class="mt-4 space-y-4">
                @foreach(range(1, 5) as $score)
                    <div class="rounded-2xl border border-soft bg-card-strong p-4">
                        <div class="text-sm font-semibold text-ink">Skala {{ $score }}</div>
                        <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">
                            @foreach($categories as $category)
                                <div>
                                    <label class="text-xs font-semibold uppercase tracking-wide text-soft">
                                        {{ $categoryLabels[$category] ?? $category }}
                                    </label>
                                    <input
                                        type="number"
                                        min="0"
                                        max="10"
                                        name="weights[{{ $score }}][{{ $category }}]"
                                        value="{{ old('weights.' . $score . '.' . $category, $weights[$score][$category]) }}"
                                        class="input mt-1 w-full rounded-lg px-3 py-2 text-sm"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn-primary w-full rounded-xl py-3 text-sm font-semibold text-white transition sm:text-base">
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Pertanyaan' }}
        </button>
    </form>
@endsection
