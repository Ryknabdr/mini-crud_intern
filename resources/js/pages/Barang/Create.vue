<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

// Tangkap props 'kategoris' dari controller
defineProps<{ kategoris: any[] }>();

const form = useForm({
    nama_barang: '',
    kategori_id: '', // Diubah jadi kategori_id
    stok: ''
});

const submitData = () => {
    form.post('/barang');
};
</script>

<template>
    <Head title="Tambah Barang" />

    <div class="pop-bg min-h-screen py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg mx-auto">

            <!-- Eyebrow -->
            <span class="font-mono-num text-[11px] font-semibold tracking-[0.25em] uppercase bg-purple text-white px-2.5 py-1 rounded-full inline-block mb-3 border-2 border-ink">
                Gudang · Barang Baru
            </span>

            <div class="bg-panel border-2 border-ink rounded-2xl p-8 pop-shadow">
                <h2 class="font-display text-2xl text-ink mb-1">Form Tambah <span class="pop-highlight">Barang</span></h2>
                <p class="font-mono-num text-xs text-ink/45 uppercase tracking-widest mb-6">Isi detail barang yang mau dicatat</p>

                <form @submit.prevent="submitData" class="space-y-5">
                    <div>
                        <label class="block font-mono-num text-xs font-bold uppercase tracking-widest text-ink mb-1.5">Nama Barang</label>
                        <input
                            v-model="form.nama_barang"
                            type="text"
                            placeholder="cth. Kabel HDMI 2m"
                            class="pop-input w-full px-4 py-2.5 rounded-xl text-ink placeholder:text-ink/30"
                        >
                        <span v-if="form.errors.nama_barang" class="block font-mono-num text-red text-xs font-semibold mt-1.5">{{ form.errors.nama_barang }}</span>
                    </div>

                    <div>
                        <label class="block font-mono-num text-xs font-bold uppercase tracking-widest text-ink mb-1.5">Kategori</label>
                        <select
                            v-model="form.kategori_id"
                            class="pop-input w-full px-4 py-2.5 rounded-xl text-ink"
                        >
                            <option value="" disabled>-- Pilih Kategori --</option>
                            <option v-for="kat in kategoris" :key="kat.id" :value="kat.id">
                                {{ kat.nama_kategori }}
                            </option>
                        </select>
                        <span v-if="form.errors.kategori_id" class="block font-mono-num text-red text-xs font-semibold mt-1.5">{{ form.errors.kategori_id }}</span>
                    </div>

                    <div>
                        <label class="block font-mono-num text-xs font-bold uppercase tracking-widest text-ink mb-1.5">Stok</label>
                        <input
                            v-model="form.stok"
                            type="number"
                            placeholder="0"
                            class="pop-input w-full px-4 py-2.5 rounded-xl text-ink placeholder:text-ink/30 font-mono-num"
                        >
                        <span v-if="form.errors.stok" class="block font-mono-num text-red text-xs font-semibold mt-1.5">{{ form.errors.stok }}</span>
                    </div>

                    <div class="flex gap-3 pt-3">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="pop-btn bg-yellow text-ink font-display text-sm py-2.5 px-6 rounded-xl disabled:opacity-50"
                        >
                            {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
                        </button>
                        <Link
                            href="/barang"
                            class="pop-btn-outline text-ink font-display text-sm py-2.5 px-6 rounded-xl text-center"
                        >
                            Batal
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Manrope:wght@600;800&family=JetBrains+Mono:wght@500;600&display=swap');

.pop-bg {
    background-color: #FAF7FF;
    background-image: radial-gradient(circle, rgba(139, 92, 246, 0.08) 1.5px, transparent 1.5px);
    background-size: 22px 22px;
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
.bg-ink { background-color: #1F1B2E; }

.bg-panel { background-color: #FFFFFF; }

.bg-purple { background-color: #8B5CF6; }
.bg-yellow { background-color: #FFD400; }
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

/* Inputs: thick border, focus turns it electric blue */
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

/* Buttons */
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