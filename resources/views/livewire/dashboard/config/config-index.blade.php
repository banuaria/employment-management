<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
            <div class="grid gap-4 auto-rows-min">
                <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-base text-gray-900">Logo</h2>
                        <button wire:click="$dispatchTo('dashboard.config.config-edit-logo', 'edited')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Primary Logo')" />
                        <div class="flex flex-col justify-center items-center mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">
                            <x-application-logo logo="{{ $config->primary_logo ? asset($config->primary_logo) : '' }}" />
                            <a href={{ asset($config->primary_logo) }} target="_blank" class="mt-1 text-sm text-blue-500">
                                {{ $config->primary_logo }}
                            </a>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Secondary Logo')" />
                        <div class="flex flex-col justify-center items-center mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">
                            <x-application-logo logo="{{ $config->secondary_logo ? asset($config->secondary_logo) : '' }}" />
                            <a href={{ asset($config->secondary_logo) }} target="_blank" class="mt-1 text-sm text-blue-500">
                                {{ $config->secondary_logo }}
                            </a>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Favicon')" />
                        <div class="flex flex-col justify-center items-center mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">
                            <img src="{{ $config->favicon ? asset($config->favicon) : asset('images/default/favicon.png') }}" class="h-8">
                            <a href={{ asset($config->favicon) }} target="_blank" class="mt-1 text-sm text-blue-500">
                                {{ $config->favicon }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-base text-gray-900">Page Cover</h2>
                        <button wire:click="$dispatchTo('dashboard.config.config-edit-cover', 'edited')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Cover About')" />
                        <div class="flex flex-col justify-center items-center mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">
                            @if ($config->cover_about)
                            <div class="relative w-full h-auto max-w-md">
                                <img src="{{ asset($config->cover_about) }}" class="w-full h-full object-cover" />
                            </div>
                            <a href={{ asset($config->cover_about) }} target="_blank" class="mt-1 text-sm text-blue-500">
                                {{ $config->cover_about }}
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Cover Product')" />
                        <div class="flex flex-col justify-center items-center mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">
                            @if ($config->cover_product)
                            <div class="relative w-full h-auto max-w-md">
                                <img src="{{ asset($config->cover_product) }}" class="w-full h-full object-cover" />
                            </div>
                            <a href={{ asset($config->cover_product) }} target="_blank" class="mt-1 text-sm text-blue-500">
                                {{ $config->cover_product }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-base text-gray-900">Social Media</h2>
                        <button wire:click="$dispatchTo('dashboard.config.config-edit-social-media', 'edited')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Instagram')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->instagram }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Facebook')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->facebook }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('X')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->x }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('LinkedIn')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->linkedin }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Youtube')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->youtube }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Tiktok')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->tiktok }}</div>
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-base text-gray-900">Whatsapp</h2>
                        <button wire:click="$dispatchTo('dashboard.config.config-edit-whatsapp', 'edited')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Whatsapp Phone')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->whatsapp_phone }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Whatsapp Message')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->whatsapp_message }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Whatsapp Float')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->whatsapp_float ? 'true' : 'false' }}</div>
                    </div>
                </div>
            </div>
            <div class="grid gap-4 auto-rows-min">
                <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-base text-gray-900">Company Info</h2>
                        <button wire:click="$dispatchTo('dashboard.config.config-edit-company-info', 'edited')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Company Name')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->company_name }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Address')" />
                        <div class="block mt-2 w-full border-gray-200 rounded-md shadow-sm p-2.5 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->address }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Email')" />
                        <div class="block mt-2 w-full border-gray-200 rounded-md shadow-sm p-2.5 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->email }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Phone')" />
                        <div class="block mt-2 w-full border-gray-200 rounded-md shadow-sm p-2.5 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->phone }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Mobile')" />
                        <div class="block mt-2 w-full border-gray-200 rounded-md shadow-sm p-2.5 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->mobile }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Fax')" />
                        <div class="block mt-2 w-full border-gray-200 rounded-md shadow-sm p-2.5 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->fax }}</div>
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-base text-gray-900">Meta SEO</h2>
                        <button wire:click="$dispatchTo('dashboard.config.config-edit-meta-seo', 'edited')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Meta Title')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->meta_title }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Meta Description')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->meta_desc }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Meta Keywords')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->meta_keywords }}</div>
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-base text-gray-900">Integration (GTM, Google Analytics, etc)</h2>
                        <button wire:click="$dispatchTo('dashboard.config.config-edit-integration', 'edited')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Head Tag')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->head_tag }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Body Tag')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->body_tag }}</div>
                    </div>
                    <div class="mt-4">
                        <x-input-label :value="__('Google Map Tag')" />
                        <div class="block mt-1 w-full border-gray-200 rounded-md shadow-sm p-2 border text-gray-900 bg-gray-50 break-anywhere">{{ $config->google_map_tag }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="edit-logo-config-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit Config Logo
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-logo-config-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.config.config-edit-logo @configLogoEdited="$refresh" />
        </div>
    </x-modal>

    <x-modal name="edit-cover-config-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit Config Cover
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-cover-config-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.config.config-edit-cover @configCoverEdited="$refresh" />
        </div>
    </x-modal>

    <x-modal name="edit-social-media-config-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit Config Social Media
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-social-media-config-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.config.config-edit-social-media @configSocialMediaEdited="$refresh" />
        </div>
    </x-modal>

    <x-modal name="edit-whatsapp-config-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit Config Whatsapp
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-whatsapp-config-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.config.config-edit-whatsapp @configWhatsappEdited="$refresh" />
        </div>
    </x-modal>

    <x-modal name="edit-company-info-config-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit Config Company Info
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-company-info-config-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.config.config-edit-company-info @configCompanyInfoEdited="$refresh" />
        </div>
    </x-modal>

    <x-modal name="edit-meta-seo-config-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit Config Meta SEO
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-meta-seo-config-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.config.config-edit-meta-seo @configMetaSeoEdited="$refresh" />
        </div>
    </x-modal>

    <x-modal name="edit-integration-config-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit Config Integration
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-integration-config-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.config.config-edit-integration @configIntegrationEdited="$refresh" />
        </div>
    </x-modal>
</div>
