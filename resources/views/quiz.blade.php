<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuesioner Kepribadian</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --text: #2e1065;
            --text-muted: #6b21a8;
            --text-soft: #a21caf;
            --stroke: rgba(88, 28, 135, 0.18);
            --card: rgba(255, 255, 255, 0.92);
            --card-strong: #ffffff;
            --pill-bg: rgba(217, 70, 239, 0.16);
            --pill-text: #a21caf;
            --btn-from: #ec4899;
            --btn-to: #7c3aed;
            --ring: rgba(217, 70, 239, 0.25);
            --accent-soft: rgba(217, 70, 239, 0.12);
            --bg-radial-1: #fce7f3;
            --bg-radial-2: #ede9fe;
            --bg-linear-top: #fdf2f8;
            --bg-linear-mid: #f5d0fe;
            --bg-linear-bottom: #ede9fe;
            --blob-1: rgba(236, 72, 153, 0.35);
            --blob-2: rgba(139, 92, 246, 0.35);
            --blob-3: rgba(217, 70, 239, 0.25);
        }
        @media (prefers-color-scheme: dark) {
            :root {
                --text: #f5f3ff;
                --text-muted: #e9d5ff;
                --text-soft: #f9a8d4;
                --stroke: rgba(216, 180, 254, 0.22);
                --card: rgba(12, 6, 28, 0.88);
                --card-strong: rgba(18, 8, 40, 0.95);
                --pill-bg: rgba(236, 72, 153, 0.22);
                --pill-text: #f9a8d4;
                --btn-from: #f472b6;
                --btn-to: #8b5cf6;
                --ring: rgba(244, 114, 182, 0.35);
                --accent-soft: rgba(244, 114, 182, 0.18);
                --bg-radial-1: #3b0764;
                --bg-radial-2: #1e1b4b;
                --bg-linear-top: #0f0a1f;
                --bg-linear-mid: #1a1036;
                --bg-linear-bottom: #2e1065;
                --blob-1: rgba(236, 72, 153, 0.25);
                --blob-2: rgba(139, 92, 246, 0.25);
                --blob-3: rgba(88, 28, 135, 0.4);
            }
        }
        body {
            font-family: "Instrument Sans", sans-serif;
            color: var(--text);
            background:
                radial-gradient(900px circle at 10% 10%, var(--bg-radial-1) 0%, transparent 55%),
                radial-gradient(1000px circle at 90% 0%, var(--bg-radial-2) 0%, transparent 45%),
                linear-gradient(180deg, var(--bg-linear-top) 0%, var(--bg-linear-mid) 50%, var(--bg-linear-bottom) 100%);
            min-height: 100vh;
        }
        h1, h2, h3 {
            font-family: "Space Grotesk", sans-serif;
            letter-spacing: -0.02em;
            color: var(--text);
        }
        .glass-card {
            background: var(--card);
            border: 1px solid var(--stroke);
            box-shadow: 0 30px 60px rgba(30, 10, 60, 0.18), 0 10px 20px rgba(30, 10, 60, 0.12);
            backdrop-filter: blur(8px);
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--btn-from), var(--btn-to));
            box-shadow: 0 12px 24px rgba(124, 58, 237, 0.25);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 30px rgba(124, 58, 237, 0.35);
        }
        .input {
            border: 1px solid var(--stroke);
            background: var(--card-strong);
            color: var(--text);
        }
        .input:focus {
            outline: none;
            border-color: var(--btn-from);
            box-shadow: 0 0 0 3px var(--ring);
        }
        .pill {
            background: var(--pill-bg);
            color: var(--pill-text);
        }
        .text-ink { color: var(--text); }
        .text-muted { color: var(--text-muted); }
        .text-soft { color: var(--text-soft); }
        .border-soft { border-color: var(--stroke); }
        .bg-card { background: var(--card); }
        .bg-card-strong { background: var(--card-strong); }
        .bg-accent-soft { background: var(--accent-soft); }
        .choice {
            border: 1px solid var(--stroke);
            background: var(--card);
            color: var(--text);
        }
        .peer:checked + .choice {
            border-color: transparent;
            background: linear-gradient(135deg, var(--btn-from), var(--btn-to));
            color: #ffffff;
            box-shadow: 0 10px 18px rgba(124, 58, 237, 0.3);
        }
        .fade-up {
            animation: fadeUp 0.6s ease-out both;
        }
        .floaty {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="relative overflow-x-hidden">
    <div class="pointer-events-none absolute -top-32 -left-20 h-64 w-64 rounded-full blur-3xl floaty" style="background: var(--blob-1);"></div>
    <div class="pointer-events-none absolute top-0 right-0 h-72 w-72 rounded-full blur-3xl floaty" style="background: var(--blob-2); animation-delay:-2s;"></div>
    <div class="pointer-events-none absolute bottom-0 left-1/2 h-64 w-64 -translate-x-1/2 rounded-full blur-3xl floaty" style="background: var(--blob-3); animation-delay:-4s;"></div>

    <main class="relative mx-auto max-w-3xl px-4 py-8 sm:px-6 sm:py-12">
        <div class="glass-card rounded-3xl p-6 sm:p-8 md:p-10 fade-up">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <span class="pill rounded-full px-3 py-1 text-xs font-semibold">Langkah 2/2</span>
                <span class="text-xs text-soft">Jawab semua biar sah</span>
            </div>

            <h1 class="mt-6 text-3xl font-bold text-ink sm:text-4xl md:text-5xl">Kuesioner Kebenaran</h1>
            <p class="mt-3 text-sm text-muted sm:text-base">Santai aja, ini cuma buat seru-seruan.</p>

            <div class="mt-6 rounded-2xl border border-soft bg-card-strong p-4">
                <div class="text-xs font-semibold text-soft">Identitas</div>
                <div class="text-lg font-semibold text-ink">{{ $nama }}</div>
            </div>

            @if($errors->any())
                <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if($questions->isEmpty())
                <div class="mt-6 rounded-2xl border border-yellow-200 bg-yellow-50 p-4 text-sm text-yellow-700">
                    Pertanyaan belum tersedia. Tambahkan data pertanyaan dulu ya.
                </div>
            @else
                <form action="{{ route('quiz.submit') }}" method="POST" class="mt-8">
                    @csrf

                    @foreach($questions as $index => $q)
                    <div class="mb-6 rounded-2xl border border-soft bg-card-strong p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-5">
                        <p class="mb-4 text-base font-semibold text-ink sm:text-lg">{{ $index + 1 }}. {{ $q->question_text }}</p>

                        <div class="mb-2 flex justify-between text-xs text-soft sm:text-sm">
                            <span>Gak Banget (1)</span>
                            <span>Banget (5)</span>
                        </div>

                        <div class="grid grid-cols-3 gap-2 sm:grid-cols-5">
                            @for($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer">
                                <input type="radio" name="answers[{{ $q->id }}]" value="{{ $i }}" required class="peer sr-only">
                                <div class="choice flex flex-col items-center rounded-xl py-2 text-xs font-semibold transition hover:bg-card-strong sm:text-sm">
                                    <span class="text-base font-bold sm:text-lg">{{ $i }}</span>
                                    <span class="text-xs opacity-70">Skor</span>
                                </div>
                            </label>
                            @endfor
                        </div>
                    </div>
                    @endforeach

                    <button type="submit" class="btn-primary w-full rounded-xl py-3 text-sm font-semibold text-white transition sm:text-base">
                        Lihat Hasil Kebenaran
                    </button>
                </form>
            @endif
        </div>
    </main>
</body>
</html>
