<!-- resources/views/admin/dashboard.blade.php -->
<x-admin-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-2xl font-semibold mb-6">Dashboard</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Active Users Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4c-4.42 0-8 3.58-8 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Active Users</h3>
                            <p class="text-3xl font-bold">{{ $stats['active_users'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Chirps Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Total Chirps</h3>
                            <p class="text-3xl font-bold">{{ $stats['total_chirps'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Reports Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Total Reports</h3>
                            <p class="text-3xl font-bold">{{ $stats['total_reports'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Time Filter -->
            <div class="mt-8">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="flex space-x-4">
                    <select name="timeframe" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="daily" {{ request('timeframe') == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ request('timeframe') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ request('timeframe') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Filter
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
