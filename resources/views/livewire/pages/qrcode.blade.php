<div class="flex flex-col gap-16 lg:gap-0" x-data="qrTimer({{ env('REFRESH_QRCODE_INTERVAL', 10) }})" x-init="init()">
    @livewire('filter-form')

    <div class="flex flex-col items-center justify-center h-full md:h-[calc(100vh-22rem)] gap-5 mb-16 lg:mb-0">
        <div class="text-center">
            <!-- Wire loading state -->
            <div wire:loading class="text-center">
                <x-lucide-loader-circle class="inline-block animate-spin size-12 mb-8" />
                <h1 class="text-2xl font-bold">Loading...</h1>
                <div class="text-gray-500">Harap tunggu</div>
            </div>           
    
            <!-- Content displayed when loading is complete -->
            <div wire:loading.remove class="text-center">
                @if($data)
                    @if($statusCode === 200)
                        <!-- Show generated QR code or data -->
                        <div class="size-48 md:size-56 mx-auto mb-8">
                            <img 
                                src="{{ $data }}" 
                                alt="QR Code"
                                class="w-full h-full object-cover rounded-xl"
                            />
                        </div>
                        
                        <h1 class="text-2xl font-bold">Scan QR Code</h1>
                        <p class="text-gray-500">
                            QR Code akan hilang setelah <span x-text="countdown"></span> detik.
                        </p>
                    @else
                        <!-- Show generated QR code or data -->
                        <div class="size-48 md:size-56 mx-auto mb-8">
                            <img 
                                src="{{ $data }}" 
                                alt="Fallback Image"
                                class="w-full h-full object-cover rounded-xl"
                            />
                        </div>
                        
                        <h1 class="text-2xl font-bold">Data gerbang tidak tersedia</h1>
                    @endif
                @else
                    <!-- Default content when data is not available -->
                    <x-lucide-qr-code class="size-28 md:size-56 text-gray-200 mx-auto mb-8" />
                    <h1 class="text-2xl font-bold">QR Code</h1>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function qrTimer(duration) {
        return {
            countdown: duration,
            interval: null,
            init() {
                const self = this;
                
                // Listen for Livewire event to start timer
                Livewire.on('start-timer', function () {
                    self.resetCountdown(); // reset timer
                    self.startCountdown(); // start timer
                });
            },
            startCountdown() {
                const self = this;
                self.interval = setInterval(function () {
                    if (self.countdown > 0) {
                        self.countdown--;
                    } else {
                        clearInterval(self.interval);
                        Livewire.dispatch('resetData'); // reset data when countdown finishes
                    }
                }, 1000);
            },
            resetCountdown() {
                clearInterval(this.interval);
                this.countdown = duration;
            }
        };
    }
</script>
@endpush
