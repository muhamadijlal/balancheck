<div class="flex flex-col gap-5">
    @livewire('filter-form')

    <div class="flex flex-col items-center justify-center h-full md:h-[calc(100vh-20rem)] gap-5 mt-24">
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
                    <p class="text-gray-500">Generate QR Code anda.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Get the current environment variable for REFRESH_QRCODE_INTERVAL
    const REFRESH_QRCODE_INTERVAL = {{ env('REFRESH_QRCODE_INTERVAL', 10) }}; // Default to 10 seconds if not set

    console.log(REFRESH_QRCODE_INTERVAL)

    // Listen for the 'start-timer' event triggered by Livewire
    Livewire.on('start-timer', function() {
        console.log('Timer started...'); // Debugging log to confirm it's firing

        // Set a timer to reset the data
        setTimeout(function() {
            console.log(REFRESH_QRCODE_INTERVAL+ ' seconds passed, resetting data...'); // Debugging log
            // Emit an event to Livewire to reset the data after the specified interval
            Livewire.dispatch('resetData');
        }, REFRESH_QRCODE_INTERVAL * 1000); // Convert seconds to milliseconds
    });
</script>
@endpush
