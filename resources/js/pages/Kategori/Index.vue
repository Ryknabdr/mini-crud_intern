<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';

defineProps<{
    kategoris: {
        data: any[];
        links: any[];
        from: number;
        to: number;
        total: number;
    }
}>();

const hapusData = (id: number) => {
    if (confirm('Yakin nih mau hapus kategori ini, Bos?')) {
        router.delete(`/kategori/${id}`);
    }
};
</script>

<template>
    <Head title="Data Kategori" />

    <div class="pop-page py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between sm:items-end gap-5 mb-7">
                <div>
                    <span class="font-mono-num text-[11px] font-semibold tracking-[0.25em] uppercase bg-blue text-white px-2.5 py-1 rounded-full inline-block mb-3 border-2 border-ink">
                        Gudang · Kategori
                    </span>
                    <h1 class="font-display text-4xl sm:text-5xl text-ink leading-tight">
                        Manajemen <span class="pop-highlight">Kategori</span>
                    </h1>
                    <p class="font-mono-num text-xs text-ink/45 uppercase tracking-widest mt-2">Daftar kategori master untuk barang</p>
                </div>
                <Link
                    href="/kategori/create"
                    class="pop-btn bg-yellow text-ink font-display text-sm py-3 px-6 shrink-0 text-center rounded-2xl"
                >
                    + Tambah Kategori
                </Link>
            </div>

            <!-- Meta strip -->
            <div class="flex items-center justify-between px-1 mb-4 font-mono-num text-[11px] uppercase tracking-widest text-ink/50">
                <span>Total entri: {{ kategoris.total }}</span>
            </div>

            <!-- Card Tabel -->
            <div class="bg-panel border-2 border-ink rounded-2xl overflow-hidden pop-shadow">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-purple text-white text-xs font-display tracking-wide">
                                <th class="p-4 text-center w-16 rounded-tl-2xl">No</th>
                                <th class="p-4">Nama Kategori</th>
                                <th class="p-4 text-center w-48 rounded-tr-2xl">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Looping Data Kategori -->  
                            <tr
                                v-for="(kat, index) in kategoris.data"
                                :key="kat.id"
                                class="border-b-2 border-ink/10 last:border-b-0 hover:bg-blue/10 transition-colors"
                            >
                                <td class="p-4 text-center font-mono-num font-bold text-ink/35 text-sm">
                                    {{ String(Number(kategoris.from || 1) + index).padStart(3, '0') }}
                                </td>

                                <td class="p-4 text-ink font-display text-base">{{ kat.nama_kategori }}</td>

                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="inline-flex gap-2">
                                        <Link
                                            :href="`/kategori/${kat.id}/edit`"
                                            class="pop-btn-sm bg-blue text-white font-mono-num text-xs font-bold px-3.5 py-2 rounded-xl"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="hapusData(kat.id)"
                                            class="pop-btn-sm bg-pink text-white font-mono-num text-xs font-bold px-3.5 py-2 rounded-xl"
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Kalau Data Kosong -->
                            <tr v-if="kategoris.data.length === 0">
                                <td colspan="3" class="p-14 text-center">
                                    <p class="font-display text-xl text-ink">Data kategori masih kosong</p>
                                    <p class="font-mono-num text-xs text-ink/45 mt-2 uppercase tracking-widest">Yuk tambahin kategori pertama, Bos.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Bagian Pagination -->
                <div v-if="kategoris.links && kategoris.links.length > 3" class="border-t-2 border-ink/10 p-4 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <span class="font-mono-num text-xs font-semibold uppercase tracking-widest text-ink/50">
                        {{ kategoris.from || 0 }}–{{ kategoris.to || 0 }} / {{ kategoris.total }}
                    </span>
                    <div class="flex flex-wrap justify-center gap-2">
                        <template v-for="(link, index) in kategoris.links" :key="index">
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                class="px-3 py-1.5 border-2 border-ink text-sm font-mono-num font-bold rounded-xl transition-colors"
                                :class="link.active ? 'bg-purple text-white' : 'bg-paper text-ink/70 hover:bg-yellow'"
                            >
                                <span v-html="link.label"></span>
                            </Link>
                            <span
                                v-else
                                class="px-3 py-1.5 border-2 border-ink/10 text-sm font-mono-num text-ink/25 bg-paper cursor-not-allowed rounded-xl flex items-center justify-center"
                            >
                                <span v-html="link.label"></span>
                            </span>
                        </template>
                    </div>
                </div>

            </div>
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
.bg-ink { background-color: #1F1B2E; }

.bg-paper { background-color: #FAF7FF; }
.bg-panel { background-color: #FFFFFF; }

.bg-blue { background-color: #3B82F6; }
.hover\:bg-blue\/10:hover { background-color: rgba(59, 130, 246, 0.1); }

.bg-purple { background-color: #8B5CF6; }

.bg-yellow { background-color: #FFD400; }
.hover\:bg-yellow:hover { background-color: #FFD400; }

.bg-pink { background-color: #FF4FA3; }

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

.pop-btn-sm {
    border: 2px solid #1F1B2E;
    box-shadow: 2.5px 2.5px 0 #1F1B2E;
    transition: transform 0.12s ease, box-shadow 0.12s ease;
}
.pop-btn-sm:hover {
    transform: translate(-1px, -1px);
    box-shadow: 3.5px 3.5px 0 #1F1B2E;
}
.pop-btn-sm:active {
    transform: translate(1px, 1px);
    box-shadow: 0.5px 0.5px 0 #1F1B2E;
}
</style>