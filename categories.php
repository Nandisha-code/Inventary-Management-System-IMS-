<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Categories</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .product-image {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 4px;
    }
  </style>
</head>
<body class="bg-gray-50">
  <div class="min-h-screen">
    <div class="fixed inset-y-0 left-0 w-64 bg-blue-700 text-white">
      <div class="p-4">
        <h1 class="text-2xl font-bold mb-8">Inventory Manager</h1>
        <nav>
          <ul class="space-y-2">
            <li><a href="index.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-tachometer-alt mr-3"></i> Dashboard</a></li>
            <li><a href="products.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-boxes mr-3"></i> Products</a></li>
            <li><a href="suppliers.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-truck mr-3"></i> Suppliers</a></li>
            <li><a href="orders.php" class="flex items-center p-2 rounded hover:bg-blue-600"><i class="fas fa-clipboard-list mr-3"></i>Orders</a></li>
            <li><a href="categories.php" class="flex items-center p-2 rounded bg-blue-800"><i class="fas fa-tags mr-3"></i> Categories</a></li>
          </ul>
        </nav>
      </div>
    </div>

    <div class="ml-64 p-8">
      <header class="mb-8 flex justify-between items-center">
        <div>
          <h2 class="text-3xl font-bold text-gray-800">Categories</h2>
          <p class="text-gray-600">Add, edit, and manage your product categories</p>
        </div>
        <button id="addProductBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-plus mr-2"></i> Add Category
        </button>
      </header>

      <div id="productFormContainer" class="hidden bg-white p-6 rounded-lg shadow-md mb-8">
        <h3 class="text-xl font-semibold mb-4" id="formTitle">Add New Category</h3>
        <form id="productForm">
          <input type="hidden" id="productId">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name*</label>
              <input type="text" id="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price*</label>
              <input type="number" id="price" min="0" step="0.01" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity*</label>
              <input type="number" id="quantity" min="0" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label for="supplier" class="block text-sm font-medium text-gray-700 mb-1">Supplier*</label>
              <select id="supplier" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Select Supplier</option>
              </select>
            </div>
            <div class="md:col-span-2">
              <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
              <input type="text" id="image" placeholder="https://images.pexels.com/photo.jpg" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
          </div>
          <div class="mt-6 flex justify-end space-x-3">
            <button type="button" id="cancelBtn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save Category</button>
          </div>
        </form>
      </div>

      <div class="bg-white p-4 rounded-lg shadow-md mb-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
          <div class="mb-4 md:mb-0 md:w-1/3">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fas fa-search text-gray-400"></i></div>
              <input type="text" id="search" placeholder="Search categories..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
          </div>
          <div class="flex items-center space-x-2">
            <label for="itemsPerPage" class="text-sm text-gray-700">Items per page:</label>
            <select id="itemsPerPage" class="border border-gray-300 rounded-md px-2 py-1 text-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="5">5</option>
              <option value="10" selected>10</option>
              <option value="20">20</option>
              <option value="50">50</option>
            </select>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="productsTableBody">
              <!-- Populated by JS -->
            </tbody>
          </table>
        </div>

        <div class="mt-4 flex items-center justify-between">
          <div class="text-sm text-gray-700">
            Showing <span id="startItem">1</span> to <span id="endItem">10</span> of <span id="totalItems">0</span> categories
          </div>
          <div class="flex space-x-2">
            <button id="prevPage" class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 disabled:opacity-50" disabled>Previous</button>
            <button id="nextPage" class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 disabled:opacity-50" disabled>Next</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const tableBody = document.getElementById('productsTableBody');
      const totalItems = document.getElementById('totalItems');
      const startItem = document.getElementById('startItem');
      const endItem = document.getElementById('endItem');
      const itemsPerPageSelect = document.getElementById('itemsPerPage');
      let categories = [];
      let currentPage = 1;
      let itemsPerPage = parseInt(itemsPerPageSelect.value);

      function loadCategories() {
        fetch('api.php?endpoint=categories')
          .then(res => res.json())
          .then(data => {
            categories = data;
            renderTable();
          })
          .catch(err => console.error('Error fetching categories:', err));
      }

      function renderTable() {
        const start = (currentPage - 1) * itemsPerPage;
        const paginatedItems = categories.slice(start, start + itemsPerPage);
        tableBody.innerHTML = '';

        paginatedItems.forEach(category => {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td class="px-6 py-4"><img src="${category.image || 'https://placehold.co/50x50'}" alt="${category.name}" class="product-image"></td>
            <td class="px-6 py-4">${category.name}</td>
            <td class="px-6 py-4">${category.price || '-'}</td>
            <td class="px-6 py-4">${category.quantity || '-'}</td>
            <td class="px-6 py-4">${category.supplier || '-'}</td>
            <td class="px-6 py-4">
              <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
              <button class="text-red-600 hover:text-red-800">Delete</button>
            </td>
          `;
          tableBody.appendChild(row);
        });

        totalItems.textContent = categories.length;
        startItem.textContent = start + 1;
        endItem.textContent = Math.min(start + itemsPerPage, categories.length);

        document.getElementById('prevPage').disabled = currentPage === 1;
        document.getElementById('nextPage').disabled = start + itemsPerPage >= categories.length;
      }

      document.getElementById('prevPage').addEventListener('click', () => {
        if (currentPage > 1) {
          currentPage--;
          renderTable();
        }
      });

      document.getElementById('nextPage').addEventListener('click', () => {
        if ((currentPage * itemsPerPage) < categories.length) {
          currentPage++;
          renderTable();
        }
      });

      itemsPerPageSelect.addEventListener('change', () => {
        itemsPerPage = parseInt(itemsPerPageSelect.value);
        currentPage = 1;
        renderTable();
      });

      loadCategories();
    });
  </script>
</body>
</html>
