<x-nav-link :href="route('dashboard.api-keys')" :active="request()->routeIs('dashboard.api-keys')">
    {{ __('API Keys') }}
</x-nav-link>