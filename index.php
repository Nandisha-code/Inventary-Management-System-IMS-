<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-blue-700 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold mb-8">Inventory Manager</h1>
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="index.php" class="flex items-center p-2 rounded hover:bg-blue-600">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="products.php" class="flex items-center p-2 rounded hover:bg-blue-600">
                                <i class="fas fa-boxes mr-3"></i>
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="suppliers.php" class="flex items-center p-2 rounded hover:bg-blue-600">
                                <i class="fas fa-truck mr-3"></i>
                                Suppliers
                            </a>
                        </li>
                        <li>
                            <a href="orders.php" class="flex items-center p-2 rounded hover:bg-blue-600">
                                <i class="fas fa-clipboard-list mr-3"></i>
                                Orders
                            </a>
                        </li>
                        <li>
                            <a href="orders.php" class="flex items-center p-2 rounded hover:bg-blue-600">
                                <i class="fas fa-clipboard-list mr-3"></i>
                                Categories
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64 p-8">
            <header class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Dashboard Overview</h2>
                <p class="text-gray-600">Welcome back! Here's what's happening with your inventory.</p>
            </header>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="dashboard-card bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-boxes text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">Total Products</p>
                            <h3 class="text-2xl font-bold" id="totalProducts">0</h3>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <i class="fas fa-exclamation-triangle text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">Low Stock Items</p>
                            <h3 class="text-2xl font-bold" id="lowStockItems">0</h3>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-clipboard-list text-xl"></i>
                        </div>
                        <!-- Dashboard card for orders -->
                        <div class="bg-white shadow-md rounded p-6">
                            <h4 class="text-xl font-bold">Total Orders</h4>
                            <p id="orderCount" class="text-4xl text-blue-600 mt-2">0</p>
                        </div>

                    </div>
                </div>

                <div class="dashboard-card bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                            <i class="fas fa-truck text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">Active Suppliers</p>
                            <h3 class="text-2xl font-bold" id="activeSuppliers">0</h3>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-clipboard-list text-xl"></i>
                        </div>
                        <!-- Dashboard card for orders -->
                        <div class="bg-white shadow-md rounded p-6">
                            <h4 class="text-xl font-bold">Total Categories</h4>
                            <p id="orderCount" class="text-4xl text-blue-600 mt-2">0</p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">Recent Activity</h3>
                    <a href="#" class="text-blue-600 hover:underline">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="recentActivity">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="scripts.js"></script>
    <script>
        // Initialize dashboard data
        document.addEventListener('DOMContentLoaded', function() {
            // These functions will be defined in scripts.js
            updateDashboardStats();
            loadRecentActivity();
        });
    </script>
</body>
</html>