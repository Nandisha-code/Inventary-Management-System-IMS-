<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .supplier-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
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
                        <li><a href="index.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a></li>
                        <li><a href="products.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-boxes mr-3"></i>Products</a></li>
                        <li><a href="suppliers.php" class="flex items-center p-2 rounded bg-blue-800"><i class="fas fa-truck mr-3"></i>Suppliers</a></li>
                        <li><a href="orders.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-clipboard-list mr-3"></i>Orders</a></li>
                        <li><a href="orders.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-clipboard-list mr-3"></i>Categories</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64 p-8">
            <header class="mb-8 flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Supplier Management</h2>
                    <p class="text-gray-600">Add, edit, and manage your suppliers</p>
                </div>
                <button id="addSupplierBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Add Supplier
                </button>
            </header>

            <!-- Supplier Form -->
            <div id="supplierFormContainer" class="hidden bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-xl font-semibold mb-4" id="formTitle">Add New Supplier</h3>
                <form id="supplierForm">
                    <input type="hidden" id="supplierId">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="supplierName" class="block text-sm font-medium text-gray-700 mb-1">Supplier Name*</label>
                            <input type="text" id="supplierName" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact*</label>
                            <input type="text" id="contact" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address*</label>
                            <input type="text" id="address" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label for="supplierImage" class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                            <input type="text" id="supplierImage" placeholder="https://images.pexels.com/photo.jpg" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" id="cancelBtn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save Supplier</button>
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
                            <input type="text" id="search" placeholder="Search suppliers..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <label for="itemsPerPage" class="text-sm text-gray-700">Items per page:</label>
                        <select id="itemsPerPage" class="border border-gray-300 rounded-md px-2 py-1 text-sm focus:ring-blue-500">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Suppliers Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="suppliersTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Filled by JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing <span id="startItem">1</span> to <span id="endItem">10</span> of <span id="totalItems">0</span> suppliers
                    </div>
                    <div class="flex space-x-2">
                        <button id="prevPage" class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 disabled:opacity-50">Previous</button>
                        <button id="nextPage" class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 disabled:opacity-50">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Script -->
    <script>
        let currentPage = 1;
        let totalPages = 1;

        document.addEventListener('DOMContentLoaded', function () {
            loadSuppliers();

            document.getElementById('addSupplierBtn').addEventListener('click', () => {
                document.getElementById('supplierForm').reset();
                document.getElementById('supplierId').value = '';
                document.getElementById('formTitle').textContent = 'Add New Supplier';
                document.getElementById('supplierFormContainer').classList.remove('hidden');
            });

            document.getElementById('cancelBtn').addEventListener('click', () => {
                document.getElementById('supplierFormContainer').classList.add('hidden');
            });

            document.getElementById('supplierForm').addEventListener('submit', function (e) {
                e.preventDefault();
                saveSupplier();
            });

            document.getElementById('search').addEventListener('input', () => loadSuppliers());
            document.getElementById('itemsPerPage').addEventListener('change', () => {
                currentPage = 1;
                loadSuppliers();
            });

            document.getElementById('prevPage').addEventListener('click', () => {
                if (currentPage > 1) currentPage--;
                loadSuppliers();
            });

            document.getElementById('nextPage').addEventListener('click', () => {
                if (currentPage < totalPages) currentPage++;
                loadSuppliers();
            });
        });

        function loadSuppliers() {
            const suppliers = getData('suppliers') || [];
            const search = document.getElementById('search').value.toLowerCase();
            const itemsPerPage = parseInt(document.getElementById('itemsPerPage').value);

            const filtered = suppliers.filter(s => 
                s.name.toLowerCase().includes(search) || 
                s.contact.toLowerCase().includes(search) || 
                s.address.toLowerCase().includes(search)
            );

            const total = filtered.length;
            totalPages = Math.ceil(total / itemsPerPage);
            const start = (currentPage - 1) * itemsPerPage;
            const end = Math.min(start + itemsPerPage, total);
            const paginated = filtered.slice(start, end);

            const tableBody = document.getElementById('suppliersTableBody');
            tableBody.innerHTML = paginated.map(s => `
                <tr>
                    <td class="px-6 py-4"><img src="${s.image || 'https://via.placeholder.com/50'}" class="supplier-image"></td>
                    <td class="px-6 py-4">${s.name}</td>
                    <td class="px-6 py-4">${s.contact}</td>
                    <td class="px-6 py-4">${s.address}</td>
                    <td class="px-6 py-4">
                        <button onclick="editSupplier('${s.id}')" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></button>
                        <button onclick="deleteSupplier('${s.id}')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `).join('');

            document.getElementById('startItem').textContent = start + 1;
            document.getElementById('endItem').textContent = end;
            document.getElementById('totalItems').textContent = total;

            document.getElementById('prevPage').disabled = currentPage === 1;
            document.getElementById('nextPage').disabled = currentPage === totalPages;
        }

        function saveSupplier() {
            const id = document.getElementById('supplierId').value;
            const name = document.getElementById('supplierName').value;
            const contact = document.getElementById('contact').value;
            const address = document.getElementById('address').value;
            const image = document.getElementById('supplierImage').value;
            let suppliers = getData('suppliers') || [];

            if (id) {
                const index = suppliers.findIndex(s => s.id === id);
                if (index !== -1) suppliers[index] = { id, name, contact, address, image };
            } else {
                suppliers.push({ id: generateId(), name, contact, address, image });
            }

            saveData('suppliers', suppliers);
            document.getElementById('supplierFormContainer').classList.add('hidden');
            loadSuppliers();
            showAlert('Supplier saved successfully!', 'success');
        }

        function editSupplier(id) {
            const supplier = getData('suppliers').find(s => s.id === id);
            if (!supplier) return;

            document.getElementById('supplierId').value = supplier.id;
            document.getElementById('supplierName').value = supplier.name;
            document.getElementById('contact').value = supplier.contact;
            document.getElementById('address').value = supplier.address;
            document.getElementById('supplierImage').value = supplier.image || '';
            document.getElementById('formTitle').textContent = 'Edit Supplier';
            document.getElementById('supplierFormContainer').classList.remove('hidden');
        }

        function deleteSupplier(id) {
            if (!confirm('Are you sure you want to delete this supplier?')) return;
            let suppliers = getData('suppliers') || [];
            suppliers = suppliers.filter(s => s.id !== id);
            saveData('suppliers', suppliers);
            loadSuppliers();
            showAlert('Supplier deleted successfully!', 'success');
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
