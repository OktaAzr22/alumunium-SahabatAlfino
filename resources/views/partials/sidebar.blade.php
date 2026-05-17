<aside class="w-72 bg-white shadow-xl border-r border-gray-100 flex-shrink-0 flex flex-col h-full">

    <div class="px-6 py-7 flex items-center gap-3 border-b border-gray-100 bg-white sticky top-0 z-10">

        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-indigo-400 flex items-center justify-center shadow-md">
            <i class="fas fa-chart-line text-white text-xl"></i>
        </div>

        <div>
            <h1 class="text-xl font-bold text-gray-800 tracking-tight">
                Sahabat<span class="text-indigo-600">Alfino</span>
            </h1>

            <p class="text-xs text-gray-400 mt-0.5">
                Modern Management
            </p>
        </div>

    </div>

    <div class="sidebar-scrollable px-4 py-4">

        <nav class="space-y-1">

            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all
                {{ request()->routeIs('admin.dashboard')
                    ? 'bg-indigo-50'
                    : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700'
                }}"
            >

                <i class="fas fa-tachometer-alt w-5
                {{ request()->routeIs('admin.dashboard')
                    ? 'text-gray-900'
                    : 'text-gray-500'
                }}">
                </i>

                <span class="text-gray-500">
                    Dashboard
                </span>

            </a>

            @php

                $masterActive =
                    request()->routeIs('admin.products.*') ||
                    request()->routeIs('admin.materials.*') ||
                    request()->routeIs('admin.accessories.*');

            @endphp

            <div class="submenu-container">

                <button
                    class="submenu-toggle w-full flex items-center justify-between px-4 py-3 rounded-xl transition group
                    {{ $masterActive
                        ? 'bg-indigo-50'
                        : 'hover:bg-gray-50'
                    }}"
                >

                    <div class="flex items-center gap-3">

                        <i class="menu-icon fas fa-database w-5
                        {{ $masterActive
                            ? 'text-gray-900'
                            : 'text-gray-500'
                        }}">
                        </i>

                        <span class="menu-text text-gray-500">
                            Data Master
                        </span>

                    </div>

                    <i class="fas fa-chevron-down text-xs transition-transform duration-200 rotate-transition
                    {{ $masterActive
                        ? 'rotate-180 text-gray-900'
                        : 'text-gray-400'
                    }}">
                    </i>

                </button>

                <div class="submenu-content ml-6 mt-1 space-y-1 {{ $masterActive ? '' : 'hidden' }}">

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition pl-11
                        {{ request()->routeIs('admin.products.*')
                            ? 'bg-indigo-100 text-indigo-700'
                            : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600'
                        }}"
                    >

                        <i class="fas fa-box text-xs w-4"></i>

                        <span>
                            Data Product
                        </span>

                    </a>

                    <a
                        href="{{ route('admin.materials.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition pl-11
                        {{ request()->routeIs('admin.materials.*')
                            ? 'bg-indigo-100 text-indigo-700'
                            : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600'
                        }}"
                    >

                        <i class="fas fa-layer-group text-xs w-4"></i>

                        <span>
                            Data Material
                        </span>

                    </a>

                    <a
                        href="{{ route('admin.accessories.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition pl-11
                        {{ request()->routeIs('admin.accessories.*')
                            ? 'bg-indigo-100 text-indigo-700'
                            : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600'
                        }}"
                    >

                        <i class="fas fa-gem text-xs w-4"></i>

                        <span>
                            Data Aksesoris
                        </span>

                    </a>

                </div>

            </div>

            @php

                $orderActive =
                    request()->is('admin/orders*');

            @endphp

            <div class="submenu-container">

                <button
                    class="submenu-toggle w-full flex items-center justify-between px-4 py-3 rounded-xl transition group
                    {{ $orderActive
                        ? 'bg-indigo-50'
                        : 'hover:bg-gray-50'
                    }}"
                >

                    <div class="flex items-center gap-3">

                        <i class="menu-icon fas fa-shopping-cart w-5
                        {{ $orderActive
                            ? 'text-gray-900'
                            : 'text-gray-500'
                        }}">
                        </i>

                        <span class="menu-text text-gray-500">
                            Customer & Leads
                        </span>

                    </div>

                    <i class="fas fa-chevron-down text-xs transition-transform duration-200 rotate-transition
                    {{ $orderActive
                        ? 'rotate-180 text-gray-900'
                        : 'text-gray-400'
                    }}">
                    </i>

                </button>

                <div class="submenu-content ml-6 mt-1 space-y-1 {{ $orderActive ? '' : 'hidden' }}">

                    <a
                        href="{{ url('/admin/orders') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition pl-11
                        {{ request()->is('admin/orders*')
                            ? 'bg-indigo-100 text-indigo-700'
                            : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600'
                        }}"
                    >

                        <i class="fas fa-tag text-xs w-4"></i>

                        <span>
                            Order
                        </span>

                    </a>

                </div>

            </div>

            <a
                href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition"
            >

                <i class="fas fa-cog w-5"></i>

                <span>
                    Settings
                </span>

            </a>

            <a
                href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition"
            >

                <i class="fas fa-question-circle w-5"></i>

                <span>
                    Help Center
                </span>

            </a>

        </nav>

    </div>

    <div class="p-4 border-t border-gray-100 bg-white sticky bottom-0 z-10">

        <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-xl">

            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-semibold shadow-sm">

                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

            </div>

            <div class="flex-1">

                <p class="text-sm font-semibold text-gray-800">
                    {{ Auth::user()->name }}
                </p>

                <p class="text-xs text-gray-500">
                    {{ Auth::user()->email }}
                </p>

            </div>

            <form action="{{ url('/logout') }}" method="POST">

                @csrf

                <button type="submit">
                    <i class="fas fa-sign-out-alt text-gray-400 hover:text-red-500 transition"></i>
                </button>

            </form>

        </div>

    </div>

</aside>