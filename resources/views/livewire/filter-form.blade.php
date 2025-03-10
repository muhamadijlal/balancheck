<form wire:submit.prevent="submitFilter" class="grid grid-cols-1 lg:grid-cols-6 gap-3">
    <div class="lg:col-span-2 w-full">
        <div wire:ignore>
            <x-select wire:model="cluster" id="select-cluster" class="w-full"></x-select>
        </div>
        @error("cluster") <span class="text-red-500 mt-3 text-sm">{{ __($message) }}</span> @enderror
    </div>

    <div class="lg:col-span-2 lg:col-start-3 w-full">
        <div wire:ignore>
            <x-select wire:model="ruas" id="select-ruas" disabled="true" class="w-full"></x-select>
        </div>
        @error("ruas") <span class="text-red-500 mt-3 text-sm">{{ __($message) }}</span> @enderror
    </div>

    <div class="lg:col-span-2 lg:col-start-5 w-full">
        <div wire:ignore>
            <x-select wire:model="gerbang" id="select-gerbang" disabled="true" class="w-full"></x-select>
        </div>
        @error("gerbang") <span class="text-red-500 mt-3 text-sm">{{ __($message) }}</span> @enderror
    </div>

    <div class="lg:col-span-6 w-full">
        <x-button type="submit" class="font-bold text-md text-center w-full">
            <x-lucide-mouse-pointer-click class="size-7 mr-3" />
            Generate QR Code
        </x-button>
    </div>
</form>

@push('scripts')
<script>
    $(document).ready(function() {
        let defaultCluster = [{ id: '', text: '' }];
        let defaultRuas = [{ id: '', text: '' }];
        let defaultGerbang = [{ id: '', text: '' }];
    
        // Inisialisasi Select2 untuk Cluster
        $("#select-cluster").select2({
            placeholder: "-- Pilih Cluster --",
            data: defaultCluster,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('selectCluster') }}",
                type: 'POST',
                dataType: 'json',
                data: function (params) {
                    return {
                        query: params.term,
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.value,
                                text: item.label
                            };
                        })
                    };
                },
                beforeSend: function() {
                    $("#select-ruas").attr("disabled", true);
                    $("#select-gerbang").attr("disabled", true);
                }
            }
        });

        // Inisialisasi Select2 untuk Ruas
        $("#select-ruas").select2({
            placeholder: "-- Pilih Ruas --",
            data: defaultRuas,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('selectRuas') }}",
                type: 'POST',
                dataType: 'json',
                data: function (params) {
                    return {
                        query: params.term,
                        clusterId: $("#select-cluster").val()
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.value,
                                text: item.label
                            };
                        })
                    };
                },
                beforeSend: function() {
                    $("#select-gerbang").attr("disabled", true);
                }
            }
        });

        // Inisialisasi Select2 untuk Gerbang
        $("#select-gerbang").select2({
            placeholder: "-- Pilih Gerbang --",
            data: defaultGerbang,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('selectGerbang') }}",
                type: 'POST',
                dataType: 'json',
                data: function (params) {
                    return {
                        query: params.term,
                        clusterId: $("#select-cluster").val(),
                        ruasId: $("#select-ruas").val()
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.value,
                                text: item.label
                            };
                        })
                    };
                }
            }
        });
    });

    // Event handler untuk perubahan nilai Cluster
    $("#select-cluster").on('change', function(e) {
        $("#select-ruas").attr("disabled", false);
        @this.set('cluster', e.target.value);
    });

    // Event handler untuk perubahan nilai Ruas
    $("#select-ruas").on('change', function(e) {
        $("#select-gerbang").attr("disabled", false);
        @this.set('ruas', e.target.value);
    });

    // Event handler untuk perubahan nilai Gerbang
    $("#select-gerbang").on('change', function(e) {
        @this.set('gerbang', e.target.value);
    });
</script>
@endpush