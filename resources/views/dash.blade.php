<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-white shadow-md hidden md:block">
        <div class="p-6 text-xl font-bold text-gray-700 border-b">Dashboard</div>
        <nav class="p-6">
            <ul class="space-y-4">
                <li><a href="#" class="text-gray-600 hover:text-blue-500">Overview</a></li>
                <li><a href="{{ route('admin.patients') }}" class="text-gray-600 hover:text-blue-500">Patients</a></li>
                <li><a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-blue-500">Users</a></li>
                <li><a href="#" class="text-gray-600 hover:text-blue-500">Settings</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main content wrapper -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">

        <!-- Header -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->name }}</h1>

            <div class="flex items-center gap-4">
                <!--<span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>-->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline">Logout</button>
                </form>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center space-x-4">
                        <div class="text-blue-500 text-3xl">👥</div>
                        <div>
                            <p class="text-sm text-gray-500">Total Patients</p>
                            <p class="text-xl font-bold">{{ $totalPatients }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center space-x-4">
                        <div class="text-green-500 text-3xl">✅</div>
                        <div>
                            <p class="text-sm text-gray-500">No Coronary Disease</p>
                            <p class="text-xl font-bold">{{ $coronaryNegative }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center space-x-4">
                        <div class="text-red-500 text-3xl">❌</div>
                        <div>
                            <p class="text-sm text-gray-500">Coronary Disease</p>
                            <p class="text-xl font-bold">{{ $coronaryPositive }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center space-x-4">
                        <div class="text-purple-500 text-3xl">👤</div>
                        <div>
                            <p class="text-sm text-gray-500">Users</p>
                            <p class="text-xl font-bold">{{ $userCount }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Age Distribution</h2>
                    <canvas id="ageChart" class="w-full h-64"></canvas>
                    <div id="ageDebugOutput" class="text-red-500 text-sm mt-2 text-center"></div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Coronary Disease Distribution</h2>
                    <canvas id="coroChart" class="w-full h-64"></canvas>
                    <div id="coroDebugOutput" class="text-red-500 text-sm mt-2 text-center"></div>
                </div>
            </div>
        </main>
    </div>

    <!-- Chart.js Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ageCtx = document.getElementById('ageChart').getContext('2d');
            const ageBins = JSON.parse(`{!! $ageBinsJson !!}`);
            if (!ageBins || Object.keys(ageBins).length === 0) {
                document.getElementById('ageDebugOutput').textContent = 'No age data available.';
            } else {
                new Chart(ageCtx, {
                    type: 'bar',
                    data: {
                        labels: ['21-40', '41-60', '61-80', '81+'],
                        datasets: [{
                            label: 'Number of Patients',
                            data: [
                                ageBins['21-40'] || 0,
                                ageBins['41-60'] || 0,
                                ageBins['61-80'] || 0,
                                ageBins['81+'] || 0
                            ],
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Patients'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Age Range'
                                }
                            }
                        }
                    }
                });
            }

            const coroCtx = document.getElementById('coroChart').getContext('2d');
            const coroResults = JSON.parse(`{!! $coroResultsJson !!}`);
            if (!coroResults || (coroResults['No Coronary Disease (0)'] === 0 && coroResults['Coronary Disease (1)'] === 0)) {
                document.getElementById('coroDebugOutput').textContent = 'No coronary data available.';
            } else {
                new Chart(coroCtx, {
                    type: 'pie',
                    data: {
                        labels: ['No Coronary Disease (0)', 'Coronary Disease (1)'],
                        datasets: [{
                            data: [
                                coroResults['No Coronary Disease (0)'] || 0,
                                coroResults['Coronary Disease (1)'] || 0
                            ],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(255, 99, 132, 0.6)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
        });
    </script>

</body>

</html>