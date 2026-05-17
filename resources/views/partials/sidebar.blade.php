          <aside class="w-72 bg-white shadow-xl border-r border-gray-100 flex-shrink-0 flex flex-col h-full">
            <!-- Logo Area - FIXED / STICKY (tidak ikut scroll) -->
            <div class="px-6 py-7 flex items-center gap-3 border-b border-gray-100 bg-white sticky top-0 z-10">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-indigo-400 flex items-center justify-center shadow-md">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800 tracking-tight">Sahabat<span class="text-indigo-600">Alfino</span></h1>
                    <p class="text-xs text-gray-400 mt-0.5">Modern Management</p>
                </div>
            </div>
            
            <!-- Scrollable Menu Area (hanya bagian menu yang bisa di-scroll) -->
            <div class="sidebar-scrollable px-4 py-4">
                <nav class="space-y-1">
                    <!-- Dashboard (single) -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-indigo-50 text-indigo-700 font-medium transition-all">
                        <i class="fas fa-tachometer-alt w-5 text-indigo-600"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <!-- Submenu: Manajemen Data -->
                    <div class="submenu-container">
                        <button class="submenu-toggle w-full flex items-center justify-between px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition group">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-database w-5"></i>
                                <span>Data Master</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 rotate-transition"></i>
                        </button>
                        <div class="submenu-content ml-6 mt-1 space-y-1 hidden">
                            <a href="/admin/products" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-indigo-600 transition pl-11">
                                <i class="fas fa-users text-xs w-4"></i>
                                <span>Data Product</span>
                            </a>
                            <a href="/admin/materials" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-indigo-600 transition pl-11">
                                <i class="fas fa-chart-line text-xs w-4"></i>
                                <span>Data Material</span>
                            </a>
                            <a href="/admin/accesories" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-indigo-600 transition pl-11">
                                <i class="fas fa-box text-xs w-4"></i>
                                <span>Data Aksesoris</span>
                            </a>
                        </div>
                    </div>

                    <!-- Submenu: Customers & Leads -->
                    <div class="submenu-container">
                        <button class="submenu-toggle w-full flex items-center justify-between px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition group">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-user-friends w-5"></i>
                                <span>Customer & Leads</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 rotate-transition"></i>
                        </button>
                        <div class="submenu-content ml-6 mt-1 space-y-1 hidden">
                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-indigo-600 transition pl-11">
                                <i class="fas fa-user-plus text-xs w-4"></i>
                                <span>Semua Customer</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-indigo-600 transition pl-11">
                                <i class="fas fa-tag text-xs w-4"></i>
                                <span>Order</span>
                            </a>
                            
                            
                        </div>
                    </div>

                    

                    

                    <!-- Settings (single) -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition">
                        <i class="fas fa-cog w-5"></i>
                        <span>Settings</span>
                    </a>

                    <!-- Help (single) -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition">
                        <i class="fas fa-question-circle w-5"></i>
                        <span>Help Center</span>
                    </a>

                    
                    
                    

                    <!-- Tambahan item biar scroll terlihat -->
                    <div class="pt-2 pb-4">
                        <div class="h-px bg-gray-100 my-2"></div>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 text-sm hover:bg-gray-50 transition">
                            <i class="fas fa-shield-alt w-5"></i>
                            <span>Security Center</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 text-sm hover:bg-gray-50 transition">
                            <i class="fas fa-life-ring w-5"></i>
                            <span>Support</span>
                        </a>
                    </div>
                </nav>
            </div>
            
            <!-- User Profile Bottom - FIXED / STICKY (tidak ikut scroll) -->
            <div class="p-4 border-t border-gray-100 bg-white sticky bottom-0 z-10">
                <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-xl">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-semibold shadow-sm">
                        AD
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800">Alex Darmawan</p>
                        <p class="text-xs text-gray-500">admin@saas.com</p>
                    </div>
                    <i class="fas fa-sign-out-alt text-gray-400 hover:text-gray-600 cursor-pointer"></i>
                </div>
            </div>
        </aside>