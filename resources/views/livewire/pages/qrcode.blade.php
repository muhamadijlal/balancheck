<div class="flex flex-col gap-16">
    @livewire('filter-form')

    <div class="flex flex-col items-center justify-center h-full md:h-[calc(100vh-22rem)] gap-5 mb-16">
        <div class="text-center">
            <!-- Wire loading state -->
            <div wire:loading class="text-center">
                <x-lucide-loader-circle class="inline-block animate-spin size-12 mb-8" />
                <h1 class="text-2xl font-bold">Loading...</h1>
                <div class="text-gray-500">Harap tunggu </div>
            </div>           
    
            <!-- Content displayed when loading is complete -->
            <div wire:loading.remove class="text-center">
                @if($data)
                    <!-- Show generated QR code or data -->
                    <div class="size-48 md:size-56 bg-cover mx-auto mb-8" style="background-image: url('{{ $data }}');"></div>
                    <h1 class="text-2xl font-bold">Scan QR Code</h1>
                    <p class="text-gray-500">QR Code akan hilang setelah {{ env("REFRESH_QRCODE_INTERVAL") }} detik.</p>
                @else
                    <!-- Default content when data is not available -->
                    <x-lucide-scan-qr-code class="size-28 md:size-56 text-gray-200 mx-auto mb-8" />
                    <h1 class="text-2xl font-bold">QR Code</h1>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Cek apakah listener sudah pernah dibuat
        if (!window.hasInitializedTimerListener) {
            window.hasInitializedTimerListener = true;

            const REFRESH_QRCODE_INTERVAL = {{ env('REFRESH_QRCODE_INTERVAL', 10) }};
            console.log('Interval:', REFRESH_QRCODE_INTERVAL);

            Livewire.on('start-timer', function() {
                console.log('Timer started...');

                setTimeout(function() {
                    console.log(REFRESH_QRCODE_INTERVAL + ' seconds passed, resetting data...');
                    Livewire.dispatch('resetData');
                }, REFRESH_QRCODE_INTERVAL * 1000);
            });
        }
    });
</script>
@endpush
