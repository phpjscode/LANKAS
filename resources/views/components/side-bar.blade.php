<div class="absolute top-0 left-0 w-full z-40 bg-white shadow-md">
    <div class="flex items-center justify-between px-4">
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
            type="button" class="inline-flex items-center p-2 my-2 text-sm text-gray-500 rounded-lg">
            <svg class="w-6 h-6 sm:hidden" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>

        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="inline-flex items-center p-2 my-2 ms-3 text-sm text-gray-500 rounded-lg" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#6B7280" class="w-6 h-6">
                <path
                    d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
            </svg>
        </button>
    </div>

    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
            <li class="flex items-center px-4 gap-x-1 hover:bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="h-6 w-6"
                    fill="#6B7280">
                    <path
                        d="M480-440q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0-80q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0 440q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-400Zm0-315-240 90v189q0 54 15 105t41 96q42-21 88-33t96-12q50 0 96 12t88 33q26-45 41-96t15-105v-189l-240-90Zm0 515q-36 0-70 8t-65 22q29 30 63 52t72 34q38-12 72-34t63-52q-31-14-65-22t-70-8Z" />
                </svg>
                <a href="{{ route('profile') }}" class="block py-2">Profile</a>
            </li>
            <li class="flex items-center px-4 gap-x-1 hover:bg-slate-100">
                <form action="{{ route('logout') }}" method="POST" class="flex items-center w-full">
                    @csrf
                    <button type="submit" class="flex items-center gap-x-1 w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"
                            class="h-6" fill="#6B7280">
                            <path
                                d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                        </svg>
                        <span class="block py-2">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <hr class="border-1 border">
</div>


<aside id="default-sidebar"
    class="fixed top-0 left-0 z-50 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-900">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('profile') }}" class="flex items-center p-2 text-white rounded-lg bg-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-5 h-5 text-white"
                        fill="#FFFFFF">
                        <path
                            d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z" />
                    </svg>
                    <span class="ms-3">
                        {{ Auth::user()->name ?? 'Guest' }}
                    </span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-white rounded-lg bg-green-500 group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-5 h-5 text-white"
                        fill="#FFFFFF">
                        <path
                            d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z" />
                    </svg>
                    <span class="ms-3">Sisa Uang: Rp4.000</span>
                </a>
            </li>
            <li>
                <a href="{{ route('index') }}" class="flex items-center p-2 text-white rounded-lg bg-blue-500 group">
                    <svg class="w-5 h-5 text-white transition duration-75" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
