<nav class="p-2 flex md:w-[60%] w-full justify-between items-center bg-gray-200 md:left-1/2 md:-translate-x-1/2 fixed md:rounded-full z-50 md:top-4 top-0 drop-shadow-2xl">
    <div class="lg:mx-4 mx-1 p-2">
        <a href="/main" class="p-2 text-lg text-black lg:mx-5 mx-1 text-center"><i class="ph ph-house"></i> Home</a>
        <a href="" class="p-2 text-lg text-black lg:mx-5 mx-1"><i class="ph ph-trend-up"></i> Trending</a>
        <a href="" class="p-2 text-lg text-black lg:mx-5 mx-1"><i class="ph ph-network"></i> Category</a>
        <a href="/main/create" class="p-2 text-lg text-black lg:mx-5 mx-1"><i class="ph ph-pen"></i> Create</a>
    </div>
    <div class="relative md:inline-block text-left hidden">
        <div class="rounded-[50%] overflow-hidden h-12 w-12 relative border border-black flex justify-center content-center     ">
            <button type="button" class="" onclick="menuDropdown()" id="menu-button" aria-expanded="true" aria-haspopup="true">
                <img class="w-full h-full object-cover object-center" src="https://placehold.jp/150x150.png" alt="Profile Picture">
            </button>
        </div>
        <div class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" id="dropdown">
            <div class="py-1" role="none">
                <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                <a href="/main/profile" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Profile settings</a>
                <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Support</a>
                <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
                <a href="/logout.php" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">Sign out</a>
            </div>
        </div>
    </div>
</nav>
<script src="https://unpkg.com/@phosphor-icons/web"></script>
<script>
    const menuDropdown = () => {
        const navDrop = document.getElementById('dropdown');
        navDrop.classList.toggle('hidden')
    }
</script>