<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
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
                        <li><a href="index.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a></li>
                        <li><a href="products.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-boxes mr-3"></i>Products</a></li>
                        <li><a href="suppliers.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-truck mr-3"></i>Suppliers</a></li>
                        <li><a href="orders.php" class="flex items-center p-2 rounded bg-blue-800"><i class="fas fa-clipboard-list mr-3"></i>Orders</a></li>
<li><a href="categories.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-tags mr-3"></i>Categories</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64 p-8">
            <header class="mb-8 flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Order Management</h2>
                    <p class="text-gray-600">Create, edit, and manage orders</p>
                </div>
                <button id="addOrderBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Create Order
                </button>
            </header>

            <!-- Order Form -->
            <div id="orderFormContainer" class="hidden bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-xl font-semibold mb-4" id="orderFormTitle">New Order</h3>
                <form id="orderForm">
                    <input type="hidden" id="orderId">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="productName" class="block text-sm font-medium text-gray-700 mb-1">Product Name*</label>
                            <input type="text" id="productName" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity*</label>
                            <input type="number" id="quantity" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="supplier" class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                            <input type="text" id="supplier" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="Pending">Pending</option>
                                <option value="Delivered">Delivered</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" id="cancelOrderBtn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save Order</button>
                    </div>
                </form>
            </div>

            <!-- Search & Filter -->
            <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0 md:w-1/3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" id="orderSearch" placeholder="Search orders..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <label for="ordersPerPage" class="text-sm text-gray-700">Items per page:</label>
                        <select id="ordersPerPage" class="border border-gray-300 rounded-md px-2 py-1 text-sm">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Supplier</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="ordersTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Filled by JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing <span id="startOrderItem">1</span> to <span id="endOrderItem">10</span> of <span id="totalOrders">0</span> orders
                    </div>
                    <div class="flex space-x-2">
                        <button id="prevOrderPage" class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 disabled:opacity-50">Previous</button>
                        <button id="nextOrderPage" class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 disabled:opacity-50">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Logic -->
    <script>
        let currentOrderPage = 1, totalOrderPages = 1;

        document.addEventListener('DOMContentLoaded', () => {
            loadOrders();

            document.getElementById('addOrderBtn').onclick = () => {
                document.getElementById('orderForm').reset();
                document.getElementById('orderId').value = '';
                document.getElementById('orderFormTitle').textContent = 'New Order';
                document.getElementById('orderFormContainer').classList.remove('hidden');
            };

            document.getElementById('cancelOrderBtn').onclick = () => {
                document.getElementById('orderFormContainer').classList.add('hidden');
            };

            document.getElementById('orderForm').onsubmit = e => {
                e.preventDefault();
                saveOrder();
            };

            document.getElementById('orderSearch').oninput = () => loadOrders();
            document.getElementById('ordersPerPage').onchange = () => {
                currentOrderPage = 1;
                loadOrders();
            };

            document.getElementById('prevOrderPage').onclick = () => {
                if (currentOrderPage > 1) currentOrderPage--;
                loadOrders();
            };

            document.getElementById('nextOrderPage').onclick = () => {
                if (currentOrderPage < totalOrderPages) currentOrderPage++;
                loadOrders();
            };
        });

        function loadOrders() {
            const orders = getData('orders');
            const search = document.getElementById('orderSearch').value.toLowerCase();
            const perPage = parseInt(document.getElementById('ordersPerPage').value);

            const filtered = orders.filter(o =>
                o.product.toLowerCase().includes(search) ||
                o.supplier.toLowerCase().includes(search)
            );

            const total = filtered.length;
            totalOrderPages = Math.ceil(total / perPage);
            const start = (currentOrderPage - 1) * perPage;
            const end = Math.min(start + perPage, total);

            const paginated = filtered.slice(start, end);
            const tbody = document.getElementById('ordersTableBody');
            tbody.innerHTML = paginated.map(o => `
                <tr>
                    <td class="px-6 py-4">${o.product}</td>
                    <td class="px-6 py-4">${o.quantity}</td>
                    <td class="px-6 py-4">${o.supplier}</td>
                    <td class="px-6 py-4">${o.status}</td>
                    <td class="px-6 py-4">
                        <button onclick="editOrder('${o.id}')" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></button>
                        <button onclick="deleteOrder('${o.id}')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `).join('');

            document.getElementById('startOrderItem').textContent = start + 1;
            document.getElementById('endOrderItem').textContent = end;
            document.getElementById('totalOrders').textContent = total;

            document.getElementById('prevOrderPage').disabled = currentOrderPage === 1;
            document.getElementById('nextOrderPage').disabled = currentOrderPage === totalOrderPages;
        }

        function saveOrder() {
            const id = document.getElementById('orderId').value;
            const product = document.getElementById('productName').value;
            const quantity = document.getElementById('quantity').value;
            const supplier = document.getElementById('supplier').value;
            const status = document.getElementById('status').value;
            let orders = getData('orders');

            if (id) {
                const index = orders.findIndex(o => o.id === id);
                if (index !== -1) orders[index] = { id, product, quantity, supplier, status };
            } else {
                orders.push({ id: generateId(), product, quantity, supplier, status });
            }

            saveData('orders', orders);
            loadOrders();
            document.getElementById('orderFormContainer').classList.add('hidden');
            showAlert('Order saved successfully!');
        }

        function editOrder(id) {
            const order = getData('orders').find(o => o.id === id);
            if (!order) return;

            document.getElementById('orderId').value = order.id;
            document.getElementById('productName').value = order.product;
            document.getElementById('quantity').value = order.quantity;
            document.getElementById('supplier').value = order.supplier;
            document.getElementById('status').value = order.status;
            document.getElementById('orderFormTitle').textContent = 'Edit Order';
            document.getElementById('orderFormContainer').classList.remove('hidden');
        }

        function deleteOrder(id) {
            if (!confirm('Are you sure you want to delete this order?')) return;
            let orders = getData('orders').filter(o => o.id !== id);
            saveData('orders', orders);
            loadOrders();
            showAlert('Order deleted successfully!', 'success');
        }

        function getData(key) {
            return JSON.parse(localStorage.getItem(key)) || [];
        }

        function saveData(key, data) {
            localStorage.setItem(key, JSON.stringify(data));
        }

        function generateId() {
            return '_' + Math.random().toString(36).substr(2, 9);
        }

        function showAlert(message, type = 'success') {
            const alert = document.createElement('div');
            alert.className = `fixed top-4 right-4 px-4 py-2 rounded-md text-white shadow-md ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            alert.textContent = message;
            document.body.appendChild(alert);
            setTimeout(() => alert.remove(), 3000);
        }
    </script>
</body>
</html>
