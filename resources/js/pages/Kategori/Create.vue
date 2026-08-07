<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    nama_kategori: ''
});

const submitData = () => {
    form.post('/kategori');
};
</script>

<template>
    <Head title="Tambah Kategori" />

    <div class="pop-page max-w-md mx-auto py-10 px-4">

        <!-- Eyebrow -->
        <span class="font-mono-num text-[11px] font-semibold tracking-[0.25em] uppercase bg-blue text-white px-2.5 py-1 rounded-full inline-block mb-3 border-2 border-ink">
            Gudang · Kategori Baru
        </span>

        <div class="bg-panel border-2 border-ink rounded-2xl p-8 pop-shadow">
            <h2 class="font-display text-2xl text-ink mb-1">Tambah <span class="pop-highlight">Kategori</span></h2>
            <p class="font-mono-num text-xs text-ink/45 uppercase tracking-widest mb-6">Kategori jadi master data buat barang</p>

            <form @submit.prevent="submitData" class="space-y-5">
                <div>
                    <label class="block font-mono-num text-xs font-bold uppercase tracking-widest text-ink mb-1.5">Nama Kategori</label>
                    <input
                        v-model="form.nama_kategori"
                        type="text"
                        placeholder="cth. Elektronik"
                        class="pop-input w-full px-4 py-2.5 rounded-xl text-ink placeholder:text-ink/30"
                    >
                    <span v-if="form.errors.nama_kategori" class="block font-mono-num text-red text-xs font-semibold mt-1.5">{{ form.errors.nama_kategori }}</span>
                </div>

                <div class="flex gap-3 pt-3">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="pop-btn bg-blue text-white font-display text-sm py-2.5 px-6 rounded-xl disabled:opacity-50"
                    >
                        {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
                    </button>
                    <Link
                        href="/kategori"
                        class="pop-btn-outline text-ink font-display text-sm py-2.5 px-6 rounded-xl text-center"
                    >
                        Batal
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Manrope:wght@600;800&family=JetBrains+Mono:wght@500;600&display=swap');

.pop-page {
    font-family: 'Manrope', sans-serif;
}

.font-display {
    font-family: 'Manrope', sans-serif;
    font-weight: 800;
    letter-spacing: -0.01em;
}

.font-mono-num {
    font-family: 'JetBrains Mono', monospace;
}

.text-ink { color: #1F1B2E; }
.border-ink { border-color: #1F1B2E; }

.bg-panel { background-color: #FFFFFF; }

.bg-blue { background-color: #3B82F6; }
.text-red { color: #E11D48; }

.pop-highlight {
    position: relative;
    white-space: nowrap;
}
.pop-highlight::before {
    content: '';
    position: absolute;
    left: -4px;
    right: -4px;
    bottom: 2px;
    height: 0.5em;
    background: #FFD400;
    z-index: -1;
    transform: rotate(-1deg);
}

.pop-input {
    background-color: #FFFFFF;
    border: 2px solid #1F1B2E;
    transition: box-shadow 0.15s ease, border-color 0.15s ease;
}
.pop-input:focus {
    outline: none;
    border-color: #3B82F6;
    box-shadow: 3px 3px 0 #3B82F6;
}

.pop-shadow {
    box-shadow: 6px 6px 0 rgba(31, 27, 46, 0.9);
}

.pop-btn {
    border: 2px solid #1F1B2E;
    box-shadow: 4px 4px 0 #1F1B2E;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.pop-btn:hover {
    transform: translate(-2px, -2px);
    box-shadow: 6px 6px 0 #1F1B2E;
}
.pop-btn:active {
    transform: translate(2px, 2px);
    box-shadow: 1px 1px 0 #1F1B2E;
}

.pop-btn-outline {
    background-color: #FFFFFF;
    border: 2px solid #1F1B2E;
    box-shadow: 4px 4px 0 #1F1B2E;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.pop-btn-outline:hover {
    transform: translate(-2px, -2px);
    box-shadow: 6px 6px 0 #1F1B2E;
    background-color: #FAF7FF;
}
.pop-btn-outline:active {
    transform: translate(2px, 2px);
    box-shadow: 1px 1px 0 #1F1B2E;
}
</style>