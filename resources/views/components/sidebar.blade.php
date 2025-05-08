<aside
    id="drawer-dashboard"
    aria-labelledby="drawer-dashboard"
    tabindex="-1"
    class="top-0 transition-transform h-screen fixed left-0 z-40 -translate-x-full lg:translate-x-0 w-64 bg-gray-100 overflow-y-auto">
    <div class="px-3 mt-4 flex-1 overflow-auto flex flex-col">
        <a href="{{ route('cms.dashboard') }}" wire:navigate>
            <div class="p-4 flex justify-center">
                <x-application-logo logo="{{ $configData->primary_logo ? asset($configData->primary_logo) : '' }}" />
            </div>
        </a>
        <div class="flex-1 flex flex-col space-y-2 overflow-y-auto mt-4 mb-20">
            <a href="{{ route('cms.dashboard') }}" wire:navigate>
                <button
                    type="button"
                    class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.dashboard') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                >
                    <span class="flex items-center">
                        <x-icon-grid class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-4 w-4"></x-icon-grid>
                        Dashboard
                    </span>
                </button>
            </a>
            @can('admin')
            <a href="{{ route('cms.home') }}" wire:navigate>
                <button
                    type="button"
                    class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.home') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                >
                    <span class="flex items-center">
                        <x-icon-home class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-4 w-4"></x-icon-home>
                        Payroll
                    </span>
                </button>
            </a>
            <a href="{{ route('cms.summary') }}" wire:navigate>
                <button
                    type="button"
                    class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.summary') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                >
                    <span class="flex items-center">
                        <x-icon-home class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-4 w-4"></x-icon-home>
                        Summary Monthly
                    </span>
                </button>
            </a>
            <button
                id="mess-sidebar-dropdown-button"
                data-collapse-toggle="mess-sidebar-dropdown-item"
                aria-controls="mess-sidebar-dropdown-item"
                type="button"
                class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.product.*') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
            >
                <x-icon-box-seam class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-4"></x-icon-box-seam>
                Mass upload
                <div class="w-auto flex justify-between items-center">
                    <span class="ml-3 text-sm"></span>
                    <x-icon-caret-down class="w-3.5 h-3.5"></x-icon-caret-down>
                </div>
            </button>
            <ul id="mess-sidebar-dropdown-item" class="{{ request()->routeIs('cms.product.*') ? '' : 'hidden' }} text-sm space-y-1" aria-labelledby="products-sidebar-dropdown-button">
                <li>
                    <a href="{{ route('cms.absent') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.absent') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Absent</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.lembur') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.lembur') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Overtime</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.makan') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.makan') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Meal</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.stand') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.stand') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Standby</span>
                        </button>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('cms.insentif') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.insentif') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Insentif Tomoro</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.retribution') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.retribution') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Retribution</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.bonus') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.bonus') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Bonuses/Penalty BBM</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.clean') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.clean') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Cleaning</span>
                        </button>
                    </a>        
                </li>
                <li>
                    <a href="{{ route('cms.denda') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.denda') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Bonuses/Penalty SLA</span>
                        </button>
                    </a>        
                </li>
              
                <li>
                    <a href="{{ route('cms.cutsalary') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.cutsalary') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Cut Salary</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.bpjs') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.bpjs') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> BPJS</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.previous') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.previous') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Difference Last Month</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.lainya') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.lainya') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                        <span class="ml-3 text-sm"> Others</span>
                        </button>   
                    </a>
                </li>
            </ul>
            {{-- <button
                id="products-sidebar-dropdown-button"
                data-collapse-toggle="products-sidebar-dropdown-item"
                aria-controls="products-sidebar-dropdown-item"
                type="button"
                class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.product.*') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
            >
                <x-icon-box-seam class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-4 w-4"></x-icon-box-seam>
                Products
                <div class="w-full flex justify-between items-center">
                    <span class="ml-3 text-sm"></span>
                    <x-icon-caret-down class="w-3.5 h-3.5"></x-icon-caret-down>
                </div>
            </button>
            <ul id="products-sidebar-dropdown-item" class="{{ request()->routeIs('cms.product.*') ? '' : 'hidden' }} text-sm space-y-1" aria-labelledby="products-sidebar-dropdown-button">
                <li>
                    <a href="{{ route('cms.product.index') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.product.index') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                            <span class="ml-3 text-sm">All Product</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.product.categories') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.product.categories') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                            <span class="ml-3 text-sm">Categories</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.product.subcategories') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.product.subcategories') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                            <span class="ml-3 text-sm">Subcategories</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.product.tags') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.product.tags') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                            <span class="ml-3 text-sm">Tags</span>
                        </button>
                    </a>
                </li>
            </ul>
            @endcan

            @canany(['admin', 'editor'])
            <button
                id="posts-sidebar-dropdown-button"
                data-collapse-toggle="posts-sidebar-dropdown-item"
                aria-controls="posts-sidebar-dropdown-item"
                type="button"
                class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.post.*') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
            >
                <x-icon-newspaper class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-4 w-4"></x-icon-newspaper>
                Posts
                <div class="w-full flex justify-between items-center">
                    <span class="ml-3 text-sm"></span>
                    <x-icon-caret-down class="w-3.5 h-3.5"></x-icon-caret-down>
                </div>
            </button>
            

            @can('admin')
            <button
                id="faqs-sidebar-dropdown-button"
                data-collapse-toggle="faqs-sidebar-dropdown-item"
                aria-controls="faqs-sidebar-dropdown-item"
                type="button"
                class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.faq.*') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
            >
                <x-icon-patch-question class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-4 w-4"></x-icon-patch-question>
                Faqs
                <div class="w-full flex justify-between items-center">
                    <span class="ml-3 text-sm"></span>
                    <x-icon-caret-down class="w-3.5 h-3.5"></x-icon-caret-down>
                </div>
            </button> --}}
            {{-- <ul id="faqs-sidebar-dropdown-item" class="{{ request()->routeIs('cms.faq.*') ? '' : 'hidden' }} text-sm space-y-1" aria-labelledby="faqs-sidebar-dropdown-button">
                <li>
                    <a href="{{ route('cms.faq.index') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.faq.index') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                            <span class="ml-3 text-sm">All Faq</span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.faq.categories') }}" wire:navigate>
                        <button
                            type="button"
                            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.faq.categories') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                        >
                            <span class="ml-3 text-sm">Categories</span>
                        </button>
                    </a>
                </li>
            </ul> --}}

            
        <button
            id="setting-sidebar-dropdown-button"
            data-collapse-toggle="setting-sidebar-dropdown-item"
            aria-controls="setting-sidebar-dropdown-item"
            type="button"
            class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.product.*') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
        >
        <x-icon-gear class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-4 w-4"></x-icon-gear>
            Setting
            <div class="w-auto flex justify-between items-center">
                <span class="ml-3 text-sm"></span>
                <x-icon-caret-down class="w-3.5 h-3.5"></x-icon-caret-down>
            </div>
        </button>
        <ul id="setting-sidebar-dropdown-item" class="{{ request()->routeIs('cms.product.*') ? '' : 'hidden' }} text-sm space-y-1" aria-labelledby="products-sidebar-dropdown-button">
            <li>
                <a href="{{ route('cms.vendor') }}" wire:navigate>
                    <button
                        type="button"
                        class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.vendor') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                    >
                        <span class="ml-3 text-sm">
                            {{-- <x-icon-gear class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-4 w-4"></x-icon-gear> --}}
                            Vendor
                        </span>
                    </button>
                </a>
            </li>
            <li>
                <a href="{{ route('cms.area') }}" wire:navigate>
                    <button
                        type="button"
                        class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.area') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                    >
                        <span class="ml-3 text-sm">
                            {{-- <x-icon-geo class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-4 w-4"></x-icon-geo> --}}
                            Area
                        </span>
                    </button>
                </a>
            </li>
            <li>
                <a href="{{ route('cms.employee') }}" wire:navigate>
                    <button
                        type="button"
                        class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.employee') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                    >
                        <span class="ml-3 text-sm">
                            {{-- <x-icon-robot class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-4 w-4"></x-icon-robot> --}}
                            Employee
                        </span>
                    </button>
                </a>
            </li>
        </ul>

            

            <a href="{{ route('cms.users') }}" wire:navigate>
                <button
                    type="button"
                    class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.users') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                >
                    <span class="flex items-center">
                        <x-icon-person class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-4 w-4"></x-icon-person>
                        Users
                    </span>
                </button>
            </a>
            <a href="{{ route('cms.configs') }}" wire:navigate>
                <button
                    type="button"
                    class="w-full flex items-center px-2 py-1.5 text-sm hover:text-gray-700 hover:font-bold hover:bg-indigo-100 rounded-md group {{ request()->routeIs('cms.configs') ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-700' }}"
                >
                    <span class="flex items-center">
                        <x-icon-gear class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-4 w-4"></x-icon-gear>
                        Configs
                    </span>
                </button>
            </a>
            @endcan
        </div>
    </div>
</aside>
