@extends('layouts.app')

@section('title', 'Rencana Aksi RB Tematik')

@section('content')
<div class="container">
    <h1 class="mb-4">Rencana Aksi RB Tematik</h1>

    <!-- Rencana Aksi -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Rencana Aksi</h3>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="nomenklatur_rencana_aksi">Nomenklatur Rencana Aksi</label>
                <input type="text" id="nomenklatur_rencana_aksi" name="nomenklatur_rencana_aksi" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="pagu_anggaran">Pagu Anggaran</label>
                <input type="number" id="pagu_anggaran" name="pagu_anggaran" class="form-control">
            </div>
        </div>
    </div>

    <!-- Indikator Rencana Aksi -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Indikator Rencana Aksi</h3>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="indikator_output_rencana_aksi">Indikator Output Rencana Aksi</label>
                <input type="text" id="indikator_output_rencana_aksi" name="indikator_output_rencana_aksi" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="satuan_indikator_output_rencana_aksi">Satuan Indikator Output Rencana Aksi</label>
                <input type="text" id="satuan_indikator_output_rencana_aksi" name="satuan_indikator_output_rencana_aksi" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="fokus_intervensi">Fokus Intervensi</label>
                <select id="fokus_intervensi" name="fokus_intervensi" class="form-control">
                    <option value="Perencanaan dan Penganggaran">Perencanaan dan Penganggaran</option>
                    <option value="Proses Bisnis dan SOP">Proses Bisnis dan SOP</option>
                    <option value="Sumber Daya Manusia">Sumber Daya Manusia</option>
                    <option value="Pengawasan">Pengawasan</option>
                    <option value="Teknologi dan Informasi">Teknologi dan Informasi</option>
                    <option value="Inovasi">Inovasi</option>
                    <option value="Lain-lain">Lain-lain</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="target_triwulan_1">Target Rencana Aksi - Triwulan 1</label>
                <input type="text" id="target_triwulan_1" name="target_triwulan_1" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="target_triwulan_2">Target Rencana Aksi - Triwulan 2</label>
                <input type="text" id="target_triwulan_2" name="target_triwulan_2" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="target_triwulan_3">Target Rencana Aksi - Triwulan 3</label>
                <input type="text" id="target_triwulan_3" name="target_triwulan_3" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="target_triwulan_4">Target Rencana Aksi - Triwulan 4</label>
                <input type="text" id="target_triwulan_4" name="target_triwulan_4" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="target_total">Target Total</label>
                <input type="text" id="target_total" name="target_total" class="form-control">
            </div>

            <div class="form-group mb-4">
                <label>Indikator Minimum</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="indikator_minimum_rencana" id="indikator_minimum_ya_rencana" value="Ya">
                    <label class="form-check-label" for="indikator_minimum_ya_rencana">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="indikator_minimum_rencana" id="indikator_minimum_tidak_rencana" value="Tidak">
                    <label class="form-check-label" for="indikator_minimum_tidak_rencana">Tidak</label>
                </div>
            </div>

            <div class="form-group mb-4">
                <label>Konsolidasi</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="konsolidasi_rencana" id="konsolidasi_hasil_akhir_rencana" value="Hasil akhir">
                    <label class="form-check-label" for="konsolidasi_hasil_akhir_rencana">Hasil akhir</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="konsolidasi_rencana" id="konsolidasi_rata_rata_rencana" value="Rata-Rata">
                    <label class="form-check-label" for="konsolidasi_rata_rata_rencana">Rata-Rata</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="konsolidasi_rencana" id="konsolidasi_penjumlahan_rencana" value="Penjumlahan">
                    <label class="form-check-label" for="konsolidasi_penjumlahan_rencana">Penjumlahan</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Simpan dan Batal -->
    <div class="form-group mb-5">
        <button type="submit" class="btn btn-primary mr-3">Simpan</button>
        <button type="button" class="btn btn-secondary ml-3">Batal</button>
    </div>
</div>
@endsection
