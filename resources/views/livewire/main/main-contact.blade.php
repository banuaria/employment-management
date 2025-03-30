<div>
    <div class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-5 mx-auto max-w-screen-xl">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Get In Touch!</h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Tell us what you think about our products. Your thoughts help us to improve our service better</p>
            
            @if ($submitted)
                <div class="bg-gray-10 text-center text-lg font-semibold text-green-500 p-10">
                    Thank you for your message! We will get back to you soon.
                </div>
            @else
                <form wire:submit.prevent="submit" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Name</label>
                            <input type="text" id="name" wire:model.defer="name" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="" required>
                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                            <input type="email" id="email" wire:model.defer="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="" required>
                            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Phone</label>
                            <input type="number" id="phone" wire:model.defer="phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="" required>
                            @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
                            <input type="text" id="subject" wire:model.defer="subject" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="" required>
                            @error('subject') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Message</label>
                        <textarea id="message" rows="6" wire:model.defer="message" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=""></textarea>
                        @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div id="recaptchaToken" data-sitekey="{{ config('app.recaptcha_site_key') }}" wire:ignore></div>
                    @error('recaptchaToken') <span class="text-red-500">{{ $message }}</span> @enderror
                    <x-primary-button :outline="true">SUBMIT</x-primary-button>
                </form>
            @endif
        </div>
    </div>
    <div class="bg-gray-200">
        <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 space-x-6 md:space-x-6 px-5 py-12 mx-auto max-w-screen-xl">
            <div class="map-container flex-1">
                <!-- Google Maps Embed -->
                @if($configData->google_map_tag)
                    {!! $configData->google_map_tag !!}
                @endif
            </div>
            <div class="info-container flex-1">
                <!-- Company Information -->
                <h2 class="text-2xl font-bold mb-4">Our Company</h2>
                @if($configData->company_name)
                <p class="font-bold mb-2">{{ $configData->company_name }}</p>
                @endif
                @if($configData->address)
                <p class="mb-2">{{ $configData->address }}</p>
                @endif
                @if($configData->phone)
                <p class="mb-2">Phone: <a class="hover:text-primary-500" href="tel:{{ $configData->phone }}">{{ $configData->phone }}</a></p>
                @endif
                @if($configData->email)
                <p class="mb-2">Email: <a class="hover:text-primary-500" href="mailto:{{ $configData->email }}">{{ $configData->email }}</a></p>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js?onload=handle&render=explicit"
    async
    defer>
</script>
<script>
    var  handle = function(e) {
        widget = grecaptcha.render('recaptchaToken', {
            'sitekey': '{{ config('app.recaptcha_site_key') }}',
            'theme': 'light',
            'callback': verify
        });
 
    }
    var verify = function (response) {
        @this.set('recaptchaToken', response)
    }
</script>